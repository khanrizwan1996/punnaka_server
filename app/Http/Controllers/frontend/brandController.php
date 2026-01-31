<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands;
use Illuminate\Support\Facades\DB;
class brandController extends Controller
{
    public function brandDetailView($parameter1,$parameter2,$parameter3)
    {         
        $cityName = substr($parameter1,9);
        $mallName = str_replace('-', ' ',$parameter2);
        $brandName = str_replace('-', ' ',$parameter3);
 
        //DB::enableQueryLog();
        $brandSingleData = Brands::join('mall', 'mall.mall_id', '=', 'brands.brand_mall_id')
        ->where(['mall.mall_city' => $cityName, 'mall.mall_name' => $mallName, 'brands.brand_name' => $brandName])
        ->orderBy('brands.brand_id', 'DESC')
        ->first([
            'mall.mall_id', 'mall.mall_name', 'brands.brand_id', 'brands.brand_mall_id',
            'brands.brand_name', 'brands.brand_name','brands.brand_contact_no', 'brands.brand_email',
            'brands.brand_main_cat', 'brands.brand_sub_cat','brands.brand_prodct_services', 'brands.brand_store_type',
            'brands.brand_floor', 'brands.brand_area','brands.brand_location', 'brands.brand_city',
            'brands.brand_store_timings', 'brands.brand_store_weekend_timings','brands.brand_store_weekday_timings', 'brands.brand_logo',
            'brands.brand_desc', 'brands.brand_meta_title','brands.brand_meta_keyword', 'brands.brand_meta_description',
        ]);
        //dd(DB::getQueryLog());
        if(empty($brandSingleData) && $brandSingleData == '' ){
            return '<img src="'.NOT_FOUND_IMAGE_PATH.'" style=" height: 650px; display: block;margin: auto;">';
        }else{
            $brandId = $brandSingleData['brand_id'];

            
            $brandmagesArray = DB::table('brand_images')
            ->select('brand_img_id','brand_img_brand_id','brand_img_path')
            ->where(['brand_img_brand_id' => $brandId])
            ->orderBy('brand_img_id', 'DESC')
            ->get();

            $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
            $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();
            $mallCityHeaderMenu = (new mallController)->MallCityHeaderMenu();
            $couponHeaderMenu = (new couponController)->couponHeaderMenu();
            $offerHeaderMenu = (new offersController)->offerHeaderMenu();
            
            return view('frontend.brand',['mallCityHeaderMenu'=>$mallCityHeaderMenu,
            'brandSingleData' => $brandSingleData,
            'brandmagesArray'=> $brandmagesArray,
            'blogCategoryHeaderMenu'=>$blogCategoryHeaderMenu,'businessListingHeaderMenu'=>$businessListingHeaderMenu,
            'couponHeaderMenu'=>$couponHeaderMenu,
            'offerHeaderMenu'=> $offerHeaderMenu ]);
        }   
    }
}
