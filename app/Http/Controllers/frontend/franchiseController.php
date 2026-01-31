<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Franchise;
use App\Models\FranchiseCategoryChild;
use App\Models\FranchiseCategoryMain;
use App\Models\FranchiseCategorySub;
use App\Models\FranchiseImages;
use App\Models\FranchiseEnquiry;
use App\Models\FranchiseLocationDetail;
use Illuminate\Http\Request;


class franchiseController extends Controller
{
    
    public function franchiseListingHeaderMenu(){
        // $franchiseListingHeaderMenu = Franchise::select('f_id','f_country')->where(['f_status' => STATUS_ACTIVE])
        //     ->groupBy('f_country')
        //     ->orderBy('f_country', 'ASC')
        //     ->get();

        $franchiseListingHeaderMenu = Franchise::where('f_status', STATUS_ACTIVE)
            ->distinct()
            ->orderBy('f_country')
            ->pluck('f_country');
        return $franchiseListingHeaderMenu;
    }
    public function businessListingHeaderMenu()
    {
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        return $businessListingHeaderMenu;
    }
    
    public function blogCategoryHeaderMenu()
    {
        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        return $blogCategoryHeaderMenu;
    }

    public function mallCityHeaderMenu()
    {
        $mallCityHeaderMenu = (new mallController)->MallCityHeaderMenu();
        return $mallCityHeaderMenu;
    }

    public function couponHeaderMenu()
    {
        $couponHeaderMenu = (new couponController)->couponHeaderMenu();
        return $couponHeaderMenu;
    }

    public function offerHeaderMenu()
    {
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();
        return $offerHeaderMenu;
    }

    public function franchiseLisitngView(Request $request)
    {
         //DB::enableQueryLog();
         $franchiseCountryName = str_replace('-', ' ', $request->country);
        $franchiseCountryData = DB::table('franchise')
            ->select('f_id', 'f_country', 'f_state', 'f_city')
            ->where(['f_status' => STATUS_ACTIVE, 'f_country' => $franchiseCountryName])
            ->groupBy('f_state')
            ->get();
            //dd(DB::getQueryLog());
            return view('frontend.franchiseListing', ['franchiseListingHeaderMenu' => $this->franchiseListingHeaderMenu(),'blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(), 'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu(), 'franchiseDataArray' => $franchiseCountryData]);
    }

    public function franchiseLisitngState($franchiseCountry, $franchiseState)
    {
        $franchiseStateDataArray = DB::table('franchise')
            ->select('f_id', 'f_country', 'f_state', 'f_city')
            ->where(['f_status' => STATUS_ACTIVE, 'f_country' => $franchiseCountry, 'f_state' => $franchiseState])
            ->groupBy('f_city')
            ->get();
        return $franchiseStateDataArray;
    }

    public function franchiseLisitngCityView(Request $request)
    {
        $franchiseCityName = str_replace('-', ' ', $request->city);
        $franchiseCityData = DB::table('franchise')
            ->select('f_id', 'f_country', 'f_state', 'f_city', 'f_main_cat', 'f_sub_cat')
            ->where(['f_status' => STATUS_ACTIVE, 'f_city' => $franchiseCityName])
            ->groupBy('f_main_cat')
            ->get();

        return view('frontend.franchiseListingCity', ['franchiseListingHeaderMenu' => $this->franchiseListingHeaderMenu(),'blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(), 'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu(), 'franchiseCityData' => $franchiseCityData]);
    }

    public function franchiseCityBusinessList($busniessCity, $businessSubCategory)
    {
        $franchiseCityBusinessData = DB::table('franchise')
            ->select('f_id', 'f_country', 'f_state', 'f_city', 'f_main_cat', 'f_sub_cat')
            ->where(['f_status' => STATUS_ACTIVE, 'f_city' => $busniessCity, 'f_sub_cat' => $businessSubCategory])
            ->get();
        return $franchiseCityBusinessData;
    }

