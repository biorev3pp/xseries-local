<?php

namespace App\Imports;

use App\Models\Homes;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class HomeTypesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.elevation_type_title'=> 'required',
            '*.base_elevation'      => 'required',
            '*.specifications'      => 'required',
            '*.price'               => 'required|numeric|min:0',
            '*.area'                => 'required|numeric|between:100,1000000',  
            '*.bedroom'             => 'required|numeric|between:0,100',
            '*.bathroom'            => 'required|numeric|between:0,100',
            '*.garage'              => 'required|numeric|between:0,50',
            '*.floor'               => 'required|numeric|between:0,200',
            '*.elevation_type_image'=> 'required',
        ])->validate();

        foreach ($rows as $row) {
            $home_slug  = str_replace(' ', '-', strtolower($row['base_elevation']));
            $home       = Homes::where('slug', $home_slug)->get(['id', 'slug'])->first();
            $home_type_slug = str_replace(' ', '-', strtolower($row['elevation_type_title']));
            if(Homes::where('slug', $home_type_slug)->count() == 0)
            {   
                Homes::create([
                    'title'         => $row['elevation_type_title'],
                    'slug'          => $home_type_slug,
                    'parent_id'     => $home->id,
                    'price'         => $row['price'],
                    'area'          => $row['area'],
                    'bedroom'       => $row['bedroom'],
                    'bathroom'      => $row['bathroom'],
                    'garage'        => $row['garage'],
                    'floor'         => $row['floor'],
                    'specifications'=> $row['specifications'],
                    'img'           => $row['elevation_type_image'],
                    'gallery'       => $row['elevation_type_gallery']
                ]);
            }
        }
    }
}
