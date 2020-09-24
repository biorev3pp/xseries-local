<?php

namespace App\Imports;

use App\Models\ColorSchemes;
use App\Models\Homes;
use App\Models\HomeFeatures;
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
class HomeFeaturesImport implements ToModel, WithHeadingRow,WithValidation,SkipsOnFailure
{
    use Importable;
    public $mapChoice;
    public $rules = [];
    public $imported_on;
    public $flag;

    public function __construct($mapChoice,$importing_on,$flag)
    {
        # code...
        $this->mapChoice = (array)$mapChoice;
        $this->imported_on = $importing_on;
        $this->flag = $flag;
        $this->mapChoice = array_flip($this->mapChoice);
        if(array_key_exists('home_id',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['home_id']] = 'required';
        }
        if(array_key_exists('color_scheme_id',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['color_scheme_id']] = 'required';
        }
        if(array_key_exists('title',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['title']] = 'required';
        }
        if(array_key_exists('price',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['home_id']] = 'nullable|numeric|min:0';
        }
        if(array_key_exists('upgraded',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['upgraded']] = 'required|numeric|between:0,1';
        }
        if(array_key_exists('upgrade_type',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['upgrade_type']] = 'required|numeric|between:0,3';
        }
    }

    public function model(array $row)
    {
        //continue or stop
        if(!array_key_exists('home_id',$this->mapChoice) && !array_key_exists('color_scheme_id',$this->mapChoice)){
            // there is no field map with  name. Terminate the whole process and exit
            return;
        }
        foreach($this->mapChoice as $key => $value)
        {
            $c_data[$key] =  $row[$this->mapChoice[$key]];
        }
        $home_slug  = str_replace(' ', '-', strtolower($row[$this->mapChoice['home_id']]));
        $home       = Homes::where('slug', $home_slug)->get(['id', 'slug'])->first();
        $color_scheme      = ColorSchemes::where('title', 'like', $row[$this->mapChoice['color_scheme_id']])->where('home_id', $home->id)->first();
        if(!$color_scheme) {
            $data = serialize($c_data);
            ErrorHistory::create([
                'data'          => $data,
                'type'          => 'color_scheme_feature',
                'flag'          => 'skip',
                'imported_on'   => $this->imported_on,
                'msg'           => 'Color Scheme found in sheet do not exist.'    
            ]);
            return;
        }
        if(HomeFeatures::where('title', 'like', $row[$this->mapChoice['title']])->where('color_scheme_id', $color_scheme->id)->count() == 0)
        { 
            $c_data['imported_on'] = $this->imported_on;
            $c_data['priority']          = 1;
            $c_data['color_scheme_id'] = $color_scheme->id;
            return new HomeFeatures($c_data);
        }
        elseif(HomeFeatures::where('title', 'like', $row[$this->mapChoice['title']])->where('color_scheme_id', $color_scheme->id)->count()!=0 && $this->flag =='skip'){
            $data = serialize($c_data);
            ErrorHistory::create([
                'data'          => $data,
                'type'          => 'floor_feature',
                'flag'          => 'skip',
                'imported_on'   => $this->imported_on
            ]); 
            return null;
        }
        elseif(HomeFeatures::where('title', 'like', $row[$this->mapChoice['title']])->where('color_scheme_id', $color_scheme->id)->count()!=0 && $this->flag =='update'){
            $c_data['imported_on'] = $this->imported_on;
            HomeFeatures::where('title', 'like', $row[$this->mapChoice['title']])->where('color_scheme_id', $color_scheme->id)->update($c_data);
        }
        else{
            return;
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
            'type'          =>'color_scheme_feature',
            'imported_on'   => $this->imported_on
        ]);
    }
}