<?php

namespace App\Imports;

use App\Models\Floor;
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
class FloorsImport implements ToModel, WithHeadingRow,WithValidation,SkipsOnFailure
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
        if(!$home) {
            $data = serialize($c_data);
            ErrorHistory::create([
                'data'          => $data,
                'type'          => 'floor',
                'flag'          => 'skip',
                'imported_on'   => $this->imported_on,
                'msg'           => 'Elevation or Elevation type found in sheet do not exist'    
            ]);
            return;
        }
        if(Floor::where('title', 'like', $row[$this->mapChoice['title']])->where('home_id', $home->id)->count() == 0)
        { 
            $c_data['status_id'] = 1;
            $c_data['home_id'] = $home->id;
            $c_data['imported_on'] = $this->imported_on;
            return new Floor($c_data);
        }
        elseif(Floor::where('title', 'like', $row[$this->mapChoice['title']])->where('home_id', $home->id)->count() != 0 && $this->flag == 'skip'){
            $data = serialize($c_data);
            ErrorHistory::create([
                'data'          => $data,
                'type'          => 'floor',
                'flag'          => 'skip',
                'imported_on'   => $this->imported_on
            ]); 
            return null;
        }
        elseif(Floor::where('title', 'like', $row[$this->mapChoice['title']])->where('home_id', $home->id)->count() != 0 && $this->flag == 'update'){
            $c_data['home_id'] = $home->id;
            $c_data['imported_on'] = $this->imported_on;
            Floor::where('title', 'like', $row[$this->mapChoice['title']])->where('home_id', $home->id)->update($c_data);
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
            'type'          =>'floor',
            'imported_on'   => $this->imported_on
        ]);
    }
}
