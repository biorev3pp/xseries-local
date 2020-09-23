<?php

namespace App\Imports;

use App\Models\Floor;
use App\Models\Homes;
use App\Models\Features;
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
class FloorFeaturesImport implements ToModel, WithHeadingRow,WithValidation,SkipsOnFailure
{
    use Importable;
    public $mapChoice;
    public $rules = [];
    public $imported_on;
    public $parent_id;
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
        if(array_key_exists('floor_id',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['floor_id']] = 'required';
        }
        if(array_key_exists('title',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['title']] = 'required';
        }
        if(array_key_exists('group',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['group']] = 'required';
        }
        if(array_key_exists('price',$this->mapChoice))
        {
            $this->rules[$this->mapChoice['price']] = 'nullable|numeric|min:0';
        }
    }

    public function model(array $row)
    {
        //continue or stop
        if(!array_key_exists('home_id',$this->mapChoice) && !array_key_exists('floor_id',$this->mapChoice)){
            // there is no field map with  name. Terminate the whole process and exit
            return;
        }
        foreach($this->mapChoice as $key => $value)
        {
            $c_data[$key] =  $row[$this->mapChoice[$key]];
        }
        $home_slug  = str_replace(' ', '-', strtolower($row[$this->mapChoice['home_id']]));
        $home       = Homes::where('slug', $home_slug)->get(['id', 'slug'])->first();
        $floor      = Floor::where('title', 'like', $row[$this->mapChoice['floor_id']])->where('home_id', $home->id)->first();
        if(!$floor) {
            $data = json_encode($row);
            ErrorHistory::create([
                'data'          => $data,
                'type'          => 'floor_feature',
                'flag'          => 'skip',
                'imported_on'   => $this->imported_on,
                'msg'           => 'Elevation or Elevation type or Floor found in sheet do not exist'    
            ]);
            return;
        }
        if(Features::where('title', 'like', $row[$this->mapChoice['title']])->where('floor_id', $floor->id)->count() == 0)
        { 
               if($row[$this->mapChoice['group']] == 1)
                {
                    unset($c_data['home_id'],$c_data['group']);
                    $c_data['imported_on'] = $this->imported_on;
                    $c_data['floor_id'] = $floor->id;
                    $c_data['status_id'] = 1;
                    $c_data['parent_id'] = 0;
                    $c_data['order_no'] = 1;
                    $feature = Features::create($c_data);
                    $this->parent_id = $feature->id;
                }
                else
                {
                    unset($c_data['home_id'],$c_data['group']);
                    $c_data['imported_on'] = $this->imported_on;
                    $c_data['floor_id'] = $floor->id;
                    $c_data['status_id'] = 1;
                    $c_data['parent_id'] = $this->parent_id;
                    $c_data['order_no'] = 1;
                    return new Features($c_data);
                }
        }
        elseif(Features::where('title', 'like', $row[$this->mapChoice['title']])->where('floor_id', $floor->id)->count()!=0 && $this->flag =='skip'){
            $data = json_encode($row);
            ErrorHistory::create([
                'data'          => $data,
                'type'          => 'floor_feature',
                'flag'          => 'skip',
                'imported_on'   => $this->imported_on
            ]); 
            return null;
        }
        elseif(Features::where('title', 'like', $row[$this->mapChoice['title']])->where('floor_id', $floor->id)->count()!=0 && $this->flag =='update'){
            $c_data['imported_on'] = $this->imported_on;
            Features::where('title', 'like', $row[$this->mapChoice['title']])->where('floor_id', $floor->id)->update($c_data);
            return;
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
            'type'          =>'floor_feature',
            'imported_on'   => $this->imported_on
        ]);
    }
}
