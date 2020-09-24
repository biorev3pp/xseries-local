<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromArray;


class ManageExport implements FromArray,WithMultipleSheets
{
    protected $sheets;

    public function __construct(array $sheets)
    {
        $this->sheets = $sheets;
    }

    public function array(): array
    {
        return $this->sheets;
    }
    public function sheets(): array
    {
        
        $sheets = [
            new CommunitiesExport($this->sheets['community'],$this->sheets['community_heading']),
            new HomesExport($this->sheets['elevation'],$this->sheets['home_heading']),
            new HomeTypesExport($this->sheets['elevation_type'],$this->sheets['home_type_heading']),
            new FloorsExport($this->sheets['floor'],$this->sheets['floor_heading']),
            new FloorFeaturesExport($this->sheets['floor_feature'],$this->sheets['floor_feature_heading']),
            new ColorSchemesExport($this->sheets['color_scheme'],$this->sheets['color_scheme_heading']),
            new HomeFeaturesExport($this->sheets['color_scheme_feature'],$this->sheets['color_scheme_feature_heading']),
        ];

        return $sheets;
    }

}
