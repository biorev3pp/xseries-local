<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromArray;


class ManageImageDataExport implements FromArray,WithMultipleSheets
{
    protected $sheets;
    public $flag;

    public function __construct(array $sheets,$flag)
    {
        $this->sheets = $sheets;
        $this->flag = $flag;
    }

    public function array(): array
    {
        return $this->sheets;
    }
    public function sheets(): array
    {
        
        $sheets = [
            new CommunitiesExport($this->sheets['community'],$this->sheets['heading'],$this->flag),
            new HomesExport($this->sheets['elevation'],$this->sheets['heading'],$this->flag),
            new FloorsExport($this->sheets['floor'],$this->sheets['heading'],$this->flag),
            new FloorFeaturesExport($this->sheets['floor_feature'],$this->sheets['heading'],$this->flag),
            new ColorSchemesExport($this->sheets['color_scheme'],$this->sheets['heading'],$this->flag),
            new HomeFeaturesExport($this->sheets['color_scheme_feature'],$this->sheets['heading'],$this->flag),
        ];

        return $sheets;
    }

}
