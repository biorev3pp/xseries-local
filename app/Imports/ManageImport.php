<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;


class ManageImport implements WithMultipleSheets,SkipsUnknownSheets
{
    use Importable;
    public $mapArray;
    public $importing_on;
    public function __construct($mapArray,$importing_on){
        $this->mapArray = $mapArray;
        $this->importing_on = $importing_on;
        
    }
    public function sheets(): array
    {
        return [
            'Communities'                   => new CommunitiesImport($this->mapArray->{'community'},$this->importing_on),

            'Elevations'                    => new HomesImport($this->mapArray->{'elevation'},$this->importing_on),

            'Floors'                        => new FloorsImport($this->mapArray->{'floor'},$this->importing_on),

            'Floor Features'                => new FloorFeaturesImport($this->mapArray->{'floor_feature'},$this->importing_on),

            'Elevation Types'               => new HomeTypesImport($this->mapArray->{'elevation_type'},$this->importing_on),

            'Color Schemes'                 => new ColorSchemesImport($this->mapArray->{'color_scheme'},$this->importing_on),
            
            'Color Scheme Features'         => new HomeFeaturesImport($this->mapArray->{'color_scheme_feature'},$this->importing_on),
        ];
    }
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}