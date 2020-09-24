<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\ColorSchemes;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class HomeFeaturesExport implements FromArray,WithTitle,WithHeadings,ShouldAutoSize,WithMapping
{
    protected $rows;
    public $heading;
    public function __construct(array $rows,array $heading)
    {
        $this->rows = $rows;
        $this->heading = $heading;
    }
    public function map($row): array
    {
        return [
            $row['home_id'],$row['color_scheme_id'],$row['title'],$row['price'],$row['upgraded'],$row['upgrade_type'],$row['material'],$row['manufacturer'],$row['name'],$row['m_id'],$row['img'],$row['status'],$row['msg']
        ];
    }
    public function headings(): array
    {
        return $this->heading;
    }
    public function array(): array
    {
        return $this->rows;
    }

    public function title(): string
    {
        return 'Color Schemes Features';
    }
}
