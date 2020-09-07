<?php

namespace App\Imports;

use App\Models\ColorSchemes;
use App\Models\ColorSchemeUpgrade;
use App\Models\Homes;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class HomeTypeColorSchemesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.elevation_type_title'=> 'required',
            '*.color_scheme_title'  => 'required',
            '*.color_scheme_price'  => 'required|numeric|min:0',
            '*.color_scheme_image'  => 'required',
        ])->validate();

        foreach ($rows as $row) 
        {  
            $home_type_slug = str_replace(' ', '-', strtolower($row['elevation_type_title']));
            $home_type      = Homes::where('slug', $home_type_slug)->get(['id', 'slug'])->first();
            if(ColorSchemes::where('title', 'like', $row['color_scheme_title'])->where('home_id', $home_type->id)->count() == 0)
            {  
                $color_scheme = ColorSchemes::create([
                    'title'     => $row['color_scheme_title'],
                    'home_id'   => $home_type->id,
                    'img'       => $row['color_scheme_image'],
                    'base_img'  => $row['color_scheme_image'],
                    'price'     => $row['color_scheme_price'],
                    'status_id' => 1,
                    'priority'  => 1
                ]);
                
                //ColorSchemeUpgrade default entry to manage upgrade images
                $data = [
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 1, 'side' => 1],
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 1, 'side' => 0],
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 0, 'side' => 1],
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 1, 'side' => 1],
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 0, 'side' => 0],
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 1, 'side' => 0],
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 0, 'side' => 1],
                    ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 0, 'side' => 0],
                ];
                ColorSchemeUpgrade::insert($data);
            }
        }
    }
}