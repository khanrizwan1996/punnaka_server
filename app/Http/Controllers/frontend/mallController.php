<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mall;
use Illuminate\Support\Facades\DB;
class mallController extends Controller
{
    public function mallCityHeaderMenu(){
        // $mallCityHeaderMenu = DB::table('mall')
        //     ->select('mall_id','mall_city')
        //     ->where(['mall_status' => STATUS_ACTIVE])
        //     ->groupBy('mall_city')
        //     ->orderBy('mall_city', 'ASC')
        //     ->get();

        $mallCityHeaderMenu = DB::table('mall')
            ->where('mall_status', STATUS_ACTIVE)
            ->distinct()
            ->orderBy('mall_city','ASC')
            ->pluck('mall_city');
        return $mallCityHeaderMenu;
    }

    public function cityWiseMallDataHeaderMenu($city){
        $cityWiseMallDataHeaderMenu = DB::table('mall')
            ->select('mall_id','mall_name','mall_city')
            ->where(['mall_status' => STATUS_ACTIVE,'mall_city' => $city])
            ->orderBy('mall_id', 'DESC')
            ->get();
        return $cityWiseMallDataHeaderMenu;
    }


    public function mallInIndiaList(){
        $mallInIndiaListArray = DB::table('mall')
            ->select('mall_id','mall_name','mall_city','mall_logo','mall_location')
            ->where(['mall_status' => STATUS_ACTIVE])
            ->inRandomOrder()
            ->limit(10)
            ->get();
        return $mallInIndiaListArray;
    }


    public function mallDetailView($parameter1,$parameter2)
    {   
        $cityName = substr($parameter1,9);
        $newCityName = str_replace('-', ' ',$cityName);
        $mallName = str_replace('-', ' ',$parameter2);
        
        //DB::enableQueryLog();
        $mallSingleData = Mall::where(['mall_status' => STATUS_ACTIVE,'mall_city' => $newCityName, 'mall_name' => $mallName])->OrderBy('mall_id','DESC')->first();
        //dd(DB::getQueryLog());
        if(empty($mallSingleData) && $mallSingleData == '' ){
            return '<img src="'.NOT_FOUND_IMAGE_PATH.'" style=" height: 650px; display: block;margin: auto;">';
        }else{
            $mallId = $mallSingleData['mall_id'];
            
            $mallImagesArray = DB::table('mall_images')
            ->select('mall_img_path','mall_img_mall_id','mall_img_id')
            ->where(['mall_img_mall_id' => $mallId])
            ->orderBy('mall_img_id', 'DESC')
            ->get();

            $brandsArray = DB::table('brands')
            ->select('brand_id','brand_name','brand_mall_id','brand_logo','brand_email','brand_location')
            ->where(['brand_mall_id' => $mallId])
            ->orderBy('brand_id', 'DESC')
            ->get();


            $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
            $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();
            $couponHeaderMenu = (new couponController)->couponHeaderMenu();
            $offerHeaderMenu = (new offersController)->offerHeaderMenu();

            return view('frontend.mall',['mallCityHeaderMenu'=>$this->mallCityHeaderMenu(),'mallSingleData' => $mallSingleData, 'mallImagesArray' => $mallImagesArray,'brandsArray'=>$brandsArray,
            'blogCategoryHeaderMenu'=>$blogCategoryHeaderMenu,'couponHeaderMenu'=>$couponHeaderMenu,'offerHeaderMenu'=>$offerHeaderMenu,'businessListingHeaderMenu'=>$businessListingHeaderMenu]);
        } 
    }
    
    public function singleMallDataById($mallId) {
      
        $singleMallArray = DB::table('mall')
        ->select('mall_id','mall_name','mall_city')
        ->where(['mall_id' => $mallId])
        ->first();
        return $singleMallArray;
        
    }


}
