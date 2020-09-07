<?php

namespace App\Http\Controllers\Admin;

use App\Models\Homes;
use App\Models\ColorSchemes;
use App\Models\ColorSchemeUpgrade;
use App\Models\HomeFeatures;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class HomeController extends Controller
{
    public $data;

    public function __construct()
    {
        $this->data['page_title'] = 'Homes';
        $this->data['menu'] = 'homes';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homes = Homes::where('parent_id', 0)->get();
        $this->data['menu'] = 'homes';
        return view('admin.homes.home-index', compact('homes'))->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/homes/', $filename);
        }
        Homes::create([
            'title' => $request->title,
            'slug' => str_slug($request->title, '-'),
            'specifications' => $request->specifications,
            'price' => $request->price,
            'status_id' => $request->status,
            'img' => isset($filename) ? $filename : '',
            'area' => $request->area,
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'garage' => $request->garage,
        ]);
        return redirect()->back()->with('message', 'Home data added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\home  $home
     * @return \Illuminate\Http\Response
     */
    public function show(home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\home  $home
     * @return \Illuminate\Http\Response
     */
    public function edit($home_id)
    {
        $id = base64_decode($home_id);
        $home = Homes::whereId($id)->first();
        //echo '<pre>';print_r($home);die;
        $this->data['menu'] = 'homes';
        return view('admin.homes.home-edit', compact('home'))->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\home  $home
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = base64_decode($request->id);
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/homes/', $filename);
            Homes::whereId($id)->update([
                'img' => $filename,
            ]);
        }
        Homes::whereId($id)->update([
            'title' => $request->title,
            'specifications' => $request->specifications,
            'price' => $request->price,
            'status_id' => $request->status,
            'area' => $request->area,
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'garage' => $request->garage,
        ]);

        return redirect()->back()->with('message', 'Home Updated.');
    }
    public function hotspotUpdate(Request $request)
    {
        echo $id = base64_decode($request->home_id);
        echo $request->position;

        Homes::whereId($id)->update([
            'hotspot' => $request->position,
        ]);
        //die('here');
        return response()->json(['success' => 1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\home  $home
     * @return \Illuminate\Http\Response
     */

    public function upload_home_type_csv(Request $request)
    {
        $parent_id = base64_decode($request->home_id);
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);
        if ($request->isMethod('post')) {
            $data = $request->all();
            $csvfile = $request->file('csv_file');
            $handle = fopen($csvfile, "r");
            $header = fgetcsv($handle, 0, ',');
            $countheader = count($header);
            while (($datad = fgetcsv($handle, 1000, ",")) !== false) {
                $f_data['parent_id'] = $parent_id;
                $f_data['title'] = $datad[1];
                $f_data['slug'] = str_slug($datad[1], '-');
                $f_data['img'] = 'placeholder.png';
                $f_data['specifications'] = $datad[2];
                $f_data['area'] = $datad[3];
                $f_data['bedroom'] = $datad[4];
                $f_data['bathroom'] = $datad[5];
                $f_data['garage'] = $datad[6];
                $f_data['price'] = $datad[7];
                $f_data['status_id'] = 2;
                    
                Homes::create($f_data);
                
            }
        }
        return redirect()->back()->with('success', 'Elevations Type Added Successfully');
    }
    public function destroy($id)
    {
        $home = Homes::find($id);
        if ($home != null) {
            $home->delete();
            return redirect()->back()->with('message', 'Home deleted.');
        }
    }

    public function listColorScheme($home_id)
    {
        $id = base64_decode($home_id);
        $homes = Homes::where('id', $id)->first();
        $color_schemes = ColorSchemes::where('home_id', $id)->orderBy('priority')->get();
        $this->data['menu'] = 'homes';
        return view('admin.homes.home-color-scheme', compact('color_schemes', 'homes'))->with($this->data);
    }
    public function listTypeColorScheme($home_id)
    {
        $id = base64_decode($home_id);
        $homes = Homes::where('id', $id)->first();
        $color_schemes = ColorSchemes::where('home_id', $id)->orderBy('priority')->get();
        $this->data['menu'] = 'homes';
        return view('admin.homes.home-type-color-scheme', compact('color_schemes', 'homes'))->with($this->data);
    }
    public function listHomeElevationType($home_id)
    {
        $id = base64_decode($home_id);
        $homes = Homes::where('id', $id)->first();
        $elevation_types = Homes::where('parent_id', $id)->get();
        $this->data['menu'] = 'homes';
        return view('admin.homes.home-elevation-type', compact('elevation_types', 'homes'))->with($this->data);
    }
    public function storeColorScheme(Request $request)
    {
        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/homes/', $filename);
        }
        if ($request->hasfile('base_img')) {
            $file = $request->file('base_img');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename2 = time() . '.' . $extension;
            $file->move('uploads/homes/', $filename2);
        }
        $color_scheme = ColorSchemes::create([
            'home_id' => base64_decode($request->home_id),
            'title' => $request->title,
            'img' => isset($filename) ? $filename : '',
            'base_img' => isset($filename2) ? $filename2 : '',
            'price' => $request->price,
            'priority' => 1,
        ]);
        //ColorSchemeUpgrade default entry to manage upgrade images
        $data = [
            ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 1, 'side' => 1],
            ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 1, 'side' => 0],
            ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 0, 'side' => 1],
            ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 1, 'side' => 1],
            ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 0, 'side' => 0],
            ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 1, 'side' => 0],
            ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 0, 'side' => 1],
            ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 0, 'side' => 0],
        ];

        ColorSchemeUpgrade::insert($data);
        return redirect()->back()->with('message', 'Color Scheme added.');
    }

    public function storeColorSchemeCSV(Request $request)
    {
        $home_id = base64_decode($request->home_id);
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);
        if ($request->isMethod('post')) {
            $data = $request->all();
            $csvfile = $request->file('csv_file');
            $handle = fopen($csvfile, "r");
            $header = fgetcsv($handle, 0, ',');
            $countheader = count($header);
            while (($datad = fgetcsv($handle, 1000, ",")) !== false) {
                $f_data['home_id'] = $home_id;
                $f_data['title'] = $datad[1];
                $f_data['price'] = $datad[2];
                $f_data['base_img'] = 'placeholder.png';
                $f_data['img'] = 'placeholder.png';
                $f_data['priority'] = 1;
                    
                $color_scheme = ColorSchemes::create($f_data);
                   
                //ColorSchemeUpgrade default entry to manage upgrade images
                $data = [
                        ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 1, 'side' => 1],
                        ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 1, 'side' => 0],
                        ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 0, 'side' => 1],
                        ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 1, 'side' => 1],
                        ['color_scheme_id' => $color_scheme->id, 'concrete' => 1, 'window' => 0, 'side' => 0],
                        ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 1, 'side' => 0],
                        ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 0, 'side' => 1],
                        ['color_scheme_id' => $color_scheme->id, 'concrete' => 0, 'window' => 0, 'side' => 0],
                    ];
                    ColorSchemeUpgrade::insert($data);
                
            }
        }

        return redirect()->back()->with('message', 'Color Scheme added.');
    }
    public function listFeature($color_scheme_id)
    {
        $id = base64_decode($color_scheme_id);
        $features = HomeFeatures::where(['color_scheme_id' => $id, 'upgraded' => 0])->orderBy('priority')->get();
        $home_id = ColorSchemes::where('id', $id)->get()->first();
        $homes = Homes::where('id', $home_id->home_id)->first();
        $color_scheme = ColorSchemes::where('id', $home_id->id)->first();
        $color_scheme_upgrades = ColorSchemeUpgrade::where('color_scheme_id', $id)->get();
        $this->data['home_id'] = base64_encode($home_id->home_id);
        //echo '<pre>';print_r($features);die;
        $this->data['menu'] = 'homes';
        return view('admin.homes.home-color-features', compact('features', 'homes', 'color_scheme', 'color_scheme_upgrades'))->with($this->data);
    }
    public function storeColorFeature(Request $request)
    {
        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/homes/', $filename);
        }

        $data = HomeFeatures::create([
            'color_scheme_id' => base64_decode($request->color_scheme_id),
            'title' => $request->title,
            'img' => isset($filename) ? $filename : '',
            'price' => $request->price,
            'priority' => 1,
            'stared' => isset($request->upgradable) ? $request->upgradable : '0',
            'upgrade_type' => isset($request->upgradable) ? $request->upgrade_type : '0',
            'material' => $request->material,
            'manufacturer' => $request->manufacturer,
            'name' => $request->name,
            'm_id' => $request->m_id,
        ]);
        return redirect()->back()->with('message', 'Feature added.');
    }
    public function storeColorSchemeFeatureCSV(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);
        $color_scheme_id = base64_decode($request->color_scheme_id);
        if ($request->isMethod('post')) {
            $data = $request->all();
            $csvfile = $request->file('csv_file');
            $handle = fopen($csvfile, "r");
            $header = fgetcsv($handle, 0, ',');
            $countheader = count($header);
            while (($datad = fgetcsv($handle, 1000, ",")) !== false) {
                $f_data['color_scheme_id'] = $color_scheme_id;
                $f_data['title'] = $datad[1];
                $f_data['price'] = $datad[2];
                $f_data['img'] = 'placeholder.png';
                $f_data['priority'] = 1;
                $f_data['stared'] = $datad[3];
                $f_data['upgrade_type'] = isset($datad[4]) ? $datad[4] : '0';
                $f_data['material'] = $datad[5];
                $f_data['manufacturer'] = $datad[6];
                $f_data['name'] = $datad[7];
                $f_data['m_id'] = $datad[8];

                HomeFeatures::create($f_data);
            }
        }

        return redirect()->back()->with('message', 'Features added.');
    }

    public function checkUpgradeFeature(Request $request)
    {
        $data = HomeFeatures::where([
            'stared' => 1,
            'upgraded' => 1,
            'group_id' => $request->feature_id,
        ])->first();
        if (count($data) == 1) {
            $msg = 'Upgrade option exists';
        } else {
            $msg = 'Upgrade option does not exists';
        }
        return response()->json(['message' => $msg, 'data' => $data]);
    }
    public function storeUpgradeFeature(Request $request)
    {
        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/homes/', $filename);
        }
        if ($request->upgrade_exists) {
            $data = HomeFeatures::where(['group_id' => $request->group_id, 'upgraded' => 1])->update([
                'title' => $request->title,
                'price' => $request->price,
                'priority' => 1,
                'stared' => 1,
                'upgraded' => 1,
                'material' => $request->material,
                'manufacturer' => $request->manufacturer,
                'name' => $request->name,
                'm_id' => $request->m_id,
            ]);
            if ($request->hasfile('img')) {
                HomeFeatures::where(['group_id' => $request->group_id, 'upgraded' => 1])->update([
                    'img' => $filename,
                ]);
            }
            $msg = 'Upgrade Feature updated.';
        } else {
            $data = HomeFeatures::create([
                'color_scheme_id' => base64_decode($request->color_scheme_id),
                'title' => $request->title,
                'img' => isset($filename) ? $filename : '',
                'price' => $request->price,
                'priority' => 1,
                'stared' => 1,
                'upgraded' => 1,
                'material' => $request->material,
                'manufacturer' => $request->manufacturer,
                'name' => $request->name,
                'm_id' => $request->m_id,
                'upgrade_type' => $request->upgrade_type,
                'group_id' => $request->group_id,
            ]);
            $data = HomeFeatures::whereId($request->feature_id)->update(['group_id' => $request->group_id]);
            $msg = 'Upgrade Feature added.';
        }
        return redirect()->back()->with('message', $msg);
    }

    public function storeUpgradeImage(Request $request)
    {
        if ($request->hasfile('img')) {
            // die("test");
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/homes/', $filename);
            $data = ColorSchemeUpgrade::where('id', base64_decode($request->upgrade_id))->update([
                "img" => $filename,
            ]);
            return redirect()->back()->with('message', 'Upgrade Image Changed.');
        } else {
            return redirect()->back()->with('error', 'Please upload upgrade image.');
        }
    }

    public function editColorScheme($color_scheme_id)
    {
        $id = base64_decode($color_scheme_id);
        $color_scheme = ColorSchemes::where('id', $id)->first();
        $homes = Homes::where('id', $color_scheme->home_id)->first();
        $this->data['menu'] = 'homes';
        $this->data['home_id'] = base64_encode($color_scheme->home_id);
        return view('admin.homes.home-color-scheme-edit', compact('color_scheme', 'homes'))->with($this->data);
    }

    public function editElevationType($type_id)
    {
        $id = base64_decode($type_id);
        $elevation_type = Homes::whereId($id)->first();
        $this->data['menu'] = 'homes';
        return view('admin.homes.home-elevation-type-edit', compact('elevation_type'))->with($this->data);
    }
    public function updateElevation(Request $request)
    {
        $id = base64_decode($request->id);
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/homes/', $filename);
            Homes::whereId($id)->update([
                'img' => $filename,
            ]);
        }
        Homes::whereId($id)->update([
            'title' => $request->title,
            'specifications' => $request->specifications,
            'price' => $request->price,
            'status_id' => $request->status,
        ]);

        return redirect()->back()->with('message', 'Elevation Type Updated.');
    }
    public function updateColorScheme(Request $request)
    {
        $id = base64_decode($request->id);
        ColorSchemes::whereId($id)->update([
            'title' => $request->title,
            'price' => $request->price,
            'priority' => $request->priority,
        ]);
        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/homes/', $filename);
            ColorSchemes::whereId($id)->update([
                'img' => $filename,
            ]);
        }
        if ($request->hasfile('base_img')) {
            $file = $request->file('base_img');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename2 = time() . '.' . $extension;
            $file->move('uploads/homes/', $filename2);
            ColorSchemes::whereId($id)->update([
                'base_img' => $filename2,
            ]);
        }

        return redirect()->back()->with('message', 'Color scheme Updated.');
    }

    public function destroyColorScheme($id)
    {
        $color_scheme = ColorSchemes::find($id);
        if ($color_scheme != null) {
            $color_scheme->delete();
            return redirect()->back()->with('message', 'Color Scheme deleted.');
        }
    }
    public function destroyElevationType($id)
    {
        $el_type = Homes::find($id);
        if ($el_type != null) {
            $el_type->delete();
            return redirect()->back()->with('message', 'Elevation type deleted.');
        }
    }

    public function editFeature($feature_id)
    {
        $id = base64_decode($feature_id);
        $feature = HomeFeatures::where('id', $id)->first();
        $home_id = ColorSchemes::where('id', $feature->color_scheme_id)->get()->first();
        $homes = Homes::where('id', $home_id->home_id)->first();
        $color_scheme = ColorSchemes::where('id', $home_id->id)->first();
        $this->data['menu'] = 'homes';
        $this->data['color_scheme_id'] = base64_encode($feature->color_scheme_id);
        return view('admin.homes.home-color-features-edit', compact('feature', 'home_id', 'homes', 'color_scheme'))->with($this->data);
    }
    public function updateFeature(Request $request)
    {
        $id = base64_decode($request->id);
        if ($request->hasfile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/homes/', $filename);
            HomeFeatures::whereId($id)->update([
                'img' => $filename,
            ]);
        }
        $data = HomeFeatures::whereId($id)->update([
            'group_id' => $id,
            'title' => $request->title,
            'price' => $request->price,
            'priority' => 1,
            'stared' => $request->upgrade_option,
            'material' => $request->material,
            'manufacturer' => $request->manufacturer,
            'name' => $request->name,
            'm_id' => $request->m_id,
        ]);

        return redirect()->back()->with('message', 'Feature Updated.');
    }
    public function destroyColorFeature($id)
    {
        $color_feature = HomeFeatures::find($id);
        if ($color_feature != null) {
            $color_feature->delete();
            return redirect()->back()->with('message', 'Color Feature deleted.');
        }
    }

    public function updateStatus($id)
    {
        $homes = Homes::find($id);

        $home_id = $homes->id;
        $status = $homes->status;

        $result = 0;

        if ($status == 0) {
            Homes::where('id', $home_id)->update(['status' => 1]);
            $result = 1;
        } else {
            Homes::where('id', $home_id)->update(['status' => 0]);
            $result = 0;
        }
        return json_encode($result);
    }

    public function createElevation(Request $request)
    {
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/homes/', $filename);
        }
        //die($filename);
        $id = base64_decode($request->home_id);
        Homes::create([
            'parent_id' => $id,
            'title' => $request->title,
            'slug' => str_slug($request->title, '-'),
            'specifications' => $request->specifications,
            'price' => $request->price,
            'status_id' => $request->status,
            'img' => isset($filename) ? $filename : '',
            'area' => $request->area,
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'garage' => $request->garage,
        ]);
        return redirect()->back()->with('message', 'Home elevation type added.');
    }

    public function gallery($id = null)
    {
        $id = base64_decode($id);
        $this->data['home'] = Homes::where('id', $id)->get()->first();
        return view('admin.homes.home-gallery')->with($this->data);
    }
    public function typeGallery($id = null)
    {
        $id = base64_decode($id);
        $this->data['home'] = Homes::where('id', $id)->get()->first();
        $this->data['parent_home'] = Homes::where('id', $this->data['home']->parent_id)->get()->first();
        return view('admin.homes.home-type-gallery')->with($this->data);
    }

    public function uploadHomeFile(Request $request)
    {
        $request->validate([
            'uploadHomeImage' => 'image|mimes:jpeg,png,jpg',
        ]);
        $id = $request->home_id;
        $gallery = Homes::whereId($id)->first();
        $gallery = explode(',', $gallery->gallery);
        if ($request->hasfile('uploadHomeImage')) {
            $file = $request->file('uploadHomeImage');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/homes/'), $filename);
            array_push($gallery, $filename);
            Homes::whereId($id)->update(['gallery' => implode(',', $gallery)]);
        }

        return response()->json(['message' => 'Image Upload Successfully', 'class_name' => 'alert-success']);
    }
}
