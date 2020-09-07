<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\UserSettings;
use App\Admins;
use App\Models\Communities;
use App\Models\Homes;
use DB;
use File;
use Crypt;
//use App\Http\Controllers\User\Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->title = 'User Settings';
        $this->data['page_title'] = $this->title;
        $this->data['menu'] = 'User settings';
        // $this->data['statusArray'] = $this->getStatusArray();
    }

    public function index()
    {
        $user = Admins::whereId(3)->first();
        //echo '<pre>';print_r($user);die;
        $setting = UserSettings::where(['user_id' => $user->id, 'status' => 1])->first();

        $this->data['setting'] = $setting;
        $this->data['menu'] = 'user_dashboard';
        $this->data['user'] = $user;
        return view('user.settings')->with($this->data);
    }

    /*public function update(Request $request)
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
        return redirect()->back()->with('success', 'Settings Updated Successfully');
    }
*/

    public function updateUsers(Request $request)
    {
        //echo $request->users_id;die;

        //$user = Users::find($request->users_id);
        $img_name = "";
        if ($request->hasFile('profileimage')) {
            $profile_image = $request->file('profileimage');
            // echo  $profile_image;
            $img_name = $profile_image->getClientOriginalName();
            $profile_image->move(public_path('/uploads'), $img_name);
            $user->profile_image = $request->file('profileimage')->getClientOriginalName();
        }

        Admins::where('id', $request->users_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'username' => $request->username,
            'status_id' => $request->status_id,
            'profile_image' => $img_name,
        ]);

        return redirect()
            ->back()
            ->with('success', 'User Data Updated Successfully');
    }

    public function showChangePasswordForm(Request $request)
    {
        $this->data['menu'] = 'changepasswords';
        $this->data['community']=($request->session()->has('community_slug'))?Communities::where('slug',$request->session()->get('community_slug'))->first():'';
        $this->data['home'] = ($request->session()->has('home_id'))?Homes::where('id',$request->session()->get('home_id'))->first():'';
        $this->data['home_type'] = null;
        if($request->session()->has('home_id')){
            $this->data['home_type'] = Homes::where('id',$request->session()->get('home_id'))->first();
        }
        return view('user.changepassword')->with($this->data);
    }

    public function changePassword(Request $request)
    {
        //      return $request;

        $user = Admins::where('password', $request->current_password)->first();
        //print_r($user); die;

        if (Hash::check($request->current_password, $user->password)) {
            // success
            return redirect()
                ->back()
                ->with("success", "You have has matches.");
        }

        if (strcmp($request->current_password, $request->new_password == 0)) {
            //Current password and new password are same
            return redirect()
                ->back()
                ->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        //$user = Users::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        return redirect()
            ->back()
            ->with("success", "Password changed successfully !");
    }
}
