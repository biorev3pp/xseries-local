<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use App\Models\Floor;
use App\Models\Features;
use App\Models\Homes;
use App\Models\ColorSchemes;
use Validator;
use App\Validators\FloorValidator;
USE DB;
use File;
use Crypt;

class FloorController extends Controller
{
    public function __construct()
    {
        $this->title = 'Floors';
        $this->data['page_title'] = $this->title;
        $this->data['menu'] = 'floors';
    }

    public function index()
    {
        $this->title = 'Floors';
        $this->data['page_title'] = $this->title;
        $homes = Homes::all();
        $floors =[];
        foreach ($homes as $key => $home) 
        {
            $floors[$home->id]['floor'] = Floor::where('home_id', $home->id)->get();
            $floors[$home->id]['home'] = $home;
            $this->data['floors'] = $floors;
            $this->data['homes'] = $homes;
        }

        return view('admin.floors.index')->with($this->data);
    }

    public function create()
    {
        $this->title = 'Floors';
        $this->data['page_title'] = $this->title;
        $homes = Homes::all();
        $this->data['homes'] = $homes;
        return view('admin.floors.create')->with($this->data);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         =>  'required',
            'home_id'       =>  '',
            'image'         =>  'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $floors = new Floor;
        $floors->title = $request->title;
        $floors->home_id = $request->home_id;

        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $destinationImagePath = public_path('/uploads/floors/');
        $uploadStatus = $image->move($destinationImagePath,$imageName);

        $floors->image = $imageName;


        $floors->save();

        return redirect()->back()->with('message', 'Floors Added Successfully.');
    }

    public function edit(Request $request, $id)
    {
        $this->title = 'Floors';
        $this->data['page_title'] = $this->title;
        $id = base64_decode($id);
        $floors = Floor::find($id);
        $homess = Homes::find($floors->home_id);
        $homes = Homes::all();
        $this->data['homes'] = $homes;
        return view('admin.floors.edit', compact('floors', 'id','homess'))->with($this->data);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'         =>  'required',
            'home_id'       =>  '',
            'image'         =>  'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $floors = Floor::find($id);
        $floors->title = $request->title;
        $floors->home_id = $request->home_id;

        if ($request->file('image')) 
        {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationImagePath = public_path('/uploads/floors/');
            $uploadStatus = $image->move($destinationImagePath,$imageName);
            $floors->image = $imageName;
        }


        $floors->save();

        return redirect()->back()->with('success', 'Floor Updated ');
    }

    public function delete($id)
    {
        $floors = Floor::find($id);
        if ($floors != null) 
        {
            $floors->delete();
            return redirect()->back()->with('success', 'Floor Deleted Successfully');
        }
    }
}