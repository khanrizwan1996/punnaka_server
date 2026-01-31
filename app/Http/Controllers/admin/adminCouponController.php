<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryMain;
use App\Models\Coupons;
use Illuminate\Support\Carbon;
use DB;
class adminCouponController extends Controller
{

    public function couponListView(Request $request){
        $couponListArray = Coupons::where(['coupon_status'=>$request->status])->orderBy('coupon_id', 'DESC')->get();
        return view('admin.couponList',['couponListArray'=>$couponListArray]);
    }

    public function couponAddView()
    {
         // DB::enableQueryLog();
         $blogCategoryMainData = CategoryMain::where(['cat_main_type'=>TYPE_BLOG,'cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
         //dd(DB::getQueryLog());
        return view('admin.couponAdd',['blogCategoryMainData'=>$blogCategoryMainData]);
    }

    public function couponStore(Request $request)
    {
        //dd($request->all());

        //DB::enableQueryLog();
        $blogCategoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where(['cat_main_type'=>TYPE_BLOG, 'cat_main_id'=>$request->coupon_main_category,'cat_sub_id'=>$request->coupon_sub_category])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);
       //dd(DB::getQueryLog());

       
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
        
        if($request->hasfile('coupon_t_c'))
        {
            
            $couponTCFile = $request->file('coupon_t_c');
            $couponTCFileName = $couponTCFile->getClientOriginalName();
            $newCouponTCFile = time().'.'.$couponTCFileName;
            $couponTCFile->move('custom-images/coupons',$newCouponTCFile);
        }

        $couponInsertData = Coupons::create([
            'coupon_main_category' => $blogCategoryData['cat_main_name'],
            'coupon_sub_category' => $blogCategoryData['cat_sub_name'],
            'coupon_brand_name' => $request->coupon_brand_name,
            'coupon_company_name' => $request->coupon_company_name,
            'coupon_title' => $request->coupon_title,
            'coupon_code' => $request->coupon_code,
            'coupon_contact' => $request->coupon_contact,
            'coupon_country' => $request->coupon_country,

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
            'coupon_t_c' => $newCouponTCFile,
            
            'coupon_meta_title' => $request->coupon_meta_title,
            'coupon_meta_keyword' => $request->coupon_meta_keyword,
            'coupon_meta_description' => $request->coupon_meta_description,
            
            'coupon_status' => STATUS_INACTIVE,
            'coupon_added_time' => CURRENT_DATE_TIME
        ]);
        if($couponInsertData)
        {
            return redirect('/admin/couponAdd')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/admin/couponAdd')->with('message',MSG_ADD_ERROR);
        }
    }

    public function couponEditView(Request $request)
    {
        $blogCategoryMainData = CategoryMain::where(['cat_main_type'=>TYPE_BLOG,'cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();

        $couponSingleData = Coupons::where('coupon_id',$request->id)->first();
        return view('admin.couponEdit',['blogCategoryMainData'=>$blogCategoryMainData,'couponSingleData'=>$couponSingleData]);
    }

    public function couponUpdate(Request $request)
    {
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
        
        if($request->hasfile('coupon_t_c'))
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
        }

        if(isset($request->coupon_main_category) && isset($request->coupon_sub_category))
        {
            $blogCategoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where(['cat_main_type'=>TYPE_BLOG, 'cat_main_id'=>$request->coupon_main_category,'cat_sub_id'=>$request->coupon_sub_category])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);

            $catMainName = $blogCategoryData['cat_main_name'];
            $catSubName = $blogCategoryData['cat_sub_name'];

        }else{
            $catMainName = $request->old_coupon_main_category;
            $catSubName = $request->old_coupon_sub_category;
        }
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
                'coupon_t_c' => $newCouponTCFile,

                'coupon_meta_title' => $request->coupon_meta_title,
                'coupon_meta_keyword' => $request->coupon_meta_keyword,
                'coupon_meta_description' => $request->coupon_meta_description,
                
                'coupon_status' => $request->coupon_status,
                'coupon_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($couponUpdateData)
        {
            return redirect('admin/couponEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/couponEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }

}
