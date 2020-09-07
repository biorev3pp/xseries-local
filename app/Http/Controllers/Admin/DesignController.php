<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeDesignOptions;
use App\Models\HomeDesignGroups;
use App\Models\HomeDesignTypes;
use App\Models\HomeDesigns;
use App\Models\HomeTypeOptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Homes;
USE DB;

class DesignController extends Controller
{   
    public $data;

    public function __construct(){
        $this->data['page_title'] = 'Designs';
        $this->data['menu'] = 'designs';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listDesigns($home_design_type_id)
    {   
        $id=base64_decode($home_design_type_id);
        $designs = HomeDesigns::with('HomeDesignTypes')->where('home_design_type_id', $id)->get();
        $group_id = HomeDesignTypes::where('id', $id)->get()->first();
        $design_groups = HomeDesignGroups::where('id',$group_id->design_group_id)->get()->first();
        $homes = Homes::where('id',$design_groups->home_id)->get()->first();
        //echo '<pre>';print_r($designs);die;
        $this->data['menu'] = 'designs';
        $this->data['home_design_type_id'] = $home_design_type_id;
        $this->data['slug'] = $group_id->slug;
        $this->data['design_group_id'] = base64_encode($group_id->design_group_id);
        $this->data['home_design_type_id'] = $id;
        return view('admin.designs.index',compact('designs','group_id','design_groups','homes'))->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filename="";
        if($request->hasfile('file_design')) 
        { 
          $file = $request->file('file_design');
          $extension = $file->getClientOriginalExtension(); // getting image extension
          $filename =time().'.'.$extension;
          $file->move('uploads/designs/', $filename);
        }
        //die($filename);
        HomeDesigns::create([
            //'home_design_type_id'=>base64_decode($request->home_design_type_id),
            'home_design_type_id'=>$request->home_design_type_id,
            'design'=>$request->title,
            'slug'=> str_replace(' ', '-', $request->title),
            'image'=>$filename,
            'is_designer'=>$request->is_designer,
            'status_id'=>$request->status,
            
        ]);
        return redirect()->back()->with('message', 'Design added successfully.');
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
    public function edit($designs_id)
    {
        $id=base64_decode($designs_id);
        $designs = HomeDesigns::with('HomeDesignTypes')->whereId($id)->first();

        /*$group_id = HomeDesignTypes::where('id', $id)->get()->first();
        $design_groups = HomeDesignGroups::where('id',$group_id->design_group_id)->get()->first();
        $homes = Homes::where('id',$design_groups->home_id)->get()->first();*/


        $group_id = HomeDesignTypes::where('id', $designs->home_design_type_id)->get()->first();

        $design_groups = HomeDesignGroups::where('id',$group_id->design_group_id)->get()->first();

        $homes = Homes::where('id',$design_groups->home_id)->get()->first();

        $this->data['design_group_id'] = base64_encode($designs->HomeDesignTypes->design_group_id);
        //echo '<pre>';print_r($home);die;
        $this->data['menu'] = 'home_design';
        return view('admin.designs.edit',compact('designs','group_id','design_groups','homes'))->with($this->data);
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
        $id=base64_decode($request->id);
        if($request->hasfile('file')) 
        { 
          $file = $request->file('file');
          $extension = $file->getClientOriginalExtension(); // getting image extension
          $filename =time().'.'.$extension;
          $file->move('uploads/designs/', $filename);
          HomeDesigns::whereId($id)->update([
            'image'=>$filename,
            ]);
        }
        HomeDesigns::whereId($id)->update([
            'design'=>$request->title,
            'status_id'=>$request->status,
            'slug'=> str_replace(' ', '-', $request->title),
            
        ]);

        return redirect()->back()->with('message', 'Design Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\home  $home
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    { 
        $id=base64_decode($request->design_id);
        $home=HomeDesigns::whereId($id)->delete();
        return redirect()->back()->with('message', 'Design deleted successfully.');
    }

    
    public function listDesignGroup($home_id)
    {   
        $id=base64_decode($home_id);
        $design_groups = HomeDesignGroups::where('home_id',$id)->get();
        //echo '<pre>';print_r($design_groups);die;
        $this->data['menu'] = 'design_groups';
        $this->data['home_id'] = $home_id;
        return view('admin.designs.design-groups-index',compact('design_groups'))->with($this->data);
    }
    public function storeDesignGroup(Request $request)
    {
        if($request->hasfile('file_design')) 
        { 
          $file = $request->file('file_design');
          $extension = $file->getClientOriginalExtension(); // getting image extension
          $filename =time().'.'.$extension;
          $file->move('uploads/designs/', $filename);
        }
        
        //die($filename);
        $data=HomeDesignGroups::create([
            /*'home_id' =>base64_decode($request->home_id),*/
            'home_id' =>$request->home_id,
            'title'=>$request->title,
            'img'=>$filename,
            'status_id'=>$request->status,
        ]);
        //echo '<pre>';echo $data->id;die;

        return redirect()->back()->with('message', 'Design Group added successfully.');
    }
    public function editDesignGroup($design_group_id)
    {
        $id=base64_decode($design_group_id);
        $design_group = HomeDesignGroups::where('id',$id)->first();
        //echo '<pre>';print_r($feature);die;
        $this->data['menu'] = 'design_groups';
        $this->data['home_id'] = base64_encode($design_group->home_id);
        $this->data['title'] = $design_group->title;
        return view('admin.designs.design-groups-edit',compact('design_group'))->with($this->data);
    }
    public function updateDesignGroup(Request $request)
    {
        $id=base64_decode($request->id);
        if($request->hasfile('file')) 
        { 
          $file = $request->file('file');
          $extension = $file->getClientOriginalExtension(); // getting image extension
          $filename =time().'.'.$extension;
          $file->move('uploads/designs/', $filename);
          HomeDesignGroups::whereId($id)->update([
            'img'=>$filename,
          ]);
        }
        
        //die($filename);
        $data=HomeDesignGroups::whereId($id)->update([
            'title'=>$request->title,
            'status_id'=>$request->status,
        ]);
        

        return redirect()->back()->with('message', 'Design Group Updated.');
    }
    
    public function destroyDesignGroup(Request $request)
    {   
        $id=base64_decode($request->design_group_id);
        HomeDesignGroups::whereId($id)->delete();
        return redirect()->back()->with('message', 'Design Group deleted successfully.');
    }

    public function listDesignType($design_group_id)
    {   
        $id=base64_decode($design_group_id);
        $design_types = HomeDesignTypes::where('design_group_id',$id)->get();
        $design_group=HomeDesignGroups::whereId($id)->first();
        //echo '<pre>';print_r($design_group);die;
        $this->data['menu'] = 'design_types';
        $this->data['design_group'] = $design_group;
        $this->data['design_group_id'] = $design_group_id;
        $this->data['home_id'] = base64_encode($design_group->home_id);
        return view('admin.designs.design-types-index',compact('design_types'))->with($this->data);
    }
    public function storeDesignType(Request $request)
    {
        if($request->hasfile('file')) 
        { 
          $file = $request->file('file');
          $extension = $file->getClientOriginalExtension(); // getting image extension
          $filename =time().'.'.$extension;
          $file->move('uploads/designs/', $filename);
        }
        
        //die($filename);
        $data=HomeDesignTypes::create([
            'design_group_id' =>base64_decode($request->design_group_id),
            'design'=>$request->title,
            'image'=>$filename,
            'slug' => str_replace(' ', '-', strtolower($request->title)),
            'status_id'=>$request->status,
        ]);

        $design_type_id = $data->id;
        $slug = $data->slug;
        $selfSlug = 'transparent'.$data->slug;

        $homeTypeOptions = new HomeTypeOptions;
        $homeTypeOptions->design_type_id = $design_type_id;
        $homeTypeOptions->patch = "transparent";
        $homeTypeOptions->slug = $slug;
        $homeTypeOptions->self_slug = $selfSlug;
        $homeTypeOptions->name = 'transparent';
        $homeTypeOptions->status_id = '2';
        $homeTypeOptions->default_color = 1;
        $homeTypeOptions->save();
         
        return redirect()->back()->with('message', 'Design Type added successfully.');
    }
    public function editDesignType($design_type_id)
    {
        $id=base64_decode($design_type_id);
        $design_type = HomeDesignTypes::with('HomeDesignGroups')->where('id',$id)->first();
       
        //echo '<pre>';print_r($design_type);die;
        $this->data['menu'] = 'design_types';
        $this->data['home_id'] = base64_encode($design_type->HomeDesignGroups->home_id);
        return view('admin.designs.design-types-edit',compact('design_type'))->with($this->data);
    }
    public function updateDesignType(Request $request)
    {
        $id=base64_decode($request->id);
        if($request->hasfile('file')) 
        { 
          $file = $request->file('file');
          $extension = $file->getClientOriginalExtension(); // getting image extension
          $filename =time().'.'.$extension;
          $file->move('uploads/designs/', $filename);
          HomeDesignTypes::whereId($id)->update([
            'image'=>$filename,
          ]);
        }
        
        //die($filename);
        $data=HomeDesignTypes::whereId($id)->update([
            'design'=>$request->title,
            'status_id'=>$request->status,
            'slug' => str_replace(' ', '-', strtolower($request->title)),
        ]);
        

        return redirect()->back()->with('message', 'Design Type Updated.');
    }
    
    public function destroyDesignType(Request $request)
    {   
        $id=base64_decode($request->design_type_id);
        HomeDesignTypes::whereId($id)->delete();
        return redirect()->back()->with('message', 'Design Type deleted successfully.');
    }

    public function listDesignOption($design_id)
    {   
        $id=base64_decode($design_id);
        $design_options = HomeDesignOptions::with('HomeDesignGroup')->where('home_design_id',$id)->get();
        //echo '<pre>';print_r($designs);die;
        $home_design=HomeDesigns::whereId($id)->first();

        $group_id = HomeDesignTypes::where('id', $home_design->home_design_type_id)->get()->first();

        $design_groups = HomeDesignGroups::where('id',$group_id->design_group_id)->get()->first();

        $homes = Homes::where('id',$design_groups->home_id)->get()->first();


        $this->data['menu'] = 'design_options';
        $this->data['home_design_type_id'] = base64_encode($home_design->home_design_type_id );
        $this->data['design_id']=$design_id;
        return view('admin.designs.design-options-index',compact('design_options','homes','group_id','design_groups','home_design'))->with($this->data);
    }

  
    public function storeDesignOption(Request $request)
    {
        $filename = '';
        if($request->hasfile('file')) 
        { 
          $file = $request->file('file');
          $extension = $file->getClientOriginalExtension(); // getting image extension
          $filename =time().'.'.$extension;
          $file->move('uploads/designs/', $filename);
        }
        $home_design=HomeDesigns::whereId(base64_decode($request->home_design_id))->first();
        //die($filename);
        HomeDesignOptions::create([
            'home_design_id'=>base64_decode($request->home_design_id),
            'image'=>$filename,
            'name'=>$request->title,
            'slug' => $home_design->slug,
            'patch'=>$request->patch,
            'mname'=>$request->mname,
            'mid'=>$request->mid,
            'murl'=>$request->murl,
            'star'=>$request->star,
            'price'=>$request->price,
            'status_id'=>$request->status,
            
        ]);
        return redirect()->back()->with('message', 'Option added successfully.');
    }

    public function editDesignOption($design_option_id)
    {
        $id=base64_decode($design_option_id);
        //$designs = HomeDesignOptions::with('HomeDesign')->whereId($id)->first();
        $design_option = HomeDesignOptions::whereId($id)->first();

        $home_design=HomeDesigns::where('id',$design_option->home_design_id)->first();

        $group_id = HomeDesignTypes::where('id', $home_design->home_design_type_id)->get()->first();

        $design_groups = HomeDesignGroups::where('id',$group_id->design_group_id)->get()->first();

        $homes = Homes::where('id',$design_groups->home_id)->get()->first();
        $this->data['design_id'] = base64_encode($design_option->home_design_id);
        //echo '<pre>';print_r($home);die;
        $this->data['menu'] = 'home_design_option';
        return view('admin.designs.design-options-edit',compact('design_option','home_design','group_id','design_groups','homes'))->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\home  $home
     * @return \Illuminate\Http\Response
     */
    public function updateDesignOption(Request $request)
    {   
        $id=base64_decode($request->id);
        if($request->hasfile('file')) 
        { 
          $file = $request->file('file');
          $extension = $file->getClientOriginalExtension(); // getting image extension
          $filename =time().'.'.$extension;
          $file->move('uploads/designs/', $filename);
          HomeDesignOptions::whereId($id)->update([
            'image'=>$filename,
            ]);
        }
        HomeDesignOptions::whereId($id)->update([
            'name'=>$request->title,
            'patch'=>$request->patch,
            'mname'=>$request->mname,
            'mid'=>$request->mid,
            'murl'=>$request->murl,
            'star'=>$request->star,
            'price'=>$request->price,
            'status_id'=>$request->status,
            
        ]);

        return redirect()->back()->with('message', 'Option Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\home  $home
     * @return \Illuminate\Http\Response
     */
    public function destroyDesignOption(Request $request)
    { 
        $id=base64_decode($request->design_option_id);
        HomeDesignOptions::whereId($id)->delete();
        return redirect()->back()->with('message', 'Option deleted successfully.');
    }

     public function getAllDesign()
    {
        
    $this->data['menu'] = "index_design";   
    $this->title = 'Design Listings';
    $this->data['page_title'] = $this->title;
    $homes = Homes::all();
    $dgroups =[];
    foreach ($homes as $key => $home) 
    {
        $dgroups[$home->id]['dgroup'] = HomeDesignGroups::where('home_id', $home->id)->get();
        $dgroups[$home->id]['home'] = $home;
        $this->data['dgroups'] = $dgroups;
        $this->data['homes'] = $homes;
    }
   
   // $this->data['dgroups'] = HomeDesignGroups::select('home_design_groups.*', 'home_designs.design')->join('home_designs', 'home_design_groups.home_id' ,'=', 'home_designs.home_design_type_id')->get();
 
    //$this->data['dgroups'] = HomeDesignGroups::with('HomeDesignTypes')->get();

    /*$this->data['dgroups'] = HomeDesignGroups::get();*/

    //dd($this->data);
    return view('admin.designs.design_list')->with($this->data);
       
    }
   public function group_delete($id)
    {
        $designs = HomeDesignGroups::find($id);
        if ($designs != null) 
        {
          $designs->delete();
          return redirect()->back()->with('success', 'Design Group Deleted Successfully');
        }
    }
    public function designtype_delete($id)
    {      
        $design_type = HomeDesignTypes::find($id);
        if ($design_type != null) 
        {
          $design_type->delete();
           return redirect()->back()->with('success', 'Design type Deleted Successfully');
        }
    }
    public function option_delete($id)
    {
        $design_option = HomeDesignOptions::find($id);
        if ($design_option != null) 
        {
          $design_option->delete();
          return redirect()->back()->with('success', 'Design option Deleted Successfully');
        }
    }

    
    public function set_default(Request $request)
          {

         $data =  HomeDesignOptions::where(['id'=>$request->cid,'home_design_id'=>$request->homeDesign_id])->update(['default_color'=>1]);
         return response()->json(['success'=>'Status change successfully.','data'=> $data]);
                    
      }

      public function saveColors(Request $request)
    {
        $design_type_id = $request->home_design_type_id;
        $slug = $request->type_slug;
        $selfSlug = 'transparent'.$request->type_slug;

        $checkColor = HomeTypeOptions::where('design_type_id',$design_type_id)
              ->where('slug',$slug)
              ->where('self_slug',$selfSlug)
              ->get()->first();

        
               
        if ($checkColor) {
          $id = $checkColor->id; 
          $res=HomeTypeOptions::where('id',$id)->delete();
        } 

        $n=8;
        $homeTypeOptions = new HomeTypeOptions;
        $homeTypeOptions->design_type_id = $request->home_design_type_id;
        $homeTypeOptions->patch = $request->patch;
        $homeTypeOptions->slug = $request->type_slug;
        $characters = 'abcdefghijklmnopqrstuvwxyz'; 
        $randomString = ''; 
        for ($i = 0; $i < $n; $i++) { 
          $index = rand(0, strlen($characters) - 1); 
          $randomString .= $characters[$index]; 
        } 
        $homeTypeOptions->self_slug = $randomString.'slug';
        $homeTypeOptions->name = $request->color_name;
        $homeTypeOptions->status_id = $request->status;
        $homeTypeOptions->default_color = 0;
        $homeTypeOptions->save();
        return redirect()->back()->with('message', 'Color added successfully.');
    }

    public function listColors($typeId = null, $groupId = null)
    {
        if(isset($typeId) && !empty($typeId)){

          $id = $typeId;

          $group_id = HomeDesignTypes::where('id', $id)->get()->first();
          $design_groups = HomeDesignGroups::where('id',$group_id->design_group_id)->get()->first();
          $homes = Homes::where('id',$design_groups->home_id)->get()->first();

          $typeId = $typeId;
          $groupId = $groupId;

          $homeTypeOptions = HomeTypeOptions::where('design_type_id',$typeId)
            ->with('designTypes')->where('status_id','=',2)->get();

          /*echo "<pre>"; print_r($homeTypeOptions);
          dd($homeTypeOptions);
          echo $homeTypeOptions['design']; die;*/

          $this->data['hometypeoptions'] = $homeTypeOptions;
          $this->data['design_group_id'] = base64_encode($group_id->design_group_id);
          $this->data['design_type_id'] = base64_encode($group_id->id);   
          //return view('admin.designs.color-index',compact('combinations'))->with($this->data); 
          return view('admin.designs.color-index',compact('homeTypeOptions','homes','design_groups','group_id'))->with($this->data); 
          //return redirect()->back();
        }
    }

    public function listCombinations($typeId = null, $groupId = null)
    {
        if(isset($typeId) && !empty($typeId)){

          $id = $typeId;

          $group_id = HomeDesignTypes::where('id', $id)->get()->first();
          $design_groups = HomeDesignGroups::where('id',$group_id->design_group_id)->get()->first();
          $homes = Homes::where('id',$design_groups->home_id)->get()->first();

          $typeId = $typeId;
          $groupId = $groupId;

          $homeDesignTypes = HomeDesignTypes::where('id',$typeId)
            ->with('designs','options')->where('status_id','=',2)->get();

          /*echo "<pre>"; print_r($homeDesignTypes);
          die;*/

          $data = array();
          $combinations = array();
          
          if (!$homeDesignTypes->isEmpty()) { 
              $j = 0;
              foreach($homeDesignTypes as $homeDesignType){

                if(!$homeDesignType['designs']->isEmpty())
                  {
                      $homeDesigns = $homeDesignType['designs'];
                      foreach($homeDesigns as $homeDesign){

                        if(!$homeDesignType['options']->isEmpty())
                          {
                              $homeOptions = $homeDesignType['options'];
                              foreach($homeOptions as $homeOption){
                                  $combinations[$j]['id'] = $homeOption['id'];
                                  $combinations[$j]['design'] = $homeDesign['design'];
                                  $combinations[$j]['image'] = $homeDesign['image'];
                                  $combinations[$j]['design_slug'] = $homeDesign['slug'];
                                  $combinations[$j]['color_slug'] = $homeOption['self_slug'];
                                  $combinations[$j]['status'] = $homeOption['status'];
                                  $combinations[$j]['patch'] = $homeOption['patch'];
                                  $combinations[$j]['status'] = $homeOption['status'];
                                  $combinations[$j]['design_slug'] = $homeDesign['slug'];
                                  $combinations[$j]['option_slug'] = $homeOption['self_slug'];
                                  $combinations[$j]['design_type_id'] = $homeOption['design_type_id'];
                                  $combinations[$j]['design_id'] = $homeDesign['id'];
                                  $j++; 
                              }
                              
                          }
                      }
                    }

                }
            }

          $this->data['design_group_id'] = base64_encode($group_id->design_group_id);  
          $this->data['design_type_id'] = base64_encode($group_id->id);  
          $this->data['combinations'] = $combinations;
          return view('admin.designs.design-combinations',compact('combinations','homes','design_groups','group_id'))->with($this->data); 
        } else {
          return redirect()->back();
        }
    }

    public function addCombinations($typeId = null, $designSlug = null, $optionSlug = null)
    {

        $checkCombination = HomeDesignOptions::where('home_type_id',$typeId)
              ->where('design_slug',$designSlug)
              ->where('option_slug',$optionSlug)
              ->get();

        $this->data['menu'] = 'home_design_option';
        $this->data['type_id'] = $typeId;
        $this->data['design_slug'] = $designSlug;
        $this->data['option_slug'] = $optionSlug;
        $this->data['id'] = "";

        $id = $typeId;

        $group_id = HomeDesignTypes::where('id', $id)->get()->first();
        $design_groups = HomeDesignGroups::where('id',$group_id->design_group_id)->get()->first();
        $homes = Homes::where('id',$design_groups->home_id)->get()->first();

        /*echo $designSlug; 
        echo $optionSlug; die;
        echo "<pre>"; print_r($checkCombination); die;*/

        if (!$checkCombination->isEmpty()) {

            $checkCombination = HomeDesignOptions::where('home_type_id',$typeId)
            ->where('design_slug',$designSlug)
            ->where('option_slug',$optionSlug)
            ->get()->first();

            $this->data['cname'] = $checkCombination['cname'];
            $this->data['image'] = $checkCombination['image'];
            $this->data['mname'] = $checkCombination['mname'];
            $this->data['murl'] = $checkCombination['murl'];
            $this->data['mid'] = $checkCombination['mid'];
            $this->data['price'] = $checkCombination['price'];
            $this->data['star'] = $checkCombination['star'];
            $this->data['id'] = $checkCombination['id'];
          }
         $this->data['design_group_id'] = base64_encode($group_id->design_group_id);
         $this->data['design_type_id'] = $group_id->id; 
         $this->data['design_groups'] = $design_groups;    
         $this->data['homes'] = $homes;    
         $this->data['group_id'] = $group_id;    
         return view('admin.designs.add-combinations')->with($this->data);


    }

    public function addUpdateCombination(Request $request)
    {   
        $id = $request->id;
        $filename = "";
        $message = "";

        /*echo "<pre>"; print_r($request->all()); 
        echo $request->hasfile('file');
        die;*/

        if($request->hasfile('file')) 
        { 
          $file = $request->file('file');
          $extension = $file->getClientOriginalExtension(); // getting image extension
          $filename =time().'.'.$extension;
          $file->move('uploads/designs/', $filename);
          /*HomeDesignOptions::whereId($id)->update([
            'image'=>$filename,
            ]);*/
        }
        /*echo $designSlug; 
        echo $optionSlug; die;
        echo "<pre>"; print_r($checkCombination); die;*/
       
        if (!empty($id)) {
          //echo $id; die; 
          $homeDesignOptions = HomeDesignOptions::find($id);
          $message = "Combination details Updated";
        } else {
          $homeDesignOptions = new HomeDesignOptions; 
          $message = "Combination details added successfully.!!!";
        }

        $homeDesignOptions->home_type_id = $request->type_id;
        $homeDesignOptions->design_option = $request->design_slug."-".$request->option_slug;
        $homeDesignOptions->design_slug = $request->design_slug;
        $homeDesignOptions->option_slug = $request->option_slug;
        $homeDesignOptions->cname = $request->title;
        $homeDesignOptions->is_default = 2;
        $homeDesignOptions->mname = $request->mname;
        $homeDesignOptions->image = $filename;
        $homeDesignOptions->mid = $request->mid;
        $homeDesignOptions->murl = $request->murl;
        $homeDesignOptions->price = $request->price;
        $homeDesignOptions->star = $request->star;
        $homeDesignOptions->save();

        return \Redirect::route('list_combinations', $request->type_id)->with('message', $message);

    }


}