    public function franchiseCategoryListView(Request $request)
    {
        $franchiseCityName = str_replace('-', ' ', $request->city);
        $franchiseCategoryName = str_replace('-', ' ', $request->category);
        $franchiseLisitngCategoryData = Franchise::where(['f_status' => STATUS_ACTIVE, 'f_city' => $franchiseCityName, 'f_sub_cat' => $franchiseCategoryName])
            ->orderBy('f_id', 'DESC')
            ->get();
            //dd($franchiseLisitngCategoryData);
        return view('frontend.franchiseListingCategory', ['franchiseListingHeaderMenu' => $this->franchiseListingHeaderMenu(),'blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(), 'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu(), 'franchiseLisitngCategoryData' => $franchiseLisitngCategoryData]);
    }

    public function getFranchiseImages($id)
    {
        $franchiseImagesData = FranchiseImages::where(['fi_franchise_id' => $id])
            ->orderBy('fi_id', 'ASC')
            ->first();
        return $franchiseImagesData['fi_path'];
    }

    public function getLatestFranchiseListing($city)
    {
        $getLatestFranchiseListingArray = Franchise::where(['f_status' => STATUS_ACTIVE, 'f_city' => $city])
            ->groupBy('f_sub_cat')
            ->orderBy('f_id', 'DESC')
            ->limit(10)
            ->get();
        return $getLatestFranchiseListingArray;
    }

    public function franchiseDetailView(Request $request)
    {
        $franchiseCityName = str_replace('-', ' ', $request->city);
        $franchiseCategoryName = str_replace('-', ' ', $request->category);
        $brandName = str_replace('-', ' ', $request->title);

        $franchiseDetailResult = Franchise::where(['f_status' => STATUS_ACTIVE, 'f_city' => $franchiseCityName, 'f_sub_cat' => $franchiseCategoryName, 'f_brand_name' => $brandName])
            ->orderBy('f_id', 'DESC')
            ->first();
        if(empty($franchiseDetailResult) && $franchiseDetailResult == '' ){
            return '<img src="'.NOT_FOUND_IMAGE_PATH.'" style=" height: 650px; display: block;margin: auto;">';
        }else{
            $getFranchiseLocationDetail = FranchiseLocationDetail::where(['fld_franchise_id'=>$franchiseDetailResult['f_id']])->orderBy('fld_id', 'DESC')->get();
                //dd($franchiseDetailResult);
            return view('frontend.franchiseListingDetail', ['franchiseListingHeaderMenu' => $this->franchiseListingHeaderMenu(),'blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(), 'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu(), 'franchiseDetailResult' => $franchiseDetailResult,'getFranchiseLocationDetail' => $getFranchiseLocationDetail]);
        }
    }

    public function getAllFranchiseImage($id)
    {
        $allFranchiseLisitngImageData = FranchiseImages::where(['fi_franchise_id' => $id])
            ->orderBy('fi_id', 'ASC')
            ->get();
        return $allFranchiseLisitngImageData;
    }

    public function franchiseAddView()
    {
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = 'login';
            </script>";
        }

        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        $mainCategoryData = FranchiseCategoryMain::where(['fcm_status'=>STATUS_ACTIVE])->orderBy('fcm_id', 'DESC')->get();
        return view('frontend.userFranchiseAdd', ['blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu, 'mallCityHeaderMenu' => $mallCityHeaderMenu, 'couponHeaderMenu' => $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu,'mainCategoryData'=>$mainCategoryData]);
    }

    public function getFranchiseSubCategory(Request $request){
        $franchiseCategorySubData = FranchiseCategorySub::where(['fcs_status'=>STATUS_ACTIVE,'fcs_cat_main_id'=>$request->catmain_id])->orderBy('fcs_id', 'DESC')->get();
        $optionTag = ' <option value="">Select Sub Category</option>';
        foreach($franchiseCategorySubData as $franchiseCategorySubRow)
        {
            $optionTag .= ' <option value="'.$franchiseCategorySubRow['fcs_id'].'">'.$franchiseCategorySubRow['fcs_name'].'</option>';
        }
        echo $optionTag;
    }
    public function getFranchiseChildCategory(Request $request){
        $franchiseCategoryChildData = FranchiseCategoryChild::where(['fcc_status'=>STATUS_ACTIVE,'fcc_cat_main_id'=>$request->catmain_id,'fcc_cat_sub_id'=>$request->catsub_id])->orderBy('fcc_id', 'DESC')->get();
        $optionTag = ' <option value="">Select Child Category</option>';
        foreach($franchiseCategoryChildData as $franchiseCategoryChildRow)
        {
            $optionTag .= ' <option value="'.$franchiseCategoryChildRow['fcc_id'].'">'.$franchiseCategoryChildRow['fcc_name'].'</option>';
        }
        echo $optionTag;
    }
    
    public function franchiseStoreOld(Request $request)
    {
        //dd($request->all());
        //DB::enableQueryLog();
        $franchiseCategoryData = FranchiseCategoryMain::join('franchise_category_sub', 'franchise_category_sub.fcs_cat_main_id', '=', 'franchise_category_main.fcm_id')
        ->join('franchise_category_child', 'franchise_category_child.fcc_cat_main_id', '=', 'franchise_category_main.fcm_id')
        ->where(['fcm_id' => $request->f_main_cat, 'fcs_id' => $request->f_sub_cat, 'fcc_id' => $request->f_child_cat])
        ->orderBy('fcs_id', 'DESC')
        ->first(['franchise_category_sub.fcs_name', 'franchise_category_main.fcm_name', 'franchise_category_child.fcc_name']);
        //dd(DB::getQueryLog());

        $franchiseInsertData = Franchise::create([
            'f_user_id' => Auth::user()->id,
            'f_status' => STATUS_INACTIVE,
            'f_main_cat' =>$franchiseCategoryData['fcm_name'],
            'f_sub_cat' => $franchiseCategoryData['fcs_name'],
            'f_child_cat' => $franchiseCategoryData['fcc_name'],

            'f_name' => $request->f_name,
            'f_email' => $request->f_email,
            'f_contact_no' => $request->f_contact_no,
            'f_alt_contact' => $request->f_alt_contact,
            'f_type' => $request->f_type,
            'f_start_year' => $request->f_start_year,

            'f_country' => $request->f_country,
            'f_state' => $request->f_state,
            'f_city' => $request->f_city,
            'f_pin_code' => $request->f_pin_code,
            'f_headquarter' => $request->f_headquarter,
            'f_location' => $request->f_location,
            'f_space_req' => $request->f_space_req,
            'f_investment_range' => $request->f_investment_range,

            'f_website_url' => $request->f_website_url,
            'f_twitter_url' => $request->f_twitter_url,
            'f_facebook_url' => $request->f_facebook_url,
            'f_instagram_url' => $request->f_instagram_url,

            'f_north' => $request->f_north,
            'f_south' => $request->f_south,
            'f_east' => $request->f_east,
            'f_west' => $request->f_west,
            'f_center' => $request->f_center,
            'f_union_territories' => $request->f_union_territories,
            'f_desc' => $request->f_desc,

            'f_meta_title' => $request->f_meta_title,
            'f_meta_keyword' => $request->f_meta_keyword,
            'f_meta_description' => $request->f_meta_description,

            'f_added_time' => CURRENT_DATE_TIME
        ]);
        if($franchiseInsertData){
            $franchiseLastInsertId = DB::getPdo()->lastInsertId();

            if ($request->hasfile('franchise_images')) {
                foreach ($request->file('franchise_images') as $file) {
                    $filename = time() . '.' . $file->getClientOriginalName();
                    $file->move('custom-images/franchise-images/', $filename);
                    $file = new FranchiseImages();
                    $file->fi_path = $filename;
                    $file->fi_franchise_id = $franchiseLastInsertId;
                    $file->fi_added_time = CURRENT_DATE_TIME;
                    $file->save();
                }
            }

            return redirect('/franchiseAdd')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/franchiseAdd')->with('message',MSG_ADD_ERROR);
        }
    }

public function franchiseStore(Request $request)
    {
        //dd($request->all());
        //DB::enableQueryLog();
        $franchiseCategoryData = FranchiseCategoryMain::join('franchise_category_sub', 'franchise_category_sub.fcs_cat_main_id', '=', 'franchise_category_main.fcm_id')
        ->join('franchise_category_child', 'franchise_category_child.fcc_cat_main_id', '=', 'franchise_category_main.fcm_id')
        ->where(['fcm_id' => $request->f_main_cat, 'fcs_id' => $request->f_sub_cat, 'fcc_id' => $request->f_child_cat])
        ->orderBy('fcs_id', 'DESC')
        ->first(['franchise_category_sub.fcs_name', 'franchise_category_main.fcm_name', 'franchise_category_child.fcc_name']);
        //dd(DB::getQueryLog());

        $franchiseInsertData = Franchise::create([
            'f_user_id' => Auth::user()->id,
            'f_status' => STATUS_INACTIVE,
            'f_main_cat' =>$franchiseCategoryData['fcm_name'],
            'f_sub_cat' => $franchiseCategoryData['fcs_name'],
            'f_child_cat' => $franchiseCategoryData['fcc_name'],

            'f_name' => $request->f_name,
            'f_email' => $request->f_email,
            'f_contact_no' => $request->f_contact_no,
            'f_alt_contact' => $request->f_alt_contact,
            'f_type' => $request->f_type,
            'f_start_year' => $request->f_start_year,

            'f_country' => $request->f_country,
            'f_state' => $request->f_state,
            'f_city' => $request->f_city,
            'f_pin_code' => $request->f_pin_code,
            'f_headquarter' => $request->f_headquarter,
            'f_location' => $request->f_location,
            'f_space_req' => $request->f_space_req,
            'f_investment_range' => $request->f_investment_range,

            'f_website_url' => $request->f_website_url,
            'f_twitter_url' => $request->f_twitter_url,
            'f_facebook_url' => $request->f_facebook_url,
            'f_instagram_url' => $request->f_instagram_url,

            'f_north' => $request->f_north,
            'f_south' => $request->f_south,
            'f_east' => $request->f_east,
            'f_west' => $request->f_west,
            'f_center' => $request->f_center,
            'f_union_territories' => $request->f_union_territories,
            'f_desc' => $request->f_desc,

            'f_meta_title' => $request->f_meta_title,
            'f_meta_keyword' => $request->f_meta_keyword,
            'f_meta_description' => $request->f_meta_description,

            'f_added_time' => CURRENT_DATE_TIME
        ]);
        if($franchiseInsertData){
            $franchiseLastInsertId = DB::getPdo()->lastInsertId();

            if ($request->hasfile('franchise_images')) {
                foreach ($request->file('franchise_images') as $file) {
                    $filename = time() . '.' . $file->getClientOriginalName();
                    $file->move('custom-images/franchise-images/', $filename);
                    $file = new FranchiseImages();
                    $file->fi_path = $filename;
                    $file->fi_franchise_id = $franchiseLastInsertId;
                    $file->fi_added_time = CURRENT_DATE_TIME;
                    $file->save();
                }
            }

            return redirect('/franchiseAdd')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/franchiseAdd')->with('message',MSG_ADD_ERROR);
        }
    }


    public function franchiseListView(Request $request)
    {

        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();
        //DB::enableQueryLog();
        $getFranchiseData = Franchise::where(['f_status'=>$request->status,'f_user_id'=>Auth::user()->id])->orderBy('f_id', 'DESC')->get();
        //dd(DB::getQueryLog());
        return view('frontend.userFranchiseList',['getFranchiseData'=>$getFranchiseData,'blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu, 'mallCityHeaderMenu' => $mallCityHeaderMenu, 'couponHeaderMenu' => $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu]);
       
    }

    function franchiseEnquiryStore(Request $request){
        $franchiseEnquiryInsertData = FranchiseEnquiry::create([
            'fe_franchise_id' =>$request->fe_franchise_id,
            'fe_name' =>$request->fe_name,
            'fe_email' =>$request->fe_email,
            'fe_contact_no' =>$request->fe_contact_no,
            'fe_country' =>$request->fe_country,
            'fe_state' =>$request->fe_state,
            'fe_city' =>$request->fe_city,
            'fe_investment_range' =>$request->fe_investment_range,
            'fe_address' =>$request->fe_address,
            'fe_added_timestamp' => CURRENT_DATE_TIME
        ]);
        if($franchiseEnquiryInsertData){
           echo "<script>
           alert('Your Requrest Has Been Sent Successfully, We Will Contact You Shortly');
                window.location.href='/';
            </script>";
        }else{
            echo "<script>
           alert('Your Request Not Submitted Sucessfully');
                window.location.href='/';
            </script>";
        }
    }


}
