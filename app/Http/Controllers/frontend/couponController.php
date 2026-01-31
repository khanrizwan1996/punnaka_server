<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupons;
use App\Models\CategoryMain;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class couponController extends Controller
{

    public function couponHeaderMenu()
    {
        $couponHeaderMenu = Coupons::where(['coupon_status' => STATUS_ACTIVE])
            ->groupBy('coupon_country')
            ->orderBy('coupon_country', 'ASC')
            ->get();
        return $couponHeaderMenu;
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

    public function offerHeaderMenu()
    {
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();
        return $offerHeaderMenu;
    }

    public function couponListingView(Request $request)
    {

        $couponCountryData = DB::table('coupons')
            ->select('coupon_id', 'coupon_country', 'coupon_state', 'coupon_city')
            ->where(['coupon_status' => STATUS_ACTIVE, 'coupon_country' => $request->country])
            ->groupBy('coupon_state')
            ->get();
        return view('frontend.couponListing', ['blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(), 'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu(), 'couponCountryDataArray' => $couponCountryData]);
    }

    public function couponCity($couponCountry, $couponState)
    {
        $couponCityData = DB::table('coupons')
            ->select('coupon_id', 'coupon_country', 'coupon_state', 'coupon_city')
            ->where(['coupon_status' => STATUS_ACTIVE, 'coupon_country' => $couponCountry, 'coupon_state' => $couponState])
            ->groupBy('coupon_city')
            ->get();
        return $couponCityData;
    }

    public function couponCityView(Request $request)
    {
        $couponCityName = str_replace('-', ' ', $request->city);
        $couponCityArray = DB::table('coupons')
            ->select('coupon_id', 'coupon_country', 'coupon_state', 'coupon_city', 'coupon_main_category', 'coupon_sub_category')
            ->where(['coupon_status' => STATUS_ACTIVE, 'coupon_city' => $couponCityName])
            ->groupBy('coupon_main_category')
            ->get();

        return view('frontend.couponCityListing', ['blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(), 'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu(), 'couponCityArray' => $couponCityArray]);
    }

    public function couponCitySubCategoryData($couponCity, $couponSubCategory)
    {
        $couponCitySubCategoryDataArray = DB::table('coupons')
            ->select('coupon_id', 'coupon_country', 'coupon_state', 'coupon_city', 'coupon_main_category', 'coupon_sub_category')
            ->where(['coupon_status' => STATUS_ACTIVE, 'coupon_city' => $couponCity, 'coupon_sub_category' => $couponSubCategory])
            ->groupBy('coupon_sub_category')
            ->get();
        return $couponCitySubCategoryDataArray;
    }

    public function couponCategoryView(Request $request)
    {
        $couponCityName = str_replace('-', ' ', $request->city);
        $couponCategoryName = str_replace('-', ' ', $request->category);

        $couponLisitngCategoryArray = Coupons::where(['coupon_status' => STATUS_ACTIVE, 'coupon_city' => $couponCityName, 'coupon_sub_category' => $couponCategoryName])
            ->orderBy('coupon_id', 'DESC')
            ->get();

        return view('frontend.couponListingCategory', ['blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(), 'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(),  'offerHeaderMenu'=> $this->offerHeaderMenu(),'couponLisitngCategoryArray' => $couponLisitngCategoryArray]);
    }

    public function GetCouponImage($id)
    {
        $couponImageArray = Coupons::where(['coupon_id' => $id])
            ->orderBy('coupon_id', 'ASC')
            ->first();
        return $couponImageArray['coupon_image'];
    }

    public function getLatestCouponListing($city)
    {
        $getLatestCouponListingArray = Coupons::where(['coupon_status' => STATUS_ACTIVE, 'coupon_city' => $city])
            ->groupBy('coupon_sub_category')
            ->orderBy('coupon_id', 'DESC')
            ->limit(10)
            ->get();
        return $getLatestCouponListingArray;
    }

    public function couponDetailView(Request $request)
    {
        $couponCityName = str_replace('-', ' ', $request->city);
        $couponCategoryName = str_replace('-', ' ', $request->category);
        $couponName = str_replace('-', ' ', $request->title);

        $couponDetailRow = Coupons::where(['coupon_status' => STATUS_ACTIVE, 'coupon_city' => $couponCityName, 'coupon_sub_category' => $couponCategoryName, 'coupon_title' => $couponName])
            ->orderBy('coupon_id', 'DESC')
            ->first();
        if(empty($couponDetailRow) && $couponDetailRow == '' ){
            return '<img src="'.NOT_FOUND_IMAGE_PATH.'" style=" height: 650px; display: block;margin: auto;">';
        }else{
            return view('frontend.couponDetail', ['blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(), 'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu(), 'couponDetailRow' => $couponDetailRow]);
        }
    }

    public function couponListView(Request $request)
    {

        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        $getCouponData = Coupons::where(['coupon_status'=>$request->status,'coupon_user_id'=>Auth::user()->id])->orderBy('coupon_id', 'DESC')->get();
        return view('frontend.userCouponList',['getCouponData'=>$getCouponData,'blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu, 'mallCityHeaderMenu' => $mallCityHeaderMenu, 'couponHeaderMenu' => $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu]);
    }

    public function couponAddView()
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

        $mainCategoryData = CategoryMain::where(['cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
        return view('frontend.userCouponAdd', ['blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu, 'mallCityHeaderMenu' => $mallCityHeaderMenu, 'couponHeaderMenu' => $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu,'mainCategoryData'=>$mainCategoryData]);
    }

    public function couponStore(Request $request){
        //dd($request->all());

        //DB::enableQueryLog();
        $blogCategoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where(['cat_main_id'=>$request->coupon_main_category,'cat_sub_id'=>$request->coupon_sub_category])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);
       //dd(DB::getQueryLog());203


       $coupon_start_date_time = Carbon::parse($request->coupon_start_date." ".$request->coupon_start_time)->getPreciseTimestamp(3);
       $coupon_end_date_time = Carbon::parse($request->coupon_end_date." ".$request->coupon_end_time)->getPreciseTimestamp(3);

        if($request->hasfile('coupon_image'))
        {
            $couponImageFile = $request->file('coupon_image');
            $couponImageFileName = $couponImageFile->getClientOriginalName();
            $newCouponImage = time().'.'.$couponImageFileName;
            $couponImageFile->move('custom-images/coupons',$newCouponImage);
        }
        if($request->hasfile('coupon_brand_image'))
        {
            $couponBrandImageFile = $request->file('coupon_brand_image');
            $couponBrandImageFileName = $couponBrandImageFile->getClientOriginalName();
            $newCouponBrandImage = time().'.'.$couponBrandImageFileName;
            $couponBrandImageFile->move('custom-images/coupons',$newCouponBrandImage);
        }

        /*if($request->hasfile('coupon_t_c'))
        {

            $couponTCFile = $request->file('coupon_t_c');
            $couponTCFileName = $couponTCFile->getClientOriginalName();
            $newCouponTCFile = time().'.'.$couponTCFileName;
            $couponTCFile->move('custom-images/coupons',$newCouponTCFile);
        }*/

        $couponInsertData = Coupons::create([
            'coupon_main_category' => $blogCategoryData['cat_main_name'],
            'coupon_sub_category' => $blogCategoryData['cat_sub_name'],
            'coupon_user_id' => Auth::user()->id,

            'coupon_brand_name' => $request->coupon_brand_name,
            'coupon_company_name' => $request->coupon_company_name,
            'coupon_title' => $request->coupon_title,
            'coupon_code' => $request->coupon_code,
            'coupon_contact' => $request->coupon_contact,
            'coupon_country' => $request->coupon_country,

            'coupon_start_date_time' => $coupon_start_date_time,
            'coupon_end_date_time' => $coupon_end_date_time,
            'coupon_state' => $request->coupon_state,
            'coupon_city' => $request->coupon_city,
            'coupon_website' => $request->coupon_website,
            'coupon_location' => $request->coupon_location,
            'coupon_product_services' => $request->coupon_product_services,
            'coupon_description' => $request->coupon_description,
            'coupon_brand_detail' => $request->coupon_brand_detail,

            'coupon_brand_image' => $newCouponBrandImage,
            'coupon_image' => $newCouponImage,
            'coupon_t_c' => $request->coupon_t_c,

            'coupon_meta_title' => $request->coupon_meta_title,
            'coupon_meta_keyword' => $request->coupon_meta_keyword,
            'coupon_meta_description' => $request->coupon_meta_description,

            'coupon_status' => STATUS_INACTIVE,
            'coupon_added_time' => CURRENT_DATE_TIME
        ]);
        if($couponInsertData)
        {
            return redirect('/couponAdd')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/couponAdd')->with('message',MSG_ADD_ERROR);
        }
    }

    public function couponEditView(Request $request){
        $mainCategoryData = CategoryMain::where(['cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();

        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        $couponSingleData = Coupons::where('coupon_id',$request->id)->first();
        return view('frontend.userCouponEdit',['blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu, 'mallCityHeaderMenu' => $mallCityHeaderMenu, 'couponHeaderMenu' => $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu,'mainCategoryData'=>$mainCategoryData,'couponSingleData'=>$couponSingleData]);
    }

    public function couponUpdate(Request $request){
        if($request->hasfile('coupon_image'))
        {
            $couponImageFile = $request->file('coupon_image');
            $couponImageFileName = $couponImageFile->getClientOriginalName();
            $newCouponImage = time().'.'.$couponImageFileName;
            $couponImageFile->move('custom-images/coupons',$newCouponImage);
            if(isset($request->old_coupon_image))
            {
                unlink('custom-images/coupons/'.$request->old_coupon_image);
            }
        }else{
            $newCouponImage = $request->old_coupon_image;
        }

        if($request->hasfile('coupon_brand_image'))
        {
            $couponBrandImageFile = $request->file('coupon_brand_image');
            $couponBrandImageFileName = $couponBrandImageFile->getClientOriginalName();
            $newCouponBrandImage = time().'.'.$couponBrandImageFileName;
            $couponBrandImageFile->move('custom-images/coupons',$newCouponBrandImage);
            if(isset($request->old_coupon_brand_image))
            {
                unlink('custom-images/coupons/'.$request->old_coupon_brand_image);
            }
        }else{
            $newCouponBrandImage = $request->old_coupon_brand_image;
        }

        /*if($request->hasfile('coupon_t_c'))
        {
            $couponTCFile = $request->file('coupon_t_c');
            $couponTCFileName = $couponTCFile->getClientOriginalName();
            $newCouponTCFile = time().'.'.$couponTCFileName;
            $couponTCFile->move('custom-images/coupons',$newCouponTCFile);
            if(isset($request->old_coupon_t_c))
            {
                unlink('custom-images/coupons/'.$request->old_coupon_t_c);
            }
        }else{
            $newCouponTCFile = $request->old_coupon_t_c;
        }*/

        if(isset($request->coupon_main_category) && isset($request->coupon_sub_category))
        {
            $blogCategoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where([ 'cat_main_id'=>$request->coupon_main_category,'cat_sub_id'=>$request->coupon_sub_category])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);

            $catMainName = $blogCategoryData['cat_main_name'];
            $catSubName = $blogCategoryData['cat_sub_name'];

        }else{
            $catMainName = $request->old_coupon_main_category;
            $catSubName = $request->old_coupon_sub_category;
        }
        $coupon_start_date_time = Carbon::parse($request->coupon_start_date." ".$request->coupon_start_time)->getPreciseTimestamp(3);
        $coupon_end_date_time = Carbon::parse($request->coupon_end_date." ".$request->coupon_end_time)->getPreciseTimestamp(3);

        $couponUpdateData =Coupons::where("coupon_id", $request->id)->update(
            [
                'coupon_main_category' => $catMainName,
                'coupon_sub_category' => $catSubName,
                'coupon_brand_name' => $request->coupon_brand_name,
                'coupon_company_name' => $request->coupon_company_name,
                'coupon_title' => $request->coupon_title,
                'coupon_code' => $request->coupon_code,
                'coupon_contact' => $request->coupon_contact,
                'coupon_country' => $request->coupon_country,

                'coupon_start_date_time' => $coupon_start_date_time,
                'coupon_end_date_time' => $coupon_end_date_time,
                'coupon_state' => $request->coupon_state,
                'coupon_city' => $request->coupon_city,
                'coupon_website' => $request->coupon_website,
                'coupon_location' => $request->coupon_location,
                'coupon_product_services' => $request->coupon_product_services,
                'coupon_description' => $request->coupon_description,
                'coupon_brand_detail' => $request->coupon_brand_detail,

                'coupon_brand_image' => $newCouponBrandImage,
                'coupon_image' => $newCouponImage,
                'coupon_t_c' => $request->coupon_t_c,

                'coupon_meta_title' => $request->coupon_meta_title,
                'coupon_meta_keyword' => $request->coupon_meta_keyword,
                'coupon_meta_description' => $request->coupon_meta_description,
                'coupon_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($couponUpdateData)
        {
            return redirect('couponEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('couponEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }

}
