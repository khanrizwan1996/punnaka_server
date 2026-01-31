<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
//use App\Http\Controllers\frontend\blogsCategoryController;

class contactUsController extends Controller
{
    public function contactUsView(){
        $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController)->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController)->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        return view('frontend.contactUs',['blogCategoryHeaderMenu'=>$blogCategoryHeaderMenu,'businessListingHeaderMenu' => $businessListingHeaderMenu,
        'mallCityHeaderMenu'=>$mallCityHeaderMenu,
        'couponHeaderMenu'=>$couponHeaderMenu,
        'offerHeaderMenu'=>$offerHeaderMenu
    ]);
    }
}
