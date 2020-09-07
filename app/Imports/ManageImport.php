<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ManageImport implements WithMultipleSheets 
{
   
    public function sheets(): array
    {
        return [
            'Communities'                   => new CommunitiesImport(),
            'Elevations'                    => new HomesImport(),
            'Floors'                        => new FloorsImport(),
            'Elevation Types'               => new HomeTypesImport(),
            'Elevation Color Schemes'       => new HomeColorSchemesImport(),
            'Elevation Type Color Schemes'  => new HomeTypeColorSchemesImport(),
        ];
    }
}