<?php

namespace App\Imports;

use App\Models\ColorSchemes;
use App\Models\Homes;
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
            '*.feature_price'                               => 'required|numeric|min:0',
            '*.upgrade1_base0'                              => 'required|numeric|between:0,1',
            '*.upgraded_typeconcrete1_window2_wall3_base0'  => 'required|numeric|between:0,3',
            '*.material'                                    => 'required',
            '*.manufacturer'                                => 'required',
            '*.name'                                        => 'required',
            '*.manufacturer_id'                             => 'required',
            '*.feature_image'                               => 'required',
        ])->validate();
        foreach ($rows as $row) 
        {
            
        }
    }
}