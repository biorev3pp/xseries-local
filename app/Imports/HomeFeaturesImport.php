<?php

namespace App\Imports;

use App\Models\ColorSchemes;
use App\Models\Homes;
use App\Models\HomeFeatures;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class HomeFeaturesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {   
        Validator::make($rows->toArray(), [
            '*.elevation_or_elevation_type_title'           => 'required',
            '*.color_scheme_title'                          => 'required',
            '*.feature_title'                               => 'required',
            '*.feature_price'                               => 'nullable|numeric|min:0',
            '*.upgrade1_base0'                              => 'required|numeric|between:0,1',
            '*.upgraded_typeconcrete1_window2_wall3_base0'  => 'required|numeric|between:0,3',
        ])->validate();
        foreach ($rows as $row) 
        {
            $home_or_home_type_slug = str_replace(' ', '-', strtolower($row['elevation_or_elevation_type_title']));
            $home_or_home_type = Homes::where('slug', $home_or_home_type_slug)->get(['id', 'slug'])->first();
            $color_scheme      = ColorSchemes::where('title', 'like', $row['color_scheme_title'])->where('home_id', $home_or_home_type->id)->first();
            if(HomeFeatures::where('title', 'like', $row['feature_title'])->where('color_scheme_id', $color_scheme->id)->count() == 0){
                HomeFeatures::create([
                    'color_scheme_id'   => $color_scheme->id,
                    'title'             => $row['feature_title'],
                    'price'             => ($row['feature_price'])?$row['feature_price']:0,
                    'img'               => $row['feature_image'],
                    'priority'          => 1,
                    'stared'            => $row['upgrade1_base0'],
                    'upgrade_type'      => $row['upgraded_typeconcrete1_window2_wall3_base0'],
                    'material'          => $row['material'],
                    'manufacturer'      => $row['manufacturer'],
                    'name'              => $row['name'],
                    'm_id'              => $row['manufacturer_id'],
                ]);
            }
        }
    }
}