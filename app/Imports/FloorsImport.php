<?php

namespace App\Imports;

use App\Models\Floor;
use App\Models\Homes;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
class FloorsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.floor_title'     => 'required',
            '*.elevation_title' => 'required',
            '*.floor_image'     => 'required',
        ])->validate();

        foreach ($rows as $row) 
        {  
            $home_slug  = str_replace(' ', '-', strtolower($row['elevation_title']));
            $home       = Homes::where('slug', $home_slug)->get(['id', 'slug'])->first();
            if(Floor::where('title', 'like', $row['floor_title'])->where('home_id', $home->id)->count() == 0)
            {
                if($home_slug == $home->slug)
                {  
                    Floor::create([
                        'title'     => $row['floor_title'],
                        'home_id'   => $home->id,
                        'image'     => $row['floor_image'],
                        'status_id' => 1
                    ]);
                }
            }
        }
    }
}
