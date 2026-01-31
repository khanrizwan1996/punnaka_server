<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\websiteContent;
use Illuminate\Http\Request;

class websiteContentController extends Controller
{
    public function websiteContentDetails() {
        $websiteContentData = websiteContent::select('wc_id','wc_header_logo','wc_footer_logo','wc_footer_content','wc_contact_no','wc_email_address','wc_address','wc_fb_link','wc_insta_link','wc_pinterest_link','wc_quora_link','wc_whatsapp_link','wc_term_condition','wc_privacy_policy')->first();
        return $websiteContentData;
    }

    public function privacyPoliciyView() {

        $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController)->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController)->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        $websiteContentData = websiteContent::select('wc_privacy_policy')->first();
        return view('frontend.privacyPolice',['wcPrivacyPolicy'=>$websiteContentData['wc_privacy_policy'],'mallCityHeaderMenu'=>$mallCityHeaderMenu,'blogCategoryHeaderMenu'=>$blogCategoryHeaderMenu,'businessListingHeaderMenu'=>$businessListingHeaderMenu,
        'couponHeaderMenu' => $couponHeaderMenu , 'offerHeaderMenu'=>$offerHeaderMenu]);
    }

    public function termsConditionsView() {

        $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController)->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController)->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();
        
        $websiteContentData = websiteContent::select('wc_term_condition')->first();
        return view('frontend.termsConditions',['wctermsConditions'=>$websiteContentData['wc_term_condition'],'mallCityHeaderMenu'=>$mallCityHeaderMenu,'blogCategoryHeaderMenu'=>$blogCategoryHeaderMenu,'businessListingHeaderMenu'=>$businessListingHeaderMenu, 'couponHeaderMenu'=> $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu ]);
    }
}