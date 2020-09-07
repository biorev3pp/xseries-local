<?php

namespace App\Imports;

use App\Models\Homes;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class HomesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.elevation_title'     => 'required',
            '*.specifications'      => 'required',
            '*.price'               => 'required|numeric|min:0',
            '*.area'                => 'required|numeric|between:100,1000000',  
            '*.bedroom'             => 'required|numeric|between:0,100',
            '*.bathroom'            => 'required|numeric|between:0,100',
            '*.garage'              => 'required|numeric|between:0,50',
            '*.floor'               => 'required|numeric|between:0,200',
            '*.elevation_image'     => 'required',
        ])->validate();

        foreach ($rows as $row) 
        {  
            $slug = str_replace(' ', '-', strtolower($row['elevation_title']));
            if(Homes::where('slug', $slug)->count() == 0)
            {  
                Homes::create([
                    'title'         => $row['elevation_title'],
                    'slug'          => $slug,
                    'parent_id'     => 0,
                    'price'         => $row['price'],
                    'area'          => $row['area'],
                    'bedroom'       => $row['bedroom'],
                    'bathroom'      => $row['bathroom'],
                    'garage'        => $row['garage'],
                    'floor'         => $row['floor'],
                    'specifications'=> $row['specifications'],
                    'img'           => $row['elevation_image'],
                    'gallery'       => $row['elevation_gallery']
                ]);
            }
        }
    }
}
