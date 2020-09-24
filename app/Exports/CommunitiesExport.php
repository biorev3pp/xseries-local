<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Communities;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class CommunitiesExport implements FromArray,WithTitle,WithHeadings,ShouldAutoSize,WithMapping
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
            $row['name'],$row['location'],$row['state_id'],$row['city_id'],$row['marker_image'],$row['description'],$row['zipcode'],$row['logo'],$row['banner'],$row['lat'],$row['lng'],$row['gallery'],$row['contact_number'],$row['contact_email'],$row['contact_person'],$row['status']
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
        return 'Communities';
    }
}
