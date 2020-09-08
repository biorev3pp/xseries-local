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
            '*.price'               => 'nullable|numeric|min:0',
            '*.area'                => 'nullable|numeric|between:100,1000000',  
            '*.bedroom'             => 'nullable|numeric|between:0,100',
            '*.bathroom'            => 'nullable|numeric|between:0,100',
            '*.garage'              => 'nullable|numeric|between:0,50',
            '*.floor'               => 'nullable|numeric|between:0,200',
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
                    'price'         => ($row['price'])?$row['price']:0,
                    'area'          => ($row['area'])?$row['area']:0,
                    'bedroom'       => ($row['bedroom'])?$row['bedroom']:0,
                    'bathroom'      => ($row['bathroom'])?$row['bathroom']:0,
                    'garage'        => ($row['garage'])?$row['garage']:0,
                    'floor'         => ($row['floor'])?$row['floor']:0,
                    'specifications'=> $row['specifications'],
                    'img'           => $row['elevation_image'],
                    'gallery'       => $row['elevation_gallery']
                ]);
            }
        }
    }
}
