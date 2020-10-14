<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use Validator;
use App\Validators\FloorValidator;
use Illuminate\Support\Facades\Hash;
use App\Models\Settings;
use App\Admins;
use App\Models\History;
USE DB;
use File;
use Crypt;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->title = 'Settings';
        $this->data['page_title'] = $this->title;
        $this->data['menu'] = 'settings';
        $this->data['statusArray'] = $this->getStatusArray();
    }

    public function index()
    {
        $admins = Admins::where('admin_role_id',1)->get();
        $setting = Settings::where('status', 1)->get();
        $this->data['setting'] = $setting;
        $this->data['menu'] = 'settings';
        $this->data['admins'] = $admins;
        return view('admin.settings.index')->with($this->data);
    }

    
    public function update(Request $request)
    {
        $data = $request->except(['_token']);
        foreach($data as $key => $value)
        {
            if ($request->file($key)) 
            {
                $value1 = $request->file($key);
                $value = time().'.'.$value1->getClientOriginalExtension();
                $destinationImagePath = public_path('/uploads/');
                $uploadStatus = $value1->move($destinationImagePath,$value);
            }
            $settings = Settings::where('name',$key)->update(['value'=>$value]);
        }
        return redirect()->back()->with('success', 'Settings Updated.');
    }

    public function updateAdmins(Request $request, $id)
    {
        $users = Admins::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->mobile = $request->mobile;
        $users->username = $request->username;
        $users->status_id = $request->status;

        $users->save();

        return redirect()->back()->with('success', 'Admin Data Updated.');
    }
    public function settings()
    {
        # code...
        return  Settings::all();
    }

    public function importHistory(){
        $this->data['history'] = History::where('type','image')->orderBy('id', 'desc')->take(15)->get();
        foreach($this->data['history'] as $history)
        {
            $uploaded_by = Admins::whereId($history->imported_by)->get(['name'])->first();
            $uploaded_by = $uploaded_by->name;
            $history['name'] = $uploaded_by; 
        }
        // dd($this->data);
        return view('admin.settings.import-history')->with($this->data);
    }
    public function importImagesHistory(){
        $this->data['history'] = History::where('type','image')->orderBy('id', 'desc')->take(15)->get();
        foreach($this->data['history'] as $history)
        {
            $uploaded_by = Admins::whereId($history->imported_by)->get(['name'])->first();
            $uploaded_by = $uploaded_by->name;
            $history['name'] = $uploaded_by; 
        }
        return view('admin.settings.import-images-history')->with($this->data);
    }
}