<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\frontend\blogsCategoryController;
//use App\Http\Controllers\frontend\businessListingController;
use App\Models\AboutUs;
class aboutUsController extends Controller
{
    public function aboutUsView(){
        $aboutUsData = AboutUs::where('about_us_id',1)->first();
        
        $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController)->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController)->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        return view('frontend.aboutUs',['aboutUsData'=>$aboutUsData,'blogCategoryHeaderMenu'=>$blogCategoryHeaderMenu,'businessListingHeaderMenu'=>$businessListingHeaderMenu,
        'couponHeaderMenu'=>$couponHeaderMenu,
        'offerHeaderMenu'=>$offerHeaderMenu,
        'mallCityHeaderMenu'=>$mallCityHeaderMenu
    ]);
    }
}
