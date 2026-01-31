<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\BusinessListing;
use App\Models\BusinessListingPayment;
use Illuminate\Http\Request;

class dashboardController extends Controller
{


    public function userPaymentHistory(){

        $userPaymentHistoryArray = BusinessListingPayment::where(['bus_pay_user_id' => Auth::user()->id])
        ->orderBy('bus_pay_id', 'DESC')
        ->get();
        return $userPaymentHistoryArray;
    }

    public function userActiveBusinessListingCount(){
        $userActiveBusinessListingCount = BusinessListing::where(['bus_status' => STATUS_ACTIVE,'bus_user_id' => Auth::user()->id ])->count();
        return $userActiveBusinessListingCount;
    }

    public function userInActiveBusinessListingCount(){
        $userInActiveBusinessListingCount = BusinessListing::where(['bus_status' => STATUS_INACTIVE,'bus_user_id' => Auth::user()->id ])->count();
        return $userInActiveBusinessListingCount;
    }


    public function userPaidBusinessListingCount(){
        $userPaidBusinessListingCount = BusinessListingPayment::where(['bus_pay_status' => STATUS_ACTIVE,'bus_pay_user_id' => Auth::user()->id ])->count();
        return $userPaidBusinessListingCount;
    }

    public function userUnPaidBusinessListingCount(){
        $userUnPaidBusinessListingCount = BusinessListingPayment::where(['bus_pay_status' => STATUS_INACTIVE,'bus_pay_user_id' => Auth::user()->id ])->count();
        return $userUnPaidBusinessListingCount;
    }

    public function dashboardView(){

        if(!isset(Auth::user()->id))
        {
            echo "<script>
            alert('Please login first');
            window.location.href='login';
            </script>";
        }
        $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController)->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController)->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        return view('frontend.dashboard',['blogCategoryHeaderMenu'=>$blogCategoryHeaderMenu,'businessListingHeaderMenu' => $businessListingHeaderMenu,
        'mallCityHeaderMenu'=>$mallCityHeaderMenu,
        'couponHeaderMenu'=>$couponHeaderMenu,
        'offerHeaderMenu'=>$offerHeaderMenu,
        'userPaymentHistoryArray' => $this->userPaymentHistory(),
        'userActiveBusinessListingCount' => $this->userActiveBusinessListingCount(),
        'userInActiveBusinessListingCount' => $this->userInActiveBusinessListingCount(),
        'userPaidBusinessListingCount' => $this->userPaidBusinessListingCount(),
        'userUnPaidBusinessListingCount' => $this->userUnPaidBusinessListingCount()]);
    }
}
