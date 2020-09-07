<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\States;
use App\Models\Cities;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {   
        $list = Cities::all();
        foreach ($list as $key => $value) {
            $cities[$value->id] = $value->city.' - '.$value->state->code;
        }
        return view('welcome')->with(compact('cities'));
    }

    /* public function scode()
    {
        $cities = Cities::all();
        foreach ($cities as $key => $city) {
            $sid = States::where('code', $city->code)->get()->first();
            Cities::where('id', $city->id)->update(['state_id' => $sid->id]);
        }
        echo 'done'; die;
    } */
}
