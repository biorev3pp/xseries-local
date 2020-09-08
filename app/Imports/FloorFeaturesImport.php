<?php

namespace App\Imports;

use App\Models\Floor;
use App\Models\Homes;
use App\Models\Features;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
class FloorFeaturesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.elevation_title'         => 'required',
            '*.floor_title'             => 'required',
            '*.feature_group1_feature2' => 'required',
            '*.feature_title'           => 'required',
            '*.feature_price'           => 'nullable|numeric|min:0',
        ])->validate();

        foreach ($rows as $row) 
        {  
            $home_slug  = str_replace(' ', '-', strtolower($row['elevation_title']));
            $home       = Homes::where('slug', $home_slug)->get(['id', 'slug'])->first();
            $floor      = Floor::where('title', 'like', $row['floor_title'])->where('home_id', $home->id)->first();
            if(Features::where('title', 'like', $row['feature_title'])->where('floor_id', $floor->id)->count() == 0)
            {
                if($row['feature_group1_feature2'] == 1)
                {
                    $feature = Features::create([
                        'floor_id'  => $floor->id,
                        'title'     => $row['feature_title'],
                        'price'     => $row['feature_price'],
                        'status_id' => 1,
                        'parent_id' => 0,
                        'order_no'  => 1,
                    ]);
                    $parent_id = $feature->id;
                }
                else
                {
                    Features::create([                             
                        'floor_id'  => $floor->id,
                        'title'     => $row['feature_title'],
                        'price'     => $row['feature_price'],
                        'image'     => $row['image'],
                        'status_id' => 1,
                        'parent_id' => $parent_id,
                        'order_no'  => 1,
                    ]);
                }
            }
        }
    }
}
