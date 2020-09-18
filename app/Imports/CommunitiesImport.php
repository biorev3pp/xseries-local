<?php

namespace App\Imports;

use App\Models\Communities;
use App\Models\States;
use App\Models\Cities;
use App\Models\Plots;
use App\Models\LegendGroups;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class CommunitiesImport implements ToCollection, WithHeadingRow
{
    public $mapChoice;
    public function __construct($mapChoice)
    {
        # code...
        $this->mapChoice = $mapChoice;
        dd($this->mapChoice);
    }

    public function collection(Collection $rows)
    {
        // Validator::make($rows->toArray(), [
        //     '*.community_name'      => 'required',
        //     '*.contact_person'      => 'required|regex:/^[a-zA-Z\s]*$/',
        //     '*.contact_email'       => 'required|email|max:180',
        //     '*.contact_number'      => 'required|digits:10',
        //     '*.location'            => 'required',
        //     '*.state_id'            => 'required|numeric',
        //     '*.city_id'             => 'required|numeric',  
        //     '*.zipcode'             => 'required|numeric|digits_between:5,6',
        // ])->validate();

        // foreach ($rows as $row) 
        // {   
        //     $slug = str_replace(' ', '-', strtolower($row['community_name']));
        //     if(Communities::where('slug', $slug)->count() == 0)
        //     {   
        //         $community = Communities::create([
        //             'name'              => $row['community_name'],
        //             'slug'              => $slug,
        //             'contact_person'    => $row['contact_person'],
        //             'contact_email'     => $row['contact_email'],
        //             'contact_number'    => $row['contact_number'],
        //             'location'          => $row['location'],
        //             'description'       => $row['description'],
        //             'state_id'          => $row['state_id'],
        //             'city_id'           => $row['city_id'],
        //             'zipcode'           => $row['zipcode'],
        //             'logo'              => $row['logo'],
        //             'banner'            => $row['banner'],
        //             'marker_image'      => $row['map_marker'],
        //             'lat'               => $row['latitude'],
        //             'lng'               => $row['longitude'],
        //             'map_zoom'          => 16,
        //             'map_type_id'       => 'hybrid',
        //             'gallery'           => $row['community_gallery']
        //         ]);

        //         $plot = Plots::create([
        //             'community_id' => $community->id,
        //         ]);
    
        //         $legend_group = LegendGroups::create([
        //             'plot_id' => $plot->id,
        //             'groupname' => 'Color Legends',
        //             'status_id' =>2
        //         ]);
    
        //         Plots::where('id', $plot->id)->update([
        //             'legend_group_id' => $legend_group->id
        //         ]);
        //     }
        // }
    }
}
