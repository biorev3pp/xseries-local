<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use App\Models\Floor;
use App\Models\Features;
use App\Models\Homes;
use App\Models\ColorSchemes;
use App\Models\FloorAclSetting;
use Validator;
use App\Validators\FloorValidator;
USE DB;
use File;
use Crypt;
use Illuminate\Support\Str;

class FeaturesController extends Controller
{
    public function __construct()
    {
        $this->title = 'Features';
        $this->data['page_title'] = $this->title;
        $this->data['menu'] = 'floors';
    }

    public function index($id)
    {
        $floorid = base64_decode($id);
        $floor = Floor::where('id',$floorid)->first();
        $features = Features::with('feature_groups')->where('floor_id',$floorid)->where('parent_id',0)->get();
        $this->data['floor'] = $floor;
        $this->data['features'] = $features;
        return view('admin.features.index')->with($this->data);
    }
    public function checkFeaturesLimit(Request $request)
    {
        $floor_id = base64_decode($request['id']);
        if(Features::where('floor_id',$floor_id)->get()->count()>=56)
        {
            return ['false'];
        }
        else
        {
               return ['true']; 
        }
    }

    public function create($id)
    {
        $floorid = base64_decode($id);
        $floor = Floor::find($floorid);
        $features = Features::all()->where('floor_id',$floorid)->where('parent_id',0);
        $this->data['data'] = '';
        $this->data['floor'] = $floor;
        $this->data['features'] = $features;
        return view('admin.features.create')->with($this->data);
    }

    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'title'         =>  'required',
            'floor_id'      =>  '',
            'parent_id'     =>  '',
            'image'         =>  'image|mimes:jpeg,png,jpg|max:2048',
            'price'         =>  '',
        ]);
   
        $features = new Features;
        $features->title = $request->title;
        $features->floor_id = $request->floor_id;
        $features->parent_id = $request->parent_id;

        if ($request->file('image')) 
        {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationImagePath = public_path('/uploads/features/');
            $uploadStatus = $image->move($destinationImagePath,$imageName);
            $features->image = $imageName;
        }

        $features->price = $request->price;

        $rowCount = Features::count();
        $request['order_no'] = $rowCount+1;
        
        $features->order_no = $request['order_no'];


        $features->save();

        return redirect()->back()->with('success', 'Features Added Successfully');
    }

    public function edit(Request $request, $id)
    {
        $id = base64_decode($id);
        $data = Features::with('floor')->whereId($id)->first();
        $floor = Floor::where('id',$data->floor_id)->first();
        //$features = Features::where('floor_id',$data->floor_id)->where('parent_id',0)->where('id','!=',$id)->pluck('title','id')->prepend('None','0');
        $features = Features::all()->where('floor_id',$data->floor_id)->where('parent_id',0)->where('id','!=',$id);
        $this->data['floor'] = $floor;
        $this->data['data'] = $data;
        $this->data['features'] = $features;
        return view('admin.features.edit')->with($this->data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'         =>  'required',
            'floor_id'      =>  '',
            'parent_id'     =>  '',
            'image'         =>  'image|mimes:jpeg,png,jpg|max:2048',
            'price'         =>  '',
        ]);
   
        $features = Features::find($id);
        $features->title = $request->title;
        $features->floor_id = $request->floor_id;
        $features->parent_id = $request->parent_id;

        if ($request->file('image')) 
        {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $destinationImagePath = public_path('/uploads/features/');
            $uploadStatus = $image->move($destinationImagePath,$imageName);
            $features->image = $imageName;
        }

        $features->price = $request->price;

        $rowCount = Features::count();
        $request['order_no'] = $rowCount+1;
        
        $features->order_no = $request['order_no'];


        $features->save();

        return redirect()->back()->with('success', 'Features Updated');
    }
    
    public function delete(Request $request)
    {
        $id = base64_decode($request->delete_id);
        $features = Features::whereId($id)->first();
       
        if($features->image!='' || $features->image!=null || !empty($features->image))
        {
            $filePath = public_path().'/uploads/features/'.$features->image;
            File::delete($filePath);
        }
        FloorAclSetting::where('feature_id',$id)->delete();
        if($features->parent_id == 0)
        {
            $childFeatures = Features::where('parent_id',$features->id)->pluck('id');
            Features::whereIn('id',$childFeatures)->delete();   
        }
        $result = Features::whereId($id)->delete();
        if($result)
        {
            return redirect()->back()->with('success', 'Features Deleted Successfully');
        }
        
    }

    public function getACLRow(Request $request)
    {
        if($request->ajax())
        {
            $floorid = $request->floorid;
            $idString = Str::random(5);
            $features = Features::where('floor_id',$floorid)->where('parent_id','!=',0)->pluck('title','id');
            $this->data['features'] = $features;
            $this->data['index'] = $request->index;
            $this->data['idstr'] = $idString;
            return view('admin.features.acl_row')->with($this->data)->render(); 
        }
        return "Unauthorised Access !!!";
    }

    public function setACLOptions($id)
    {
        $floorid = base64_decode($id);
        $floor = Floor::find($floorid);
        $idString = Str::random(5);
        $features = Features::where('floor_id',$floorid)->where('parent_id','!=',0)->pluck('title','id');
        $aclSettings = FloorAclSetting::where('floor_id',$floorid)->get();
        $this->data['data'] = '';
        $this->data['floor'] = $floor;
        $this->data['features'] = $features;
        $this->data['idstr'] = $idString;
        $this->data['acl_settings'] = $aclSettings->toArray();
        return view('admin.features.acl_settings')->with($this->data);
    }

    public function saveAclSettings(Request $request)
    {
        $aclData = json_decode($request->acl_data,TRUE);
        $floorid = $request->floorid;
        $prepareData = [];
        $i = 0;
        foreach($aclData as $key=>$value)
        {
            $i++;
            $prepareData[] = [
                'feature_id'    => $key,
                'floor_id'      => $floorid,
                'conflicts'     => $value['conflicts'],
                'dependency'    => $value['dependency'],
                'togetherness'  => $value['togetherness'],
            ];
        }
        //In case of update 
        $result = FloorAclSetting::where('floor_id',$floorid)->delete();
        $result = FloorAclSetting::insert($prepareData);
        if($result)
        {
            return redirect()->back()->with('success', 'ACL Settings Updated');
        }
        else
        {
            return redirect()->back();
        }
    }

    public function deleteAclSettings($id)
    {
        $result  = FloorAclSetting::find($id);
        if($result != null)
        {
            $result->delete();
            return redirect()->back()->with('success', 'ACL Settings Deleted Successfully');
        }
    }

    public function reOrderList(Request $request)
    {
        $orderData = $request->order;
        foreach($orderData as $order)
        {
            Features::where('id',$order['id'])->update(['parent_id'=>$order['parent_id'],'order_no'=>$order['order']]);
        }
    }
}