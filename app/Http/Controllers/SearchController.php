<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cities;
use App\Models\Communities;
use App\Models\CommunitiesHomes;
use App\Models\Homes;
use App\Models\Floor;
class SearchController extends Controller {
    public $data;
    public function __construct() {
        $this->data['title'] = 'community';
    }
    public function index(Request $request) {
        return view('search');
    }
    public function community(Request $request) {
        $request->session()->forget('pb_url_check');
        $this->SessionVariables($request);
        $request->session()->put('com_first', true);
        if (isset($_GET['sortby']) && ($_GET['sortby'] == 'a_z')):
            $stype = 'communities.name';
            $svalue = 'asc';
        elseif (isset($_GET['sortby']) && ($_GET['sortby'] == 'z_a')):
            $stype = 'communities.name';
            $svalue = 'desc';
        else:
            $stype = 'communities.lat';
            $svalue = 'asc';
        endif;
        $range = [];
        // Price
        $range['min_price'] = Homes::where('parent_id', 0)->min('price');
        $range['max_price'] = Homes::where('parent_id', 0)->max('price');
        // Area
        $range['min_area'] = Homes::where('parent_id', 0)->min('area');
        $range['max_area'] = Homes::where('parent_id', 0)->max('area');
        // Bedroom
        $range['min_bedroom'] = Homes::where('parent_id', 0)->min('bedroom');
        $range['max_bedroom'] = Homes::where('parent_id', 0)->max('bedroom');
        // Bathroom
        $range['min_bathroom'] = Homes::where('parent_id', 0)->min('bathroom');
        $range['max_bathroom'] = Homes::where('parent_id', 0)->max('bathroom');
        if (isset($_GET['price_range'])) {
            $price = explode(";", $_GET['price_range']);
            $min_price = $price[0];
            $max_price = $price[1];
        } else {
            $min_price = $range['min_price'];
            $max_price = $range['max_price'];
        }
        if (isset($_GET['feet'])) {
            $area = explode(";", $_GET['feet']);
            $min_area = $area[0];
            $max_area = $area[1];
        } else {
            $min_area = $range['min_area'];
            $max_area = $range['max_area'];
        }
        if (isset($_GET['bedroom'])) {
            $bedroom = explode(";", $_GET['bedroom']);
            $min_bedroom = $bedroom[0];
            $max_bedroom = $bedroom[1];
        } else {
            $min_bedroom = $range['min_bedroom'];
            $max_bedroom = $range['max_bedroom'];
        }
        if (isset($_GET['bathroom'])) {
            $bathroom = explode(";", $_GET['bathroom']);
            $min_bathroom = $bathroom[0];
            $max_bathroom = $bathroom[1];
        } else {
            $min_bathroom = $range['min_bathroom'];
            $max_bathroom = $range['max_bathroom'];
        }
        if (isset($_GET['search'])):
            $communities_data = [];
            if (isset($_GET['value']) && $_GET['value']):
                $communities = Communities::where('city_id', $_GET['value'])->where('status_id', 2)->with('CommunitiesHomes')->orderBy($stype, $svalue)->get();
            else:
                $communities = Communities::where('status_id', 2)->with('CommunitiesHomes')->orderBy($stype, $svalue)->get();
            endif;
            foreach ($communities as $community) {
                foreach ($community->communitieshomes as $h) {
                    if (Homes::where('id', $h->homes_id)->whereBetween('price', [$min_price, $max_price])->whereBetween('area', [$min_area, $max_area])->whereBetween('bedroom', [$min_bedroom, $max_bedroom])->whereBetween('bathroom', [$min_bathroom, $max_bathroom])->count() > 0) {
                        array_push($communities_data, $community);
                        break;
                    }
                }
            }
            // Declaring Arrays
            $com_min_price = [];
            $com_min_bed = [];
            $com_max_bed = [];
            $com_min_bath = [];
            $com_max_bath = [];
            $com_min_garage = [];
            $com_max_garage = [];
            $com_min_area = [];
            $com_max_area = [];
            $com_max_price = [];
            foreach ($communities as $community) {
                $home_prices = [];
                $home_bedroom = [];
                $home_bathroom = [];
                $home_garage = [];
                $home_area = [];
                foreach ($community->communitieshomes as $h) {
                    if (Homes::where('id', $h->homes_id)->whereBetween('price', [$min_price, $max_price])->whereBetween('area', [$min_area, $max_area])->whereBetween('bedroom', [$min_bedroom, $max_bedroom])->whereBetween('bathroom', [$min_bathroom, $max_bathroom])->count() > 0) {
                        array_push($home_prices, Homes::where('id', $h->homes_id)->min('price'));
                        array_push($home_bedroom, Homes::where('id', $h->homes_id)->min('bedroom'));
                        array_push($home_bathroom, Homes::where('id', $h->homes_id)->min('bathroom'));
                        array_push($home_garage, Homes::where('id', $h->homes_id)->min('garage'));
                        array_push($home_area, Homes::where('id', $h->homes_id)->min('area'));
                    }
                }
                if (sizeof($home_prices) != 0 && sizeof($home_bathroom) != 0 && sizeof($home_bedroom) != 0 && sizeof($home_garage) != 0 && sizeof($home_area) != 0) {
                    array_push($com_min_price, min($home_prices));
                    array_push($com_max_price, max($home_prices));
                    array_push($com_min_bed, min($home_bedroom));
                    array_push($com_max_bed, max($home_bedroom));
                    array_push($com_min_bath, min($home_bathroom));
                    array_push($com_max_bath, max($home_bathroom));
                    array_push($com_min_garage, min($home_garage));
                    array_push($com_max_garage, max($home_garage));
                    array_push($com_min_area, min($home_area));
                    array_push($com_max_area, max($home_area));
                }
            }
            $this->data['communities'] = $communities_data;
            $this->data['ccount'] = sizeof($communities_data);
            $this->data['com_min_price'] = $com_min_price;
            $this->data['com_max_price'] = $com_max_price;
            $this->data['com_min_bed'] = $com_min_bed;
            $this->data['com_max_bed'] = $com_max_bed;
            $this->data['com_min_bath'] = $com_min_bath;
            $this->data['com_max_bath'] = $com_max_bath;
            $this->data['com_min_garage'] = $com_min_garage;
            $this->data['com_max_garage'] = $com_max_garage;
            $this->data['com_min_area'] = $com_min_area;
            $this->data['com_max_area'] = $com_max_area;
        else:
            $communities_data = [];
            $communities = Communities::where('status_id', 2)->with('CommunitiesHomes')->orderBy($stype, $svalue)->get();
            foreach ($communities as $community) {
                foreach ($community->communitieshomes as $h) {
                    if (Homes::where('id', $h->homes_id)->whereBetween('price', [$min_price, $max_price])->whereBetween('area', [$min_area, $max_area])->whereBetween('bedroom', [$min_bedroom, $max_bedroom])->whereBetween('bathroom', [$min_bathroom, $max_bathroom])->count() > 0) {
                        array_push($communities_data, $community);
                        break;
                    }
                }
            }
            // Declaring Arrays
            $com_min_price = [];
            $com_min_bed = [];
            $com_max_bed = [];
            $com_min_bath = [];
            $com_max_bath = [];
            $com_min_garage = [];
            $com_max_garage = [];
            $com_min_area = [];
            $com_max_area = [];
            $com_max_price = [];
            foreach ($communities as $community) {
                $home_prices = [];
                $home_bedroom = [];
                $home_bathroom = [];
                $home_garage = [];
                $home_area = [];
                foreach ($community->communitieshomes as $h) {
                    if (Homes::where('id', $h->homes_id)->whereBetween('price', [$min_price, $max_price])->whereBetween('area', [$min_area, $max_area])->whereBetween('bedroom', [$min_bedroom, $max_bedroom])->whereBetween('bathroom', [$min_bathroom, $max_bathroom])->count() > 0) {
                        array_push($home_prices, Homes::where('id', $h->homes_id)->min('price'));
                        array_push($home_bedroom, Homes::where('id', $h->homes_id)->min('bedroom'));
                        array_push($home_bathroom, Homes::where('id', $h->homes_id)->min('bathroom'));
                        array_push($home_garage, Homes::where('id', $h->homes_id)->min('garage'));
                        array_push($home_area, Homes::where('id', $h->homes_id)->min('area'));
                    }
                }
                if (sizeof($home_prices) != 0 && sizeof($home_bathroom) != 0 && sizeof($home_bedroom) != 0 && sizeof($home_garage) != 0 && sizeof($home_area) != 0) {
                    array_push($com_min_price, min($home_prices));
                    array_push($com_max_price, max($home_prices));
                    array_push($com_min_bed, min($home_bedroom));
                    array_push($com_max_bed, max($home_bedroom));
                    array_push($com_min_bath, min($home_bathroom));
                    array_push($com_max_bath, max($home_bathroom));
                    array_push($com_min_garage, min($home_garage));
                    array_push($com_max_garage, max($home_garage));
                    array_push($com_min_area, min($home_area));
                    array_push($com_max_area, max($home_area));
                }
            }
            $this->data['communities'] = $communities_data;
            $this->data['ccount'] = sizeof($communities_data);
            $this->data['com_min_price'] = $com_min_price;
            $this->data['com_max_price'] = $com_max_price;
            $this->data['com_min_bed'] = $com_min_bed;
            $this->data['com_max_bed'] = $com_max_bed;
            $this->data['com_min_bath'] = $com_min_bath;
            $this->data['com_max_bath'] = $com_max_bath;
            $this->data['com_min_garage'] = $com_min_garage;
            $this->data['com_max_garage'] = $com_max_garage;
            $this->data['com_min_area'] = $com_min_area;
            $this->data['com_max_area'] = $com_max_area;
        endif;
        $city_ids = [];
        $cities = [];
        foreach($communities_data as $community){
            if(!in_array($community->city_id, $city_ids)){
                array_push($city_ids, $community->city_id);
            }
        }
        foreach($city_ids as $city_id){
            $city = Cities::with('state')->where('id', $city_id)->first();
            $cities[$city_id] = $city->city . ' - ' . $city->state->code;
        }
        $this->data['cities'] = $cities;
        $range['min_price'] = min($com_min_price);
        $range['max_price'] = max($com_max_price);
        $range['min_area'] = min($com_min_area);
        $range['max_area'] = max($com_max_area);
        $range['min_bedroom'] = min($com_min_bed);
        $range['max_bedroom'] = max($com_max_bed);
        $range['min_bathroom'] = min($com_min_bath);
        $range['max_bathroom'] = max($com_max_bath);
        $this->data['range'] = $range;
        return view('community')->with($this->data);
    }
    public function elevationCommunities($elevation_id, $elevation_type_id=null, Request $request) {
        $request->session()->forget('pb_url_check');
        $this->SessionVariables($request);
        $home = Homes::where('slug', $elevation_id)->first();
        if($elevation_type_id):
            $elevation_type = Homes::where([
            'slug' => $elevation_type_id,
            'parent_id' => $home->id])->first();
        else:
            $elevation_type = null;
        endif;
        $this->data['elevation_type'] = $elevation_type;
        $elevation_com_ids = CommunitiesHomes::where('homes_id', $home->id)->get();
        $communities = [];
        foreach ($elevation_com_ids as $community_id):
            $community = Communities::where(['id' => $community_id->communities_id, 'status_id' => 2])->first();
            if ($community):
                array_push($communities, $community);
            endif;
        endforeach;
        
        $home_type = Homes::where('id', $home->id)->first();
        $range = [];
        // Price
        $range['min_price'] = $home_type->price;
        $range['max_price'] = $home_type->price;
        // Area
        $range['min_area'] = $home_type->area;
        $range['max_area'] = $home_type->area;
        // Bedroom
        $range['min_bedroom'] = $home_type->bedroom;
        $range['max_bedroom'] = $home_type->bedroom;
        // Bathroom
        $range['min_bathroom'] = $home_type->bathroom;
        $range['max_bathroom'] = $home_type->bathroom;
        $this->data['range'] = $range;
        if (isset($_GET['sortby']) && ($_GET['sortby'] == 'a_z')):
            $homes_collection = collect($communities);
            $this->data['communities'] = $homes_collection->sortBy('name');
        elseif (isset($_GET['sortby']) && ($_GET['sortby'] == 'z_a')):
            $homes_collection = collect($communities);
            $this->data['communities'] = $homes_collection->sortByDesc('name');        
        else:
            $this->data['communities'] = $communities;
        endif;
        $this->data['home'] = $home;
        $this->data['ccount'] = sizeof($communities);
        $this->data['com_min_price'] = $home_type->price;
        $this->data['com_max_price'] = $home_type->price;
        $this->data['com_min_bed'] = $home_type->bedroom;
        $this->data['com_max_bed'] = $home_type->bedroom;
        $this->data['com_min_bath'] = $home_type->bathroom;
        $this->data['com_max_bath'] = $home_type->bathroom;
        $this->data['com_min_area'] = $home_type->area;
        $this->data['com_max_area'] = $home_type->area;
        return view('community')->with($this->data);
    }
    public function elevations(Request $request) {
        $request->session()->forget('pb_url_check');
        $this->SessionVariables($request);
        $request->session()->put('community_slug', $_GET['community']);
        $community = Communities::with("Homes")->where('slug', $_GET['community'])->first();
        // Price
        $range['min_price'] = $community->Homes->where('status_id', 2)->where('parent_id', 0)->min('price');
        $range['max_price'] = $community->Homes->where('status_id', 2)->where('parent_id', 0)->max('price');
        // Area
        $range['min_area'] = $community->Homes->where('status_id', 2)->where('parent_id', 0)->min('area');
        $range['max_area'] = $community->Homes->where('status_id', 2)->where('parent_id', 0)->max('area');
        // Bedroom
        $range['min_bedroom'] = $community->Homes->where('status_id', 2)->where('parent_id', 0)->min('bedroom');
        $range['max_bedroom'] = $community->Homes->where('status_id', 2)->where('parent_id', 0)->max('bedroom');
        // Bathroom
        $range['min_bathroom'] = $community->Homes->where('status_id', 2)->where('parent_id', 0)->min('bathroom');
        $range['max_bathroom'] = $community->Homes->where('status_id', 2)->where('parent_id', 0)->max('bathroom');
        // Garage
        $range['min_garage'] = $community->Homes->where('status_id', 2)->where('parent_id', 0)->min('garage');
        $range['max_garage'] = $community->Homes->where('status_id', 2)->where('parent_id', 0)->max('garage');
        // Floor
        $range['min_floor'] = $community->Homes->where('status_id', 2)->where('parent_id', 0)->min('floor');
        $range['max_floor'] = $community->Homes->where('status_id', 2)->where('parent_id', 0)->max('floor');
        if (isset($_GET['community'])):
            if (isset($_GET['price_range'])) {
                $price = explode(";", $_GET['price_range']);
                $min_price = $price[0];
                $max_price = $price[1];
            } else {
                $min_price = $range['min_price'];
                $max_price = $range['max_price'];
            }
            if (isset($_GET['feet'])) {
                $area = explode(";", $_GET['feet']);
                $min_area = $area[0];
                $max_area = $area[1];
            } else {
                $min_area = $range['min_area'];
                $max_area = $range['max_area'];
            }
            if (isset($_GET['bedroom'])) {
                $bedroom = explode(";", $_GET['bedroom']);
                $min_bedroom = $bedroom[0];
                $max_bedroom = $bedroom[1];
            } else {
                $min_bedroom = $range['min_bedroom'];
                $max_bedroom = $range['max_bedroom'];
            }
            if (isset($_GET['bathroom'])) {
                $bathroom = explode(";", $_GET['bathroom']);
                $min_bathroom = $bathroom[0];
                $max_bathroom = $bathroom[1];
            } else {
                $min_bathroom = $range['min_bathroom'];
                $max_bathroom = $range['max_bathroom'];
            }
            if (isset($_GET['garage'])) {
                $garage = explode(";", $_GET['garage']);
                $min_garage = $garage[0];
                $max_garage = $garage[1];
            } else {
                $min_garage = $range['min_garage'];
                $max_garage = $range['max_garage'];
            }
            if (isset($_GET['floor'])) {
                $floor = explode(";", $_GET['floor']);
                $min_floor = $floor[0];
                $max_floor = $floor[1];
            } else {
                $min_floor = $range['min_floor'];
                $max_floor = $range['max_floor'];
            }
            $community_homes = [];
            $home_min_price = [];
            $home_min_bed = [];
            $home_max_bed = [];
            $home_min_bath = [];
            $home_max_bath = [];
            $home_min_garage = [];
            $home_max_garage = [];
            $home_min_area = [];
            $home_max_area = [];
            $home_max_price = [];
            $home_min_floor = [];
            $home_max_floor = [];
            foreach ($community->Homes as $home) {
                if (Homes::where(['status_id' => 2, 'parent_id' => 0, 'id' => $home->id])->whereBetween('price', [$min_price, $max_price])->whereBetween('area', [$min_area, $max_area])->whereBetween('bedroom', [$min_bedroom, $max_bedroom])->whereBetween('bathroom', [$min_bathroom, $max_bathroom])->whereBetween('garage', [$min_garage, $max_garage])->whereBetween('floor', [$min_floor, $max_floor])->count() > 0) {
                    $homes = Homes::where(['status_id' => 2, 'parent_id' => 0, 'id' => $home->id])->whereBetween('price', [$min_price, $max_price])->whereBetween('area', [$min_area, $max_area])->whereBetween('bedroom', [$min_bedroom, $max_bedroom])->whereBetween('bathroom', [$min_bathroom, $max_bathroom])->whereBetween('garage', [$min_garage, $max_garage])->whereBetween('floor', [$min_floor, $max_floor])->get()->first();
                    $homes->home_types = Homes::where('parent_id', $homes->id)->where('status_id', 2)->get();
                    $homes->floors = Floor::where('home_id', $home->id)->get();
                    array_push($home_min_price, $homes->price);
                    array_push($home_max_price, $homes->price);
                    array_push($home_min_bed, $homes->bedroom);
                    array_push($home_max_bed, $homes->bedroom);
                    array_push($home_min_bath, $homes->bathroom);
                    array_push($home_max_bath, $homes->bathroom);
                    array_push($home_min_garage, $homes->garage);
                    array_push($home_max_garage, $homes->garage);
                    array_push($home_min_area, $homes->area);
                    array_push($home_max_area, $homes->area);
                    array_push($home_min_floor, $homes->floor);
                    array_push($home_max_floor, $homes->floor);
                    array_push($community_homes, $homes);
                }
            }
            if (isset($_GET['sortby']) && ($_GET['sortby'] == 'a_z')):
                $homes_collection = collect($community_homes);
                $this->data['communities'] = $homes_collection->sortBy('title');
            elseif (isset($_GET['sortby']) && ($_GET['sortby'] == 'z_a')):
                $homes_collection = collect($community_homes);
                $this->data['communities'] = $homes_collection->sortByDesc('title');        
            else:
                $this->data['communities'] = $community_homes;
            endif;
            $this->data['ccount'] = sizeof($community_homes);
            $this->data['community'] = $community;
            $range['min_price'] = min($home_min_price);
            $range['max_price'] = max($home_max_price);
            $range['min_area'] = min($home_min_area);
            $range['max_area'] = max($home_max_area);
            $range['min_bedroom'] = min($home_min_bed);
            $range['max_bedroom'] = max($home_max_bed);
            $range['min_bathroom'] = min($home_min_bath);
            $range['max_bathroom'] = max($home_max_bath);
            $range['min_garage'] = min($home_min_garage);
            $range['max_garage'] = max($home_max_garage);
            $range['min_floor'] = min($home_min_floor);
            $range['max_floor'] = max($home_max_floor);
            $this->data['range'] = $range;
            return view('elevations')->with($this->data);
        else:
            return redirect()->route('community');
        endif;
    }
    public function searchElevations(Request $request) {
        $request->session()->forget('pb_url_check');
        $request->session()->forget('com_first');
        $this->SessionVariables($request);
        //Price
        $range['min_price'] = Homes::where('status_id', 2)->where('parent_id', 0)->min('price');
        $range['max_price'] = Homes::where('status_id', 2)->where('parent_id', 0)->max('price');
        // Area
        $range['min_area'] = Homes::where('status_id', 2)->where('parent_id', 0)->min('area');
        $range['max_area'] = Homes::where('status_id', 2)->where('parent_id', 0)->max('area');
        // Bedroom
        $range['min_bedroom'] = Homes::where('status_id', 2)->where('parent_id', 0)->min('bedroom');
        $range['max_bedroom'] = Homes::where('status_id', 2)->where('parent_id', 0)->max('bedroom');
        // Bathroom
        $range['min_bathroom'] = Homes::where('status_id', 2)->where('parent_id', 0)->min('bathroom');
        $range['max_bathroom'] = Homes::where('status_id', 2)->where('parent_id', 0)->max('bathroom');
        if (isset($_GET['price_range'])) {
            $price = explode(";", $_GET['price_range']);
            $min_price = $price[0];
            $max_price = $price[1];
        } else {
            $min_price = $range['min_price'];
            $max_price = $range['max_price'];
        }
        if (isset($_GET['feet'])) {
            $area = explode(";", $_GET['feet']);
            $min_area = $area[0];
            $max_area = $area[1];
        } else {
            $min_area = $range['min_area'];
            $max_area = $range['max_area'];
        }
        if (isset($_GET['bedroom'])) {
            $bedroom = explode(";", $_GET['bedroom']);
            $min_bedroom = $bedroom[0];
            $max_bedroom = $bedroom[1];
        } else {
            $min_bedroom = $range['min_bedroom'];
            $max_bedroom = $range['max_bedroom'];
        }
        if (isset($_GET['bathroom'])) {
            $bathroom = explode(";", $_GET['bathroom']);
            $min_bathroom = $bathroom[0];
            $max_bathroom = $bathroom[1];
        } else {
            $min_bathroom = $range['min_bathroom'];
            $max_bathroom = $range['max_bathroom'];
        }
        $communities_data = [];
        if (isset($_GET['value']) && $_GET['value']):
            $communities = Communities::with('homes')->where('city_id', $_GET['value'])->where('status_id', 2)->get();
        else:
            $communities = Communities::with('homes')->where('status_id', 2)->get();
        endif;
        foreach ($communities as $community) {
            foreach ($community->homes as $h) {
                if (Homes::where('id', $h->id)->whereBetween('price', [$min_price, $max_price])->whereBetween('area', [$min_area, $max_area])->whereBetween('bedroom', [$min_bedroom, $max_bedroom])->whereBetween('bathroom', [$min_bathroom, $max_bathroom])->where('status_id', 2)->count() > 0) {
                    array_push($communities_data, $community);
                    break;
                }
            }
        }
        $home_ids = [];
        foreach ($communities_data as $community) {
            foreach ($community->homes as $home) {
                if (!in_array($home->id, $home_ids)) {
                    array_push($home_ids, $home->id);
                }
            }
        }
        $com_min_price = [];
        $com_min_bed = [];
        $com_max_bed = [];
        $com_min_bath = [];
        $com_max_bath = [];
        $com_min_garage = [];
        $com_max_garage = [];
        $com_min_area = [];
        $com_max_area = [];
        $com_max_price = [];
        $homes = [];
        foreach ($home_ids as $home_id):
            if (Homes::where(['status_id' => 2, 'parent_id' => 0, 'id' => $home_id])->whereBetween('price', [$min_price, $max_price])->whereBetween('area', [$min_area, $max_area])->whereBetween('bedroom', [$min_bedroom, $max_bedroom])->whereBetween('bathroom', [$min_bathroom, $max_bathroom])->count() > 0) {
                $home = Homes::where(['status_id' => 2, 'parent_id' => 0, 'id' => $home_id])->whereBetween('price', [$min_price, $max_price])->whereBetween('area', [$min_area, $max_area])->whereBetween('bedroom', [$min_bedroom, $max_bedroom])->whereBetween('bathroom', [$min_bathroom, $max_bathroom])->first();
                array_push($com_min_price, $home->price);
                array_push($com_max_price, $home->price);
                array_push($com_min_bed, $home->bedroom);
                array_push($com_max_bed, $home->bedroom);
                array_push($com_min_bath, $home->bathroom);
                array_push($com_max_bath, $home->bathroom);
                array_push($com_min_garage, $home->garage);
                array_push($com_max_garage, $home->garage);
                array_push($com_min_area, $home->area);
                array_push($com_max_area, $home->area);
                $home->home_types = Homes::where('parent_id', $home->id)->where('status_id', 2)->get();
                array_push($homes, $home);
            }
        endforeach;
        if (isset($_GET['sortby']) && ($_GET['sortby'] == 'a_z')):
            $homes_collection = collect($homes);
            $this->data['communities'] = $homes_collection->sortBy('title');
        elseif (isset($_GET['sortby']) && ($_GET['sortby'] == 'z_a')):
            $homes_collection = collect($homes);
            $this->data['communities'] = $homes_collection->sortByDesc('title');        
        else:
            $this->data['communities'] = $homes;
        endif;
        $city_ids = [];
        $cities = [];
        foreach($communities_data as $community){
            if(!in_array($community->city_id, $city_ids)){
                array_push($city_ids, $community->city_id);
            }
        }
        foreach($city_ids as $city_id){
            $city = Cities::with('state')->where('id', $city_id)->first();
            $cities[$city_id] = $city->city . ' - ' . $city->state->code;
        }
        $this->data['cities'] = $cities;
        $this->data['ccount'] = sizeof($homes);
        $this->data['community'] = $communities_data;
        $range['min_price'] = min($com_min_price);
        $range['max_price'] = max($com_max_price);
        $range['min_area'] = min($com_min_area);
        $range['max_area'] = max($com_max_area);
        $range['min_bedroom'] = min($com_min_bed);
        $range['max_bedroom'] = max($com_max_bed);
        $range['min_bathroom'] = min($com_min_bath);
        $range['max_bathroom'] = max($com_max_bath);
        $this->data['range'] = $range;
        return view('elevations')->with($this->data);
    }
    public function SessionVariables(Request $request){
        $request->session()->forget('home_id');
        $request->session()->forget('lot_id');
        $request->session()->forget('home_type_id');
        $request->session()->forget('lot_group');
        $request->session()->forget('total_price');
        $request->session()->forget('base_price');
        $request->session()->forget('lot_price');
        $request->session()->forget('home_price');
        $request->session()->forget('floor_price');
        $request->session()->forget('color_scheme_id');
        $request->session()->forget('home_upgrade_features');
        $request->session()->forget('home_upgrade_patches');
        $request->session()->forget('home_customization');
        $request->session()->forget('floor_customization');
    }
}
