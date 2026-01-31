<?php

namespace App\Http\Controllers\user_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryMain;
use App\Models\CouponOffer;
class userCouponAndOfferController extends Controller
{
    public function couponOfferListView(){
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = 'login';
            </script>";
        }
        $CouponOfferData = CouponOffer::where(['cf_user_id'=>Auth::user()->id])->orderBy('cf_id', 'DESC')->get();
        return view('user_admin.couponOfferList',['CouponOfferData' => $CouponOfferData]);
    }

    public function couponOfferAddView(){
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = 'login';
            </script>";
        }
        $mainCategoryData = CategoryMain::where(['cat_main_type'=>TYPE_BUSINESS_LISTING,'cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
        return view('user_admin.couponOfferAdd',['mainCategoryData' => $mainCategoryData]);
    }
    

    public function couponOfferStore(Request $request){
        //dd($request->all());

        //DB::enableQueryLog();
        $categoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where(['cat_main_id'=>$request->cf_main_cat,'cat_sub_id'=>$request->cf_sub_cat])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);
       // dd(DB::getQueryLog());


        if($request->hasfile('cf_store_logo')){
            $storeLogoImageFile = $request->file('cf_store_logo');
            $storeLogoImageFileName = $storeLogoImageFile->getClientOriginalName();
            $newStoreLogoImage = time().'.'.$storeLogoImageFileName;
            $storeLogoImageFile->move('custom-images/coupon-offer',$newStoreLogoImage);
        }
        if($request->hasfile('cf_banner_thumbnail')){
            $bannerThumbnailImageFile = $request->file('cf_banner_thumbnail');
            $bannerThumbnailImageFileName = $bannerThumbnailImageFile->getClientOriginalName();
            $newBannerThumbnailImage = time().'.'.$bannerThumbnailImageFileName;
            $bannerThumbnailImageFile->move('custom-images/coupon-offer',$newBannerThumbnailImage);
        }

        $cf_platform = '';
        if(isset($request->cf_platform) && !empty($request->cf_platform)){
            $cf_platform = implode(',', $request->cf_platform);
        }
        
        $cf_highlight_options = '';
        if(isset($request->cf_highlight_options) && !empty($request->cf_highlight_options)){
            $cf_highlight_options = implode(',', $request->cf_highlight_options);
        }

        $cf_free_recharge_eligible_operators = '';
        if(isset($request->cf_free_recharge_eligible_operators) && !empty($request->cf_free_recharge_eligible_operators)){
            $cf_free_recharge_eligible_operators = implode(',', $request->cf_free_recharge_eligible_operators);
        }

        $couponOfferInsertData = CouponOffer::create([
            'cf_user_id' => Auth::user()->id,
            'cf_status' => STATUS_INACTIVE,
            'cf_main_cat' => $categoryData['cat_main_name'],
            'cf_sub_cat' => $categoryData['cat_sub_name'],

            'cf_listing_type' => $request->cf_listing_type,
            'cf_title' => $request->cf_title,
            'cf_short_tagline' => $request->cf_short_tagline,
            'cf_store_name' => $request->cf_store_name,
            'cf_city' => $request->cf_city,
            'cf_start_date' => $request->cf_start_date,

            'cf_end_date' => $request->cf_end_date,
            'cf_store_website' => $request->cf_store_website,
            'cf_ongoing_offer' => $request->cf_ongoing_offer,
            'cf_sort_priority' => $request->cf_sort_priority,

            'cf_user_type' => $request->cf_user_type,
            'cf_platform' => $cf_platform,
            'cf_highlight_options' => $cf_highlight_options,
            'cf_term_condition' => $request->cf_term_condition,
            'cf_desc' => $request->cf_desc,
            'cf_admin_note' => $request->cf_admin_note,

            'cf_coupon_code_required' => $request->cf_coupon_code_required,
            'cf_coupon_promo_code' => $request->cf_coupon_promo_code,
            'cf_coupon_discount_type' => $request->cf_coupon_discount_type,
            'cf_coupon_discount_value' => $request->cf_coupon_discount_value,
            'cf_coupon_min_order_value' => $request->cf_coupon_min_order_value,
            'cf_coupon_max_discount_cap' => $request->cf_coupon_max_discount_cap,
            'cf_coupon_login_required_redeem' => $request->cf_coupon_login_required_redeem,
            'cf_coupon_redemption_limit' => $request->cf_coupon_redemption_limit,
            'cf_coupon_redirect_affiliate_url' => $request->cf_coupon_redirect_affiliate_url,

            'cf_offer_code_required' => $request->cf_offer_code_required,
            'cf_offer_type' => $request->cf_offer_type,
            'cf_offer_discount_value' => $request->cf_offer_discount_value,
            'cf_offer_cta_buy_now_url' => $request->cf_offer_cta_buy_now_url,
            'cf_offer_valid_till' => $request->cf_offer_valid_till,
            'cf_offer_desc' => $request->cf_offer_desc,

            'cf_free_sample_freebie_type' => $request->cf_free_sample_freebie_type,
            'cf_free_sample_quantity' => $request->cf_free_sample_quantity,
            'cf_free_sample_eligible_users' => $request->cf_free_sample_eligible_users,
            'cf_free_sample_redemption_link' => $request->cf_free_sample_redemption_link,
            'cf_free_sample_desc' => $request->cf_free_sample_desc,

            'cf_free_recharge_type' => $request->cf_free_recharge_type,
            'cf_free_recharge_eligible_operators' => $cf_free_recharge_eligible_operators,
            'cf_free_recharge_code' => $request->cf_free_recharge_code,
            'cf_free_recharge_claim_url' => $request->cf_free_recharge_claim_url,
            'cf_free_recharge_instructions' => $request->cf_free_recharge_instructions,

            'cf_store_logo' => $newStoreLogoImage,
            'cf_banner_thumbnail' => $newBannerThumbnailImage,
            'cf_added_time' => CURRENT_DATE_TIME
        ]);
        if($couponOfferInsertData){
            $msg = 'Your coupons & offers listing have been submitted successfully!\n\nWe’ve received your details and our review team will verify them soon. You’ll receive an update once it goes live on Punnaka.com.\n\nFor any assistance, WhatsApp us at +91-7875155538 or email us at info@punnaka.com';
            echo "<script>alert(\"$msg\")
            window.location.href='/user-admin/dashboard';
            </script>";
            //return redirect('/user-admin/couponOfferList')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/user-admin/couponOfferList')->with('message',MSG_ADD_ERROR);
        }
    }

    public function couponOfferEditView(Request $request){
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../login';
            </script>";
        }
        $couponOfferData = CouponOffer::where('cf_id',$request->id)->first();
        $mainCategoryData = CategoryMain::where(['cat_main_type'=>TYPE_BUSINESS_LISTING,'cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
        return view('user_admin.couponOfferEdit',['couponOfferData'=>$couponOfferData,'mainCategoryData'=>$mainCategoryData]);
    }

    public function couponOfferUpdate(Request $request){

         if($request->hasfile('cf_store_logo')){
            $storeLogoImageFile = $request->file('cf_store_logo');
            $storeLogoImageFileName = $storeLogoImageFile->getClientOriginalName();
            $newStoreLogoImage = time().'.'.$storeLogoImageFileName;
            $storeLogoImageFile->move('custom-images/coupon-offer',$newStoreLogoImage);
            if(isset($request->old_cf_store_logo)){
                unlink('custom-images/coupon-offer/'.$request->old_cf_store_logo);
            }
        }else{
            $newStoreLogoImage = $request->old_cf_store_logo;
        }

        if($request->hasfile('cf_banner_thumbnail')){
            $bannerThumbnailImageFile = $request->file('cf_banner_thumbnail');
            $bannerThumbnailImageFileName = $bannerThumbnailImageFile->getClientOriginalName();
            $newBannerThumbnailImage = time().'.'.$bannerThumbnailImageFileName;
            $bannerThumbnailImageFile->move('custom-images/coupon-offer',$newBannerThumbnailImage);
            if(isset($request->old_cf_banner_thumbnail)){
                unlink('custom-images/coupon-offer/'.$request->old_cf_banner_thumbnail);
            }
        }else{
            $newBannerThumbnailImage = $request->old_cf_banner_thumbnail;
        }



        if(isset($request->cf_main_cat) && isset($request->cf_sub_cat)){

            $categoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where(['cat_main_id'=>$request->cf_main_cat,'cat_sub_id'=>$request->cf_sub_cat])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);

            $catMainName = $categoryData['cat_main_name'];
            $catSubName = $categoryData['cat_sub_name'];

        }else{
            $catMainName = $request->old_cf_main_cat;
            $catSubName = $request->old_cf_sub_cat;
        }

        
        if(isset($request->cf_platform) && !empty($request->cf_platform)){
            $cf_platform = implode(',', $request->cf_platform);
        }else{
            $cf_platform = $request->old_cf_platform;
        }
        
        
        if(isset($request->cf_highlight_options) && !empty($request->cf_highlight_options)){
            $cf_highlight_options = implode(',', $request->cf_highlight_options);
        }else{
            $cf_highlight_options = $request->old_cf_highlight_options;
        }

        
        if(isset($request->cf_free_recharge_eligible_operators) && !empty($request->cf_free_recharge_eligible_operators)){
            $cf_free_recharge_eligible_operators = implode(',', $request->cf_free_recharge_eligible_operators);
        }else{
            $cf_free_recharge_eligible_operators = $request->old_cf_free_recharge_eligible_operators;
        }

        $CouponOfferUpdateData =CouponOffer::where("cf_id", $request->id)->update([
            'cf_main_cat' => $catMainName,
            'cf_sub_cat' => $catSubName,
            'cf_status' => $request->cf_status,
            'cf_listing_type' => $request->cf_listing_type,
            'cf_title' => $request->cf_title,
            'cf_short_tagline' => $request->cf_short_tagline,
            'cf_store_name' => $request->cf_store_name,
            'cf_city' => $request->cf_city,
            'cf_start_date' => $request->cf_start_date,
            'cf_end_date' => $request->cf_end_date,
            'cf_store_website' => $request->cf_store_website,
            'cf_ongoing_offer' => $request->cf_ongoing_offer,
            'cf_sort_priority' => $request->cf_sort_priority,
            'cf_store_logo' => $newStoreLogoImage,
            'cf_banner_thumbnail' => $newBannerThumbnailImage,
            'cf_user_type' => $request->cf_user_type,
            'cf_platform' => $cf_platform,
            'cf_highlight_options' => $cf_highlight_options,
            'cf_term_condition' => $request->cf_term_condition,
            'cf_desc' => $request->cf_desc,
            'cf_admin_note' => $request->cf_admin_note,
            'cf_coupon_code_required' => $request->cf_coupon_code_required,
            'cf_coupon_promo_code' => $request->cf_coupon_promo_code,
            'cf_coupon_discount_type' => $request->cf_coupon_discount_type,
            'cf_coupon_discount_value' => $request->cf_coupon_discount_value,
            'cf_coupon_min_order_value' => $request->cf_coupon_min_order_value,
            'cf_coupon_max_discount_cap' => $request->cf_coupon_max_discount_cap,
            'cf_coupon_login_required_redeem' => $request->cf_coupon_login_required_redeem,
            'cf_coupon_redemption_limit' => $request->cf_coupon_redemption_limit,
            'cf_coupon_redirect_affiliate_url' => $request->cf_coupon_redirect_affiliate_url,
            'cf_offer_code_required' => $request->cf_offer_code_required,
            'cf_offer_type' => $request->cf_offer_type,
            'cf_offer_discount_value' => $request->cf_offer_discount_value,
            'cf_offer_cta_buy_now_url' => $request->cf_offer_cta_buy_now_url,
            'cf_offer_valid_till' => $request->cf_offer_valid_till,
            'cf_offer_desc' => $request->cf_offer_desc,
            'cf_free_sample_freebie_type' => $request->cf_free_sample_freebie_type,
            'cf_free_sample_quantity' => $request->cf_free_sample_quantity,
            'cf_free_sample_eligible_users' => $request->cf_free_sample_eligible_users,
            'cf_free_sample_quantity' => $request->cf_free_sample_quantity,
            'cf_free_sample_desc' => $request->cf_free_sample_desc,
            'cf_free_recharge_type' => $request->cf_free_recharge_type,
            'cf_free_recharge_eligible_operators' => $cf_free_recharge_eligible_operators,
            'cf_free_recharge_code' => $request->cf_free_recharge_code,
            'cf_free_recharge_claim_url' => $request->cf_free_recharge_claim_url,
            'cf_free_recharge_instructions' => $request->cf_free_recharge_instructions,           
            'cf_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($CouponOfferUpdateData){
            return redirect('user-admin/couponOfferEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('user-admin/couponOfferEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }

    public function checkCouponAndOfferCount(){
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../login';
            </script>";
        }
        $checkCouponAndOfferCount = CouponOffer::where(['cf_user_id' => Auth::user()->id])->count();
        return $checkCouponAndOfferCount;
    }
}
