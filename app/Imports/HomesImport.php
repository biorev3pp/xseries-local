<?php

namespace App\Imports;

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

class HomesImport implements ToModel, WithHeadingRow,WithValidation,SkipsOnFailure
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

        if(array_key_exists('title',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['title']] = 'required';
        }
        if(array_key_exists('price',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['price']] = 'nullable|numeric|min:0';
        }
        if(array_key_exists('area',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['area']] = 'nullable|numeric|between:100,1000000';
        }
        if(array_key_exists('bedroom',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['bedroom']] = 'nullable|numeric|between:0,100';
        }
        if(array_key_exists('bathroom',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['bathroom']] = 'nullable|numeric|between:0,100';
        }
        if(array_key_exists('garage',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['garage']] = 'nullable|numeric|between:0,50';
        }
        if(array_key_exists('floor',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['floor']] = 'nullable|numeric|between:0,200';
        }
    }

    public function model(array $row)
    {
        //continue or stop
        if(!array_key_exists('title',$this->mapChoice)){
        
            // there is no field map with community name. Terminate the whole process and exit
            return;
        }
        foreach($this->mapChoice as $key => $value)
        {
            $c_data[$key] =  $row[$this->mapChoice[$key]];
        }
        
        $slug = str_replace(' ', '-', strtolower($row[$this->mapChoice['title']]));
        if(Homes::where('slug', $slug)->count() == 0)
        { 
            $c_data['parent_id'] = 0;
            $c_data['slug'] = $slug; 
            $c_data['imported_on'] = $this->imported_on;
            // Handle exception
            return  new Homes($c_data);
        }
        elseif(Homes::where('slug', $slug)->count() != 0 && $this->flag =='skip'){
            $data = serialize($c_data);
            ErrorHistory::create([
                'data'          => $data,
                'type'          => 'elevation',
                'flag'          => 'skip',
                'imported_on'   => $this->imported_on
            ]); 
            return null;
        }
        elseif(Homes::where('slug', $slug)->count() != 0 && $this->flag =='update'){
            $c_data['imported_on'] = $this->imported_on;
            $c_data['parent_id'] = 0;
            Homes::where('slug',$slug)->update($c_data);
            return;
        }
        else{
            return ;
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
            'type'          =>'elevation',
            'imported_on'   => $this->imported_on
        ]);
    }
}
