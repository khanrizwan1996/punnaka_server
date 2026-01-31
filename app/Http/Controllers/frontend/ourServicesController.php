<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurServices;
class ourServicesController extends Controller
{
    public function ourServicesView()
    {
        $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController)->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController)->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        return view('frontend.ourServices',['blogCategoryHeaderMenu'=>$blogCategoryHeaderMenu,'businessListingHeaderMenu'=>$businessListingHeaderMenu,
        'mallCityHeaderMenu' => $mallCityHeaderMenu,
        'couponHeaderMenu' => $couponHeaderMenu,
        'offerHeaderMenu' => $offerHeaderMenu
    ]);
    }

    public function ourServiceStore(Request $request)
    {
       $newSeServices = implode(",",$request->se_services);
        $ourServicesData = OurServices::create([
            'se_user_name' => $request->se_user_name,
            'se_user_email' => $request->se_user_email,
            'se_user_contact_no' => $request->se_user_contact_no,
            'se_message' => $request->se_message,
            'se_services' => $newSeServices,
            'se_status' => STATUS_INACTIVE,
            'se_added_time' => CURRENT_DATE_TIME,
        ]);

        if ($ourServicesData) {
            echo "<script LANGUAGE='JavaScript'>
            window.alert('Yore request send successfully. We will conntact you shortly!!');
            window.location.href = '/';
            </script>";
        } else {
            return redirect('/')->with('message', MSG_ADD_ERROR);
        }
    }

}
