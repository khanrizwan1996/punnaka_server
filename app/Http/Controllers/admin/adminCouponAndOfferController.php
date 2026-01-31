<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CouponOffer;
use App\Models\User;
use App\Models\CategoryMain;
class adminCouponAndOfferController extends Controller
{
    public function couponAndServiceListView(){
        $couponOfferData = CouponOffer::orderBy('cf_id', 'DESC')->get();
        return view('admin.couponAndOfferList',['couponOfferData'=>$couponOfferData]);
    }
    public function couponAndServiceAdd(){
        $mainCategoryData = CategoryMain::where(['cat_main_type' => TYPE_BUSINESS_LISTING, 'cat_main_status' => STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
        $UserData = User::where(['status'=>STATUS_ACTIVE])->orderBy('id', 'DESC')->get();
        return view('admin.couponAndServiceAdd',['mainCategoryData'=>$mainCategoryData,'UserData'=>$UserData]);
    }
}
