<?php

namespace App\Http\Controllers\user_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryMain;
use App\Models\ProductService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class userProductAndServiceController extends Controller
{
    public function productServiceListView(Request $request){
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../login';
            </script>";
        }
        $getProductServiceData = ProductService::where(['ps_user_id'=>Auth::user()->id])->orderBy('ps_id', 'DESC')->get();
        return view('user_admin.productServiceList',['getProductServiceData'=>$getProductServiceData]);
    }
    
    public function productServiceAddView(){
        $mainCategoryData = CategoryMain::where(['cat_main_type'=>TYPE_BUSINESS_LISTING,'cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
        return view('user_admin.productServiceAdd',['mainCategoryData'=>$mainCategoryData]);
    }
    
    public function productServiceStore(Request $request){
        //dd($request->all());

        //DB::enableQueryLog();
        $blogCategoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where(['cat_main_id'=>$request->ps_main_cat,'cat_sub_id'=>$request->ps_sub_cat])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);
       //dd(DB::getQueryLog());203
        $newPSImage = '';
        if($request->hasfile('ps_image')){
            $psImageFile = $request->file('ps_image');
            $psImageFileName = $psImageFile->getClientOriginalName();
            $newPSImage = time().'.'.$psImageFileName;
            $psImageFile->move('custom-images/product-service',$newPSImage);
        }
        $newPSBrochure = '';
        if($request->hasfile('ps_brochure')){
            $psBrochureFile = $request->file('ps_brochure');
            $psBrochureFileName = $psBrochureFile->getClientOriginalName();
            $newPSBrochure = time().'.'.$psBrochureFileName;
            $psBrochureFile->move('custom-images/product-service',$newPSBrochure);
        }
        
        if(isset($request->ps_additional_options) && $request->ps_additional_options == 'Products' && isset($request->ps_size) && isset($request->ps_color) 
            && isset($request->ps_return_policy)){
            $ps_size = $request->ps_size;
            $ps_color = $request->ps_color;
            $ps_return_policy = $request->ps_return_policy;
            $ps_cancellation_policy = '';
            $ps_add_ons = '';
        }else{
            $ps_size = '';
            $ps_color = '';
            $ps_return_policy = '';
            $ps_cancellation_policy = $request->ps_cancellation_policy;
            $ps_add_ons = $request->ps_add_ons;
        }

        $couponInsertData = ProductService::create([
            'ps_user_id' => Auth::user()->id,
            'ps_status' => STATUS_INACTIVE,
            'ps_main_cat' => $blogCategoryData['cat_main_name'],
            'ps_sub_cat' => $blogCategoryData['cat_sub_name'],

            'ps_title' => $request->ps_title,
            'ps_listing_type' => $request->ps_listing_type,
            'ps_pricing_type' => $request->ps_pricing_type,
            'ps_currency' => $request->ps_currency,
            'ps_price_range' => $request->ps_price_range,
            'ps_discount' => $request->ps_discount,

            'ps_tax' => $request->ps_tax,
            'ps_country' => $request->ps_country,
            'ps_state' => $request->ps_state,
            'ps_city' => $request->ps_city,
            'ps_service_area' => $request->ps_service_area,
            'ps_availability_date_time' => $request->ps_availability_date_time,

            'ps_additional_options' => $request->ps_additional_options,
            'ps_size' => $ps_size,
            'ps_color' => $ps_color,
            'ps_return_policy' => $ps_return_policy,
            'ps_cancellation_policy' => $ps_cancellation_policy,
            'ps_add_ons' => $ps_add_ons,

            'ps_stock' => $request->ps_stock,
            'ps_sku' => $request->ps_sku,
            'ps_shipping_option' => $request->ps_shipping_option,
            'ps_image' => $newPSImage,
            'ps_video_url' => $request->ps_video_url,
            'ps_brochure' => $newPSBrochure,

            'ps_contact_name' => $request->ps_contact_name,
            'ps_contact_number' => $request->ps_contact_number,
            'ps_contact_email' => $request->ps_contact_email,
            'ps_contact_whatsapp' => $request->ps_contact_whatsapp,
            'ps_website_url' => $request->ps_website_url,
            'ps_portfolio_url' => $request->ps_portfolio_url,
            'ps_facebook_url' => $request->ps_facebook_url,
            'ps_instagram_url' => $request->ps_instagram_url,

            'ps_twitter_url' => $request->ps_twitter_url,
            'ps_other_url' => $request->ps_other_url,
            'ps_visibility' => $request->ps_visibility,
            'ps_featured_listing' => $request->ps_featured_listing,
            'ps_expiry_date' => $request->ps_expiry_date,

            'ps_tags_keywords' => $request->ps_tags_keywords,
            'ps_short_description' => $request->ps_short_description,
            'ps_detail_description' => $request->ps_detail_description,
            'ps_added_time' => CURRENT_DATE_TIME
        ]);
        if($couponInsertData){
            $msg = 'Your products & services listing have been submitted successfully!\n\nWe’ve received your details and our review team will verify them soon. You’ll receive an update once it goes live on Punnaka.com.\n\nFor any assistance, WhatsApp us at +91-7875155538 or email us at info@punnaka.com';
            echo "<script>alert(\"$msg\")
            window.location.href='/user-admin/dashboard';
            </script>";

            //return redirect('/user-admin/productServiceList')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/user-admin/productServiceList')->with('message',MSG_ADD_ERROR);
        }
    }

    

    public function productServiceEdit(Request $request){
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../login';
            </script>";
        }
        $getProductServiceData = ProductService::where('ps_id',$request->id)->first();
        $mainCategoryData = CategoryMain::where(['cat_main_type'=>TYPE_BUSINESS_LISTING,'cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
        return view('user_admin.productServiceEdit',['getProductServiceData'=>$getProductServiceData,'mainCategoryData'=>$mainCategoryData]);
    }

    public function productServiceUpdate(Request $request){

        if($request->hasfile('ps_image')){
            $psImageFile = $request->file('ps_image');
            $psImageFileName = $psImageFile->getClientOriginalName();
            $newPSImage = time().'.'.$psImageFileName;
            $psImageFile->move('custom-images/product-service',$newPSImage);
            if(isset($request->old_ps_image)){
                unlink('custom-images/product-service/'.$request->old_ps_image);
            }
        }else{
            $newPSImage = $request->old_ps_image;
        }

        if($request->hasfile('ps_brochure')){
            $psBrochureFile = $request->file('ps_brochure');
            $psBrochureFileName = $psBrochureFile->getClientOriginalName();
            $newPSBrochure = time().'.'.$psBrochureFileName;
            $psBrochureFile->move('custom-images/product-service',$newPSBrochure);
            if(isset($request->old_ps_brochure)){
                unlink('custom-images/product-service/'.$request->old_ps_brochure);
            }
        }else{
            $newPSBrochure = $request->old_ps_brochure;
        }


        if(isset($request->ps_main_cat) && isset($request->ps_sub_cat)){
            $blogCategoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where([ 'cat_main_id'=>$request->ps_main_cat,'cat_sub_id'=>$request->ps_sub_cat])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);

            $catMainName = $blogCategoryData['cat_main_name'];
            $catSubName = $blogCategoryData['cat_sub_name'];

        }else{
            $catMainName = $request->old_ps_main_cat;
            $catSubName = $request->old_ps_sub_cat;
        }

        if(isset($request->ps_additional_options) && $request->ps_additional_options == 'Products' && isset($request->ps_size) && isset($request->ps_color) 
            && isset($request->ps_return_policy)){
            $ps_size = $request->ps_size;
            $ps_color = $request->ps_color;
            $ps_return_policy = $request->ps_return_policy;
            $ps_cancellation_policy = '';
            $ps_add_ons = '';
        }else{
            $ps_size = '';
            $ps_color = '';
            $ps_return_policy = '';
            $ps_cancellation_policy = $request->ps_cancellation_policy;
            $ps_add_ons = $request->ps_add_ons;
        }

        $couponUpdateData =ProductService::where("ps_id", $request->id)->update([
            'ps_main_cat' => $catMainName,
            'ps_sub_cat' => $catSubName,
            'ps_status' => $request->ps_status,
            'ps_title' => $request->ps_title,
            'ps_listing_type' => $request->ps_listing_type,
            'ps_pricing_type' => $request->ps_pricing_type,
            'ps_currency' => $request->ps_currency,
            'ps_price_range' => $request->ps_price_range,
            'ps_discount' => $request->ps_discount,

            'ps_tax' => $request->ps_tax,
            'ps_country' => $request->ps_country,
            'ps_state' => $request->ps_state,
            'ps_city' => $request->ps_city,
            'ps_service_area' => $request->ps_service_area,
            'ps_availability_date_time' => $request->ps_availability_date_time,

            'ps_additional_options' => $request->ps_additional_options,
            'ps_size' => $ps_size,
            'ps_color' => $ps_color,
            'ps_return_policy' => $ps_return_policy,
            'ps_cancellation_policy' => $ps_cancellation_policy,
            'ps_add_ons' => $ps_add_ons,

            'ps_stock' => $request->ps_stock,
            'ps_sku' => $request->ps_sku,
            'ps_shipping_option' => $request->ps_shipping_option,
            'ps_image' => $newPSImage,
            'ps_video_url' => $request->ps_video_url,
            'ps_brochure' => $newPSBrochure,

            'ps_contact_name' => $request->ps_contact_name,
            'ps_contact_number' => $request->ps_contact_number,
            'ps_contact_email' => $request->ps_contact_email,
            'ps_contact_whatsapp' => $request->ps_contact_whatsapp,
            'ps_website_url' => $request->ps_website_url,
            'ps_portfolio_url' => $request->ps_portfolio_url,
            'ps_facebook_url' => $request->ps_facebook_url,
            'ps_instagram_url' => $request->ps_instagram_url,

            'ps_twitter_url' => $request->ps_twitter_url,
            'ps_other_url' => $request->ps_other_url,
            'ps_visibility' => $request->ps_visibility,
            'ps_featured_listing' => $request->ps_featured_listing,
            'ps_expiry_date' => $request->ps_expiry_date,

            'ps_tags_keywords' => $request->ps_tags_keywords,
            'ps_short_description' => $request->ps_short_description,
            'ps_detail_description' => $request->ps_detail_description,
            'ps_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($couponUpdateData){
            return redirect('user-admin/productServiceEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('user-admin/productServiceEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }

    public function checkProductServiceCount(){
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../login';
            </script>";
        }
        $checkProductServiceCount = ProductService::where(['ps_user_id' => Auth::user()->id])->count();
        return $checkProductServiceCount;
    }
}
