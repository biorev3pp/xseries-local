<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Homes;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class FloorFeaturesExport implements FromArray,WithTitle,WithHeadings,ShouldAutoSize,WithMapping
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
                // $row['home_id'],$row['floor_id'],$row['title'],$row['price'],$row['image'],$row['group'],$row['status'],$row['msg']
                $row['home_id'],$row['floor_id'],$row['title'],$row['price'],$row['image'],$row['status'],$row['msg']
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
        return 'Floor Features';
    }
}