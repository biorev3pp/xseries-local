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
    public $errormsg = [];
    public $imported_on;

    
    public function __construct($mapChoice,$importing_on)
    {
        # code...
        $this->mapChoice = (array)$mapChoice;
        $this->imported_on = $importing_on;
        $this->mapChoice = array_flip($this->mapChoice);

        if(array_key_exists('title',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['title']] = 'required';
            // $this->errormsg[$this->mapChoice['name']] = 'There should be valid name'; 
        }
        if(array_key_exists('price',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['price']] = 'nullable|numeric|min:0';
            // $this->errormsg[$this->mapChoice['zipcode']] = 'This field mapped with zipcode, make sure a valid zipcode between 5 to 6 digits';
        }
        if(array_key_exists('area',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['area']] = 'nullable|numeric|between:100,1000000';
            // $this->errormsg[$this->mapChoice['contact_email']] = 'This field mapped with email, make sure a valid email';
        }
        if(array_key_exists('bedroom',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['bedroom']] = 'nullable|numeric|between:0,100';
            // $this->errormsg[$this->mapChoice['contact_person']] = 'This field mapped with contact person name, make sure a valid name';
        }
        if(array_key_exists('bathroom',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['bathroom']] = 'nullable|numeric|between:0,100';
            // $this->errormsg[$this->mapChoice['contact_number']] = 'This field mapped with contact number, make sure a valid number';
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
            $c_data['slug'] = $slug; 
            $c_data['imported_on'] = $this->imported_on;
            // Handle exception
            return  new Homes($c_data);
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
            'type'          =>'elevation',
            'imported_on'   => $this->imported_on
        ]);
    }
}
