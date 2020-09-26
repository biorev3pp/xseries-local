<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\ColorSchemes;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ColorSchemesExport implements FromArray,WithTitle,WithHeadings,ShouldAutoSize,WithMapping
{
    protected $rows;
    public $heading;
    public $flag;
    public function __construct(array $rows,array $heading,$flag)
    {
        $this->rows = $rows;
        $this->heading = $heading;
        $this->flag = $flag;
    }
    public function map($row): array
    {
        if($this->flag)
        {
            $index = [];
            foreach($this->heading as $key=>$value)
            {
                array_push($index,$row[$value]);
            }
            return $index;
        }
        else{
            return [
                $row['title'],$row['home_id'],$row['img'],$row['price'],$row['status'],$row['msg']
            ];
        }
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
        return 'Color Schemes';
    }
}
