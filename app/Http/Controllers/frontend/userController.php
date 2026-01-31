<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\BusinessListing;
use App\Models\BusinessListingPayment;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class userController extends Controller
{
    public function paymentHistoryListView()
    {
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = 'login';
            </script>";
        }

        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        $userPaymentHistoryArray = BusinessListingPayment::where(['bus_pay_user_id' => Auth::user()->id])
            ->orderBy('bus_pay_id', 'DESC')
            ->get();

        return view('frontend.userPaymentHistoryList', ['userPaymentHistoryArray' => $userPaymentHistoryArray, 'blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu, 'mallCityHeaderMenu' => $mallCityHeaderMenu, 'couponHeaderMenu' => $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu
    ]);
    }

    public function profileView()
    {
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = 'login';
            </script>";
        }

        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        $userBusinessListingArray = BusinessListing::where(['bus_user_id' => Auth::user()->id])
            ->orderBy('bus_id', 'DESC')
            ->get();

        return view('frontend.userProfile', ['userBusinessListingArray' => $userBusinessListingArray, 'blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu, 'mallCityHeaderMenu' => $mallCityHeaderMenu, 'couponHeaderMenu' => $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu]);
    }

    public function profileUpdate(Request $request)
    {
        $userProfileDetail = User::where('id', Auth::user()->id)->update([
            'name' => $request->user_name,
            'contact_no' => $request->user_contact_no,
            'email' => $request->user_email,
            'country' => $request->user_country,
            'city' => $request->user_city,
            'pin_code' => $request->user_pin_code,
            'address' => $request->user_address,
            'updated_at' => CURRENT_DATE_TIME,
        ]);

        if($userProfileDetail){
            echo "<script>
                alert('Profile details updated successfully!!');
                window.location.href = 'profile/';
            </script>";
        }else{
            echo "<script>
                alert('Error in profile details update!!');
                window.location.href = 'profile/';
            </script>";
        }
    }

    public function userPasswordView()
    {
        if(!isset(Auth::user()->id)){
            echo "<script>
                alert('Please login first');
                window.location.href = 'login';
            </script>";
        }

        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();
        $userBusinessListingArray = BusinessListing::where(['bus_user_id' => Auth::user()->id])
            ->orderBy('bus_id', 'DESC')
            ->get();

        return view('frontend.userPassword', ['userBusinessListingArray' => $userBusinessListingArray, 'blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu, 'mallCityHeaderMenu' => $mallCityHeaderMenu, 'couponHeaderMenu' => $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu]);
    }

    public function userPasswordUpdate(Request $request)
    {
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = 'login';
            </script>";
        }
        $userPasswordUpdate = User::where('id', Auth::user()->id)->update([
            'password' => md5($request->user_password),
            'updated_at' => CURRENT_DATE_TIME,
        ]);
        if($userPasswordUpdate){
            echo "<script>
                alert('Password updated successfully!!');
                window.location.href = 'userPasswordChange/';
            </script>";
        }else{
            echo "<script>
                alert('Error in password details update!!');
                window.location.href = 'userPasswordChange/';
            </script>";
        }
    }
}
