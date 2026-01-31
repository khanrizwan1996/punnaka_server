<?php

namespace App\Http\Controllers\user_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CategoryMain;
use Illuminate\Support\Carbon;
use App\Models\Coupons;

class userCouponController extends Controller
{

    public function couponAddView()
    {
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = 'login';
            </script>";
        }else{
            $checkOfferCountByUserId = DB::table('coupons')->where('coupon_user_id', Auth::user()->id)->count();
            if($checkOfferCountByUserId > 0) {
                echo "<script>
                    alert('You can add only 1 coupons');
                    window.location.href = 'dashboard';
                </script>";
            }else{
                $mainCategoryData = CategoryMain::where(['cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
                return view('user_admin.couponAdd',['mainCategoryData'=>$mainCategoryData]);
            }
        }
    }

    public function couponStore(Request $request)
    {
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
            return redirect(USER_ADMIN_URL.'couponAdd')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect(USER_ADMIN_URL.'couponAdd')->with('message',MSG_ADD_ERROR);
        }
    }

    public function couponListView(Request $request)
    {
        $getCouponData = Coupons::where(['coupon_user_id'=>Auth::user()->id])->orderBy('coupon_id', 'DESC')->get();
        return view('user_admin.couponList',['getCouponData'=>$getCouponData]);
    }

    public function couponEditView(Request $request)
    {
        $mainCategoryData = CategoryMain::where(['cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
        $getCouponData = Coupons::where('coupon_id',$request->id)->first();
        return view('user_admin.couponEdit',['mainCategoryData'=>$mainCategoryData,'getCouponData'=>$getCouponData]);
    }

    public function couponUpdate(Request $request)
    {
        if($request->hasfile('coupon_image'))
        {
            $couponImageFile = $request->file('coupon_image');
            $couponImageFileName = $couponImageFile->getClientOriginalName();
            $newCouponImage = time().'.'.$couponImageFileName;
            $couponImageFile->move('custom-images/coupons',$newCouponImage);
            if(isset($request->old_coupon_image)){
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
            return redirect(USER_ADMIN_URL.'couponEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect(USER_ADMIN_URL.'couponEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }


}
