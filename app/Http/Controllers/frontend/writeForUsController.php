<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WriteForUs;
class writeForUsController extends Controller
{
    public function writeForUsView()
    {
        $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController)->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController)->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        return view('frontend.writeForUs',['blogCategoryHeaderMenu'=>$blogCategoryHeaderMenu,'businessListingHeaderMenu' => $businessListingHeaderMenu,
        'mallCityHeaderMenu' => $mallCityHeaderMenu,
        'couponHeaderMenu'=> $couponHeaderMenu,
        'offerHeaderMenu'=> $offerHeaderMenu
    ]);
        
    }

    public function writeForUsStore(Request $request)
    {
        $wirteForUsData = WriteForUs::create([
            'wfu_user_name' => $request->wfu_user_name,
            'wfu_user_email' => $request->wfu_user_email,
            'wfu_user_contact_no' => $request->wfu_user_contact_no,
            'wfu_message' => $request->wfu_message,
            'wfu_status' => STATUS_INACTIVE,
            'wfu_added_time' => CURRENT_DATE_TIME,
        ]);

        if ($wirteForUsData) {
            echo "<script LANGUAGE='JavaScript'>
            window.alert('Your request has been sent successfullly. We will contact you shortly!!');
            window.location.href = '/';
            </script>";
        } else {
            return redirect('/')->with('message', MSG_ADD_ERROR);
        }
    }
}
