<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;


class ManageImport implements WithMultipleSheets,SkipsUnknownSheets
{
    use Importable;
    public $mapArray;
    public function __construct($mapArray){
        $this->mapArray = $mapArray;
    }
    public function sheets(): array
    {
        return [
            'Communities'                   => new CommunitiesImport($this->mapArray->{'community'}),
            'Elevations'                    => new HomesImport(),
            'Floors'                        => new FloorsImport(),
            'Floor Features'                => new FloorFeaturesImport(),
            'Elevation Types'               => new HomeTypesImport(),
            'Color Schemes'                 => new ColorSchemesImport(),
            'Color Scheme Features'         => new HomeFeaturesImport(),
        ];
    }
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}