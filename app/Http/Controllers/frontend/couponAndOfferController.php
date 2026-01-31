<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\CouponOffer;
use Illuminate\Http\Request;

class couponAndOfferController extends Controller
{
    public function getCouponAndOfferListingHeaderMenu(){
        $couponAndOfferListingHeaderMenu = CouponOffer::select('cf_id','cf_listing_type')
        ->where(['cf_status' => STATUS_ACTIVE])
        ->groupBy('cf_listing_type')
        ->orderBy('cf_listing_type', 'ASC')
        ->get();
        return $couponAndOfferListingHeaderMenu;
    }

    public function couponTypeListingView(Request $request){
       $couponType = ucwords(str_replace('-', ' ', $request->type));
        
       if($couponType == 'Coupon Promo Code'){
        $cf_listing_type = 'Coupon / Promo Code';
        }else if($couponType == 'Offer Deal'){
            $cf_listing_type = 'Offer / Deal';
        }else if($couponType == 'Free Sample'){
            $cf_listing_type = 'Free Sample';
        }else if($couponType == 'Free Recharge Coupon'){
            $cf_listing_type = 'Free Recharge Coupon';
        }

        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

    
        $getCouponTypeLisitng = CouponOffer::where(['cf_status' => STATUS_ACTIVE, 'cf_listing_type' => $cf_listing_type])
        ->orderBy('cf_id', 'DESC')
        ->get();

        $getLatestCouponOfferListing = CouponOffer::where(['cf_status' => STATUS_ACTIVE, 'cf_listing_type' => $cf_listing_type])
            ->orderBy('cf_id', 'DESC')
            ->limit(10)
            ->get();
        return view('frontend.couponListing', ['blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu,'mallCityHeaderMenu' => $mallCityHeaderMenu,'couponHeaderMenu'=> $couponHeaderMenu,  'offerHeaderMenu'=> $offerHeaderMenu,'getCouponTypeLisitng' => $getCouponTypeLisitng,'getLatestCouponOfferListing' => $getLatestCouponOfferListing]);
    }

        public function couponDetailView(Request $request){

        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        $couponCityName = urldecode(str_replace('-', ' ', $request->city));
        $couponCategoryName = str_replace('-', ' ', $request->category);
        $couponName = str_replace('-', ' ', $request->title);
        
        
        $couponDetail = CouponOffer::where(['cf_status' => STATUS_ACTIVE, 'cf_city' => $couponCityName, 'cf_sub_cat' => $couponCategoryName, 'cf_title' => $couponName])
            ->orderBy('cf_id', 'DESC')
            ->first();

        $getLatestCouponOfferListing = CouponOffer::where(['cf_status' => STATUS_ACTIVE, 'cf_listing_type' => $couponDetail['cf_listing_type']])
        ->orderBy('cf_id', 'DESC')
        ->limit(10)
        ->get();

        if(empty($couponDetail) && $couponDetail == '' ){
            return '<img src="'.NOT_FOUND_IMAGE_PATH.'" style=" height: 650px; display: block;margin: auto;">';
        }else{
            return view('frontend.couponDetail', ['blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu,'mallCityHeaderMenu' => $mallCityHeaderMenu,'couponHeaderMenu'=> $couponHeaderMenu, 'offerHeaderMenu'=> $offerHeaderMenu, 'couponDetail' => $couponDetail,'getLatestCouponOfferListing'=>$getLatestCouponOfferListing]);
        }
    }
    
}
