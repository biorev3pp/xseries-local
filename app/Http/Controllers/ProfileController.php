<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use Validator;
use App\Admins;
//use App\Models\UserRoles;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->title = 'User Profile';
        $this->data['page_title'] = $this->title;
        $this->data['menu'] = 'profiles';
    }

    public function index()
    {
        $userId = Auth::user()->id;
        $users = Users::where('id', $userId)->with('roles')->first();
        $this->data['data'] = $users;
        $this->data['menu'] = 'profiles';
        return view('user.index',compact('users','users'))->with($this->data);
    }

    public function edit($id)
    {
        $this->data['menu'] = 'profiles';
        $id = base64_decode($id);
        $form = Users::find($id);
        $userId = Auth::user()->id;
        $users = Users::where('id', $userId)->with('roles')->first();
        return view('user.profile.edit', compact('users','form'))->with($this->data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      =>  'required',
            'email'     =>  'required|email|unique:admins,email,'. $id .'',
            'mobile'      =>  'required',
        ]);
        $form = Users::find($id);
        $form->name = $request->name;
        $form->email = $request->email;
        $form->mobile = $request->mobile;

        $form->save();
        return redirect('admin/profile')->with("success",'Profile Updated Successfully');
    }

    public function showChangePasswordForm()
    {
        $this->data['menu'] = 'changepasswords';
        return view('user.profile.changepassword')->with($this->data);
    }

    public function changePassword(Request $request)
    {
        $email = Auth::user()->email;
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) 
        {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0)
        {
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $admin = Auth::user();
        $admin->password = bcrypt($request->get('new-password'));
        $admin->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }
}