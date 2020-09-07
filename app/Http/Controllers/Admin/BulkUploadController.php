<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Homes;
use App\Models\ColorSchemes;
use App\Models\ColorSchemeUpgrade;
use App\Models\HomeFeatures;
use App\Models\Communities;
use App\Models\CommunitiesHomes;
use App\Models\Floor;
use App\Models\Plots;
use App\Models\Features;
class BulkUploadController extends Controller
{
    //
    public function __construct()
    {
        $this->title = 'Uploads';
        $this->data['page_title'] = $this->title;
        $this->data['menu'] = 'uploads';
    }
    public function index()
    {
        # code...
        return view('admin.uploads')->with($this->data);
    }
    public function returnUnmappedView()
    {
        # code...
        return view ('admin.unmapped')->with($this->data);
    }
    public function getAllCommunities()
    {
        # code...
        $communites = Communities::get(['id','name']);
        return $communites;
    }
    public function getAllHomesForCommunity($id)
    {
        # code...
        $homeIds = CommunitiesHomes::where('communities_id',$id)->pluck('homes_id');
        $homes = Homes::whereIn('id',$homeIds)->get(['id','title']);
        return $homes;
    }
    public function getAllHomeRelatedData($id)
    {
        # code...
        $data =[];
        $homes = Homes::where('parent_id',$id)->get(['id','title']);
        $colorscheme = ColorSchemes::where('home_id',$id)->get(['id','title']);
        $floor = Floor::where('home_id',$id)->get(['id','title']);
        $data['home_type'] = $homes;
        $data['color_scheme'] =  $colorscheme;
        $data['floor'] = $floor;
        return $data;
    }
    public function getAllHomeTypesColorSchemeForHomeType($id)
    {
        # code...
        $colorscheme = ColorSchemes::where('home_id',$id)->get(['id','title']);
        return $colorscheme;
    }
    public function getAllHomesFloor($id)
    {
        # code...
        $floor = Floors::where('home_id',$id)->get(['id','title']);
        return $floor;
    }
    public function unmappedImages(Request $request)
    {
        # code...
        $data = [];
        switch($request->type){
            case '':
                $data['floor'] = $this->getAllFloorUnmappedImages(true);
                $data['home'] = $this->getAllHomeUnMappedImages(true);
                $data['community'] = $this->getCommunityUnmappedImages(true);
                $data['feature'] = $this->getAllFloorFeaturesUnmappedImages(true);
                return $data;
            break;
            case 'communities':
                $data['floor'] = [];
                $data['home'] = [];
                $data['community'] = $this->getCommunityUnmappedImages(true);
                $data['feature'] = [];
                return $data;
            break;
            case 'elevations':
                $data['floor'] = [];
                $data['home'] = $this->getAllHomeUnMappedImages(true);
                $data['community'] = [];
                $data['feature'] = [];
                return $data;
            break;
            case 'floors':
                $data['floor'] = $this->getAllFloorUnmappedImages(true);
                $data['home'] = [];
                $data['community'] = [];
                $data['feature'] = [];
                return $data;
            break;
            case 'features':
                $data['floor'] = [];
                $data['home'] = [];
                $data['community'] = [];
                $data['feature'] = $this->getAllFloorFeaturesUnmappedImages(true);
                return $data;
            break;
            default:
        break;
        }
    }
    public function uploadBulkImage(Request $request)
    {
        # code...
        $type = $request->type;
        if($request->file)
        {
            $number_of_images = count($request->file);
            for($i = 0;$i<$number_of_images;$i++)
            {
                $image = $request->file[$i];
                $name  = $image->getClientOriginalName();
                switch($type){
                    case 'communities':
                        $destinationPath = public_path('uploads');
                    break;
                    case 'elevations':
                        $destinationPath = public_path('uploads/homes');
                    break;
                    case 'floors':
                        $destinationPath = public_path('uploads/floors');
                    break;
                    case 'features':
                        $destinationPath = public_path('uploads/features');
                    break;
                    default:
                    break;
                }
                $image->move($destinationPath, $name);
            }
            return response()->json([
                'status' =>200,
                'msg' => 'All the images uploaded successfully'
            ]);
        }
    }
    public function getImagesForSelectedType(Request $request)
    {
        # code...
        $dirName = $request->type;
        $images = [];
        $path = public_path('uploads\\'.$dirName);
        $files = scandir($path);
        foreach ($files as &$value) {
            $ext = (explode('.',$value));
            if(array_key_exists(1,$ext))
            {
            if(strtolower($ext[1])=='png' || strtolower($ext[1])=='jpg'||strtolower($ext[1])=='jpeg')
            array_push($images,$value);
            }
        }
        return $images;
    }
    public function imagesExistInDatabaseForSelectedType(Request $request)
    {
        # code...
        $data = [];
        $id = $request->id;
        switch($request->type){
            case 'community':
                $data['community'] = $this->getCommunityRelatedImages($id);
                $data['home'] = $this->getHomeRelatedImages($id);
                $data['feature'] = $this->floorFeaturesImages($id);
                $color_scheme = $this->getColorSchemeImages($id);
                $color_scheme_upgrade = $this->getColorSchemeUpgradeImages($id);
                $home_feature = $this->getHomeFeaturesImages($id);
                $data['floor'] = $this->getFloorImages($id);
                $data['home'] = array_merge($data['home'],$color_scheme,$color_scheme_upgrade,$home_feature);
                return $data;
            break;

            case 'home':
                $data['community'] = [];
                $data['home'] = $this->getHomeRelatedImages(null,$id);
                $color_scheme = $this->getColorSchemeImages(null,$id);
                $data['feature'] = $this->floorFeaturesImages(null,$id);
                $data['floor'] = $this->getFloorImages(null,$id);
                $color_scheme_upgrade = $this->getColorSchemeUpgradeImages(null,$id);
                $home_feature = $this->getHomeFeaturesImages(null,$id);
                $data['home'] = array_merge($data['home'],$color_scheme,$color_scheme_upgrade,$home_feature);
                return $data;
            break;

            case 'home-type':
                $data['community'] = [];
                $data['home'] = $this->getHomeRelatedImages(null,$id);
                $data['floor'] = $this->getFloorImages(null,$id);
                $data['feature'] = $this->floorFeaturesImages(null,$id);
                $color_scheme = $this->getColorSchemeImages(null,$id);
                $color_scheme_upgrade = $this->getColorSchemeUpgradeImages(null,$id);
                $home_feature = $this->getHomeFeaturesImages(null,$id);
                $data['home'] = array_merge($data['home'],$color_scheme,$color_scheme_upgrade,$home_feature);
                return $data;
            break;

            case 'color-scheme':
                $data['community'] = [];
                $data['home'] = [];
                $data['feature'] = [];
                $color_scheme = $this->getColorSchemeImages(null,null,$id);
                $color_scheme_upgrade = $this->getColorSchemeUpgradeImages(null,$id);
                $home_feature = $this->getHomeFeaturesImages(null,$id);
                $data['home'] = array_merge($data['home'],$color_scheme,$color_scheme_upgrade,$home_feature);
                return $data;
            break;

            case 'floor':
                $data['community'] = [];
                $data['home'] = [];
                $data['feature'] = $this->floorFeaturesImages(null,null,$id);
                $data['floor'] = $this->getFloorImages(null,null,$id);
                return $data;
            break;
            default:
            break;

        }
    }
    public function getCommunityRelatedImages($id)
    {
        $data = [];
        $getAll = Communities::whereId($id)->get()->first();
        $banner = $getAll->banner;
        $logo = $getAll->logo;
        $marker = $getAll->marker_image;
        $gallery = explode(',',$getAll->gallery);
        $svgImage = Plots::where('community_id',$id)->pluck('image')->toArray();
        array_push($data,$banner);
        array_push($data,$banner);
        array_push($data,$marker);
        $data = array_merge($data,$gallery,$svgImage);
        return $data;
    }
    public function getHomeRelatedImages($community_id=null,$home_id=null)
    {
        # code...
        $data = [];
        $homeGallery = [];
        $homeImages = [];
        if($community_id){
            $homeIds = CommunitiesHomes::where('communities_id',$community_id)->pluck('homes_id');
            $homes = Homes::whereIn('id',$homeIds)->get(['gallery','img']);
            foreach($homes as $img){
                array_push($homeImages,$img->img);
                $img = explode(',',$img->gallery);
                $homeGallery = array_merge($homeGallery,$img);
            }
        }
        if($home_id){
            $homeIds = Homes::where('parent_id',$home_id)->pluck('id')->toArray();
            array_push($homeIds,$home_id);
            $homes = Homes::whereIn('id',$homeIds)->get(['gallery','img']);
            foreach($homes as $img){
                array_push($homeImages,$img->img);
                $img = explode(',',$img->gallery);
                $homeGallery = array_merge($homeGallery,$img);
            }
        }
       $data = array_merge($homeImages,$homeGallery);
        return $data;
    }
    public function getColorSchemeImages($community_id=null,$home_id=null,$color_scheme_id=null)
    {
        # code...
        if($community_id)
        {
            $homeIds = CommunitiesHomes::where('communities_id',$community_id)->pluck('homes_id')->toArray();
            $images = ColorSchemes::whereIn('home_id',$homeIds)->pluck('img')->toArray();
        }
        if($color_scheme_id){
            
            $images = ColorSchemes::where('id',$color_scheme_id)->pluck('img')->toArray();
        }
        if($home_id)
        {
            $images = ColorSchemes::where('home_id',$home_id)->pluck('img')->toArray();
        }
        return $images;
    }
    public function getColorSchemeUpgradeImages($community_id=null,$color_scheme_id=null)
    {
        # code...
        if($community_id){
            $homeIds = CommunitiesHomes::where('communities_id',$community_id)->pluck('homes_id')->toArray();
            $colorIds = ColorSchemes::whereIn('home_id',$homeIds)->pluck('id')->toArray();
            $images = ColorSchemeUpgrade::whereIn('color_scheme_id',$colorIds)->pluck('img')->toArray();
        }
        else{
            $images = ColorSchemeUpgrade::where('color_scheme_id',$color_scheme_id)->pluck('img')->toArray();
        }
        return $images;
    }
    public function getHomeFeaturesImages($community_id=null,$color_scheme_id=null)
    {
        # code...
        if($community_id){
            $homeIds = CommunitiesHomes::where('communities_id',$community_id)->pluck('homes_id')->toArray();
            $colorIds = ColorSchemes::whereIn('home_id',$homeIds)->pluck('id')->toArray();
            $images = HomeFeatures::whereIn('color_scheme_id',$colorIds)->pluck('img')->toArray();
        }
        else{
        $images = HomeFeatures::where('color_scheme_id',$color_scheme_id)->pluck('img')->toArray();
        }
        return $images;
    }
    public function getFloorImages($community_id=null,$home_id=null,$floor_id=null)
    {
        # code...
        if($community_id)
        {
            $homeIds = CommunitiesHomes::where('communities_id',$community_id)->pluck('homes_id')->toArray();
            $images = Floor::whereIn('home_id',$homeIds)->pluck('image')->toArray();
        }
        if($home_id)
        {
            $images = Floor::where('home_id',$home_id)->pluck('image')->toArray();
        }
        if($floor_id)
        {
            $images = Floor::where('id',$floor_id)->pluck('image')->toArray();
        }
        return $images;

    }
    public function floorFeaturesImages($community_id=null,$home_id=null,$floor_id=null)
    {
        # code...
        if($community_id)
        {
            $homeIds = CommunitiesHomes::where('communities_id',$community_id)->pluck('homes_id')->toArray();
            $floorIds = Floor::whereIn('home_id',$homeIds)->pluck('id')->toArray();
            $images = Features::whereIn('floor_id',$floorIds)->pluck('image')->toArray();
        }
        if($home_id)
        {
            $floorIds = Floor::where('home_id',$home_id)->pluck('id')->toArray();
            $images = Features::whereIn('floor_id',$floorIds)->pluck('image')->toArray();
        }
        if($floor_id)
        {
            $images = Features::where('floor_id',$floor_id)->pluck('image')->toArray();
        }
        return $images;
    }
    public function deleteImage(Request $request)
    {
        # code...
        $dirName = $request->dir;
        if($dirName!=''){
            $dirPath = public_path('uploads\\'.$dirName);
        }
        else{
            $dirPath = public_path('uploads');
        }
        $path = $dirPath.'\\'.$request->image;
        unlink($path);
        return response()->json([
            'status'=>200,
            'msg'=>'deleted succesfully'
        ]);
    }
    public function getAllHomeUnMappedImages($inline=false)
    {
        # code...
        $gallery = [];
        $homeImages = [];
        $totalImagesInUse = [];
        $imagesInDirectory = [];
        $homeFeaturesImages = [];
        $unusedImages = [];
        $getAllGalleryImages = Homes::get();
        foreach($getAllGalleryImages as $img){
            array_push($homeImages,$img->img);
            $img = explode(',',$img->gallery);
            $gallery = array_merge($gallery,$img);
        }
        // color schemes images
        $colorSchemes = ColorSchemes::pluck('img')->toArray();

        // color schemes upgrade images
        $colorSchemesUpgrade = ColorSchemeUpgrade::pluck('img')->toArray();

        // home features images
        $homeFeaturesImages = HomeFeatures::pluck('img')->toArray();

        //merge all the images in the final array
        $totalImagesInUse = array_merge($homeImages,$gallery,$colorSchemes,$colorSchemesUpgrade,$homeFeaturesImages);
        
        // get all the images exist in home directory
        $path = public_path('uploads\homes');
        $files = scandir($path);
        foreach ($files as &$value) {
            $ext = (explode('.',$value));
            if(array_key_exists(1,$ext))
            {
            if(strtolower($ext[1])=='png' || strtolower($ext[1])=='jpg'||strtolower($ext[1])=='jpeg')
            array_push($imagesInDirectory,$value);
            }
        }
        $unusedImages = array_diff($imagesInDirectory,$totalImagesInUse);
        if($inline) return $unusedImages;
        else{
            $dirPath = public_path('uploads\homes\\');
            foreach($unusedImages as $img){
                $path = $dirPath.'\\'.$img;
                unlink($path);
            }
            return response()->json([
                'status'=>200,
                'database_images' => count($totalImagesInUse),
                'directory_images' =>count($imagesInDirectory),
                'difference'=>count($unusedImages),
                'unmapped_images'=> $unusedImages,
                'msg'=> 'Home Directory Cleaned'
            ]);
        }
    }
    public function getAllFloorUnmappedImages($inline=false)
    {
        # code...
        $imagesInDatabase = Floor::pluck('image')->toArray();
        $imagesInDirectory = [];
        $path = public_path('uploads\floors');
        $files = scandir($path);
        foreach ($files as &$value) {
            $ext = (explode('.',$value));
            if(array_key_exists(1,$ext))
            {
            if(strtolower($ext[1])=='png' || strtolower($ext[1])=='jpg'||strtolower($ext[1])=='jpeg')
            array_push($imagesInDirectory,$value);
            }
        }
        $unusedImages = array_diff($imagesInDirectory,$imagesInDatabase);
        if($inline) return $unusedImages;
        else{
            $dirPath = public_path('uploads\floors\\');
            foreach($unusedImages as $img){
                $path = $dirPath.'\\'.$img;
                unlink($path);
            }
            return response()->json([
                'status'=>200,
                'database_images' => count($imagesInDatabase),
                'directory_images' =>count($imagesInDirectory),
                'difference'=>count($unusedImages),
                'unmapped_images'=> $unusedImages,
                'msg'=> 'Floor Directory Cleaned'
            ]);
        }
    }
    public function getCommunityUnmappedImages($inline=false)
    {
        # code...
        $gallery = [];
        $totalImagesInUse = [];
        $imagesInDirectory = [];
        $unusedImages = [];
        $communityBanner = [];
        $communityLogo = [];
        $communityMarker = [];
        $getAllGalleryImages = Communities::get();
        foreach($getAllGalleryImages as $img){
            array_push($communityBanner,$img->banner);
            array_push($communityLogo,$img->logo);
            array_push($communityMarker,$img->marker_image);
            $img = explode(',',$img->gallery);
            $gallery = array_merge($gallery,$img);
        }
        $svgImage = Plots::pluck('image')->toArray();
        $totalImagesInUse = array_merge($communityBanner,$communityLogo,$communityMarker,$gallery,$svgImage);
        $path = public_path('uploads');
        $files = scandir($path);
        foreach ($files as &$value) {
            $ext = (explode('.',$value));
            if(array_key_exists(1,$ext))
            {
            if(strtolower($ext[1])=='png' || strtolower($ext[1])=='jpg'|| strtolower($ext[1])=='jpeg')
            array_push($imagesInDirectory,$value);
            }
        }
        $unusedImages = array_diff($imagesInDirectory,$totalImagesInUse);
        if($inline) return $unusedImages;
        else{
            $dirPath = public_path('uploads');
            foreach($unusedImages as $img){
                $path = $dirPath.'\\'.$img;
                unlink($path);
            }
            return response()->json([
                'status'=>200,
                'database_images' => count($totalImagesInUse),
                'directory_images' =>count($imagesInDirectory),
                'difference'=>count($unusedImages),
                'unmapped_images'=> $unusedImages,
                'msg'=> 'Community Directory Cleaned.'
            ]);
        }
    }
    public function getAllFloorFeaturesUnmappedImages($inline=false)
    {
        # code...
        $imagesInDatabase = Features::pluck('image')->toArray();
        $imagesInDirectory = [];
        $path = public_path('uploads\features');
        $files = scandir($path);
        foreach ($files as &$value) {
            $ext = (explode('.',$value));
            if(array_key_exists(1,$ext))
            {
            if(strtolower($ext[1])=='png' || strtolower($ext[1])=='jpg'||$ext[1]=='jpeg')
            array_push($imagesInDirectory,$value);
            }
        }
        $unusedImages = array_diff($imagesInDirectory,$imagesInDatabase);
        if($inline) return $unusedImages;
        else{
            $dirPath = public_path('uploads\features\\');
            foreach($unusedImages as $img){
                $path = $dirPath.'\\'.$img;
                unlink($path);
            }
            return response()->json([
                'status'=>200,
                'database_images' => count($imagesInDatabase),
                'directory_images' =>count($imagesInDirectory),
                'difference'=>count($unusedImages),
                'unmapped_images'=> $unusedImages,
                'msg'=> 'Floor Directory Cleaned'
            ]) ;
        }
    }
    public function cleanDir(Request $request)
    {
        # code...
        $type = $request->type;
        switch($type){
            case '':
                $home = $this->getAllHomeUnMappedImages(true);
                $community = $this->getCommunityUnmappedImages(true);
                $floor = $this->getAllFloorUnmappedImages(true);
                $feature = $this->getAllFloorFeaturesUnmappedImages(true);
                $total = count($home) + count($community) + count($floor) + count($feature);
                $homeDir = public_path('uploads\homes\\');
                $comDir = public_path('uploads');
                $floorDir = public_path('uploads\floors\\');
                $featureDir = public_path('uploads\features\\');
                foreach($home as $img){
                    $path = $homeDir.'\\'.$img;
                    unlink($path);
                }
                foreach($community as $img){
                    $path = $comDir.'\\'.$img;
                    unlink($path);
                }
                foreach($floor as $img){
                    $path = $floorDir.'\\'.$img;
                    unlink($path);
                }
                foreach($feature as $img){
                    $path = $featureDir.'\\'.$img;
                    unlink($path);
                }
                return response()->json([
                    'status'=>200,
                    'unmapped_images'=> $total,
                    'msg'=> ' Directory Cleaned'
                ]);
            break;
            case 'communities':
                return $this->getCommunityUnmappedImages();
            break;
            case 'elevations':
                return $this->getAllHomeUnMappedImages();
            break;
            case 'floors':
                return $this->getAllFloorUnmappedImages();
            break;
            case 'features':
                return $this->getAllFloorFeaturesUnmappedImages();
            break;
            default:

            break;
        }
    }
  
}
