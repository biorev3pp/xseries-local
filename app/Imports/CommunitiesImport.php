<?php

namespace App\Imports;

use App\Models\Communities;
use App\Models\States;
use App\Models\Cities;
use App\Models\Plots;
use App\Models\History;
use App\Models\ErrorHistory;
use App\Models\LegendGroups;
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
class CommunitiesImport implements ToModel, WithHeadingRow,WithValidation,SkipsOnFailure
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
        
        if(array_key_exists('name',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['name']] = 'required';
            // $this->errormsg[$this->mapChoice['name']] = 'There should be valid name'; 
        }
        if(array_key_exists('zipcode',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['zipcode']] = 'required|numeric|digits_between:5,6';
            // $this->errormsg[$this->mapChoice['zipcode']] = 'This field mapped with zipcode, make sure a valid zipcode between 5 to 6 digits';
        }
        if(array_key_exists('contact_email',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['contact_email']] = 'required|email|max:180';
            // $this->errormsg[$this->mapChoice['contact_email']] = 'This field mapped with email, make sure a valid email';
        }
        if(array_key_exists('contact_person',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['contact_person']] = 'required|regex:/^[a-zA-Z\s]*$/';
            // $this->errormsg[$this->mapChoice['contact_person']] = 'This field mapped with contact person name, make sure a valid name';
        }
        if(array_key_exists('contact_number',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['contact_number']] = 'required|digits:10';
            // $this->errormsg[$this->mapChoice['contact_number']] = 'This field mapped with contact number, make sure a valid number';
        }
        if(array_key_exists('location',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['location']] = 'required';
        }
        if(array_key_exists('state_id',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['state_id']] = 'required';
        }
        if(array_key_exists('city_id',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['city_id']] = 'required';
        }
    }

    public function model(array $row)
    {
        //continue or stop
        if(!array_key_exists('name',$this->mapChoice))
        {
            // there is no field map with community name. Terminate the whole process and exit.
            return;
        }
        foreach($this->mapChoice as $key => $value)
        {
            $c_data[$key] =  $row[$this->mapChoice[$key]];
        }
        
        $slug = str_replace(' ', '-', strtolower($row[$this->mapChoice['name']]));
        if(Communities::where('slug', $slug)->count() == 0)
        { 
            $c_data['slug'] = $slug; 
            $c_data['imported_on'] = $this->imported_on;
            // Handle exception
            $community =  new Communities($c_data);
            $community = Communities::create($c_data);
            $c_id = Communities::where('slug',$community->slug)->get(['id'])->first();
            $plot = Plots::create([
                'community_id' => $c_id->id,
            ]);

            $legend_group = LegendGroups::create([
                'plot_id' => $plot->id,
                'groupname' => 'Color Legends',
                'status_id' =>2
            ]);

            Plots::where('id', $plot->id)->update([
                'legend_group_id' => $legend_group->id
            ]);
            return;
            
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
            'type'          => 'community',
            'imported_on'   => $this->imported_on
        ]);
    }
}
