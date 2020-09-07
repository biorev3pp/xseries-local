<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use Validator;
use App\Validators\FloorValidator;
use Illuminate\Support\Facades\Hash;
use App\Models\Leads;
USE DB;
use File;
use Crypt;

class LeadsController extends Controller
{
    public function __construct()
    {
        $this->title = 'Leads';
        $this->data['page_title'] = $this->title;
        $this->data['menu'] = 'leads';
    }

    public function index()
    {
        $leads = Leads::all();
        $this->data['leads'] = $leads;
        return view('admin.leads.index')->with($this->data);
    }

    public function updateLeads(Request $request, $id)
    {
        //echo $id;
        //echo '<pre>';print_r($request->name);die;
        $users = Leads::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->mobile = $request->mobile;
        if($request->password):
            $users->password = Hash::make($request->password);
        endif;
        $users->status = $request->status;

        $users->save();

        return redirect()->back()->with('success', 'Leads Updated Successfully');
    }

    public function deleteLeads($id)
    {
        $users = Leads::find($id);
        if ($users != null) 
        {
            $users->delete();
            return redirect()->back()->with('success', 'Leads Deleted Successfully');
        }
    }
}