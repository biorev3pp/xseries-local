<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
HeadingRowFormatter::default('none');
class ExcelHeadings implements WithMultipleSheets,SkipsUnknownSheets 
{
    use Importable;
    public function sheets(): array
    {
        return [
            'Communities'                   => new HeadingRowImport(),
            'Elevations'                    => new HeadingRowImport(),
            'Floors'                        => new HeadingRowImport(),
            'Floor Features'                => new HeadingRowImport(),
            'Elevation Types'               => new HeadingRowImport(),
            'Color Schemes'                 => new HeadingRowImport(),
            'Color Scheme Features'         => new HeadingRowImport(),
        ];
    }
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}