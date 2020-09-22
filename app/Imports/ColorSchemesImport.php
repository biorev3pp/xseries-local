<?php

namespace App\Imports;

use App\Models\ColorSchemes;
use App\Models\ColorSchemeUpgrade;
use App\Models\Homes;
use App\Models\History;
use App\Models\ErrorHistory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
// setting the default heading structure to none
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
HeadingRowFormatter::default('none');
class ColorSchemesImport implements ToModel, WithHeadingRow,WithValidation,SkipsOnFailure
{
    use Importable;
    public $mapChoice;
    public $rules = [];
    public $imported_on;

    
    public function __construct($mapChoice,$importing_on)
    {
        # code...
        $this->mapChoice = (array)$mapChoice;
        $this->imported_on = $importing_on;
        $this->mapChoice = array_flip($this->mapChoice);
        if(array_key_exists('home_id',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['home_id']] = 'required';
        }
        if(array_key_exists('price',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['price']] = 'nullable|numeric|min:0';
        }
        if(array_key_exists('title',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['title']] = 'required';
        }
    }

    public function model(array $row)
    {
        //continue or stop
        if(!array_key_exists('home_id',$this->mapChoice)){
            // there is no field map with community name. Terminate the whole process and exit
            return;
        }
        foreach($this->mapChoice as $key => $value)
        {
            $c_data[$key] =  $row[$this->mapChoice[$key]];
        }
        $home_slug  = str_replace(' ', '-', strtolower($row[$this->mapChoice['home_id']]));
        $home       = Homes::where('slug', $home_slug)->get(['id', 'slug'])->first();
        if(!$home) return;
        if(ColorSchemes::where('title', 'like', $row[$this->mapChoice['title']])->where('home_id', $home->id)->count() == 0)
        { 
            $c_data['home_id'] = $home->id;
            $c_data['priority']  = 1;
            $c_data['imported_on'] = $this->imported_on;
            // Handle exception
                $color_scheme =   ColorSchemes::create($c_data);
            //ColorSchemeUpgrade default entry to manage upgrade images
                $data = [
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 1, 'side' => 1],
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 1, 'side' => 0],
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 0, 'side' => 1],
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 1, 'side' => 1],
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 0, 'side' => 0],
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 1, 'side' => 0],
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 0, 'side' => 1],
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 0, 'side' => 0],
                ];
                ColorSchemeUpgrade::insert($data);
        }
        else{
            return null;
        }
    }
    public function rules(): array
    {   
        return $this->rules;
    }

    /**
     * @param Failure[] $failures
     */
    public function onFailure(Failure ...$failures)
    {
        // Handle the failures how you'd like.
        $err = serialize($failures);
        ErrorHistory::create([
            'data'          => $err,
            'type'          =>'color_scheme',
            'imported_on'   => $this->imported_on
        ]);
    }
}