<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Importable;


class ManageImport implements WithMultipleSheets 
{
    use Importable;
    public function sheets(): array
    {
        return [
            'Communities'                   => new CommunitiesImport(),
            'Elevations'                    => new HomesImport(),
            'Floors'                        => new FloorsImport(),
            'Floor Features'                => new FloorFeaturesImport(),
            'Elevation Types'               => new HomeTypesImport(),
            'Elevation Color Schemes'       => new HomeColorSchemesImport(),
            'Elevation Type Color Schemes'  => new HomeTypeColorSchemesImport(),
            'Color Scheme Features'         => new HomeFeaturesImport(),
        ];
    }
}