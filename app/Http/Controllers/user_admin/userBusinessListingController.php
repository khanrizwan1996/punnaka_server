<?php

namespace App\Http\Controllers\user_admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CategoryMain;
use App\Models\CategorySub;
use App\Models\BusinessListing;
use App\Models\BusinessListingImages;
use App\Models\BusinessListingSchedule;
use App\Models\BusinessListingPayment;
use Illuminate\Http\Request;

class userBusinessListingController extends Controller
{
    public function paymentHistoryListView()
    {
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = 'login';
            </script>";
        }
        $userPaymentHistoryArray = BusinessListingPayment::where(['bus_pay_user_id' => Auth::user()->id])
            ->orderBy('bus_pay_id', 'DESC')
            ->get();

        return view('user_admin.paymentHistoryList', ['userPaymentHistoryArray' => $userPaymentHistoryArray]);
    }

    public function checkPlanPurchaseStatus(Request $request){
        $getUserPalnPaymentCount = BusinessListingPayment::where(['bus_pay_plan_type' => $request->planType,'bus_pay_user_id' => Auth::user()->id])
        ->orderBy('bus_pay_id', 'DESC')
        ->count();

        if($getUserPalnPaymentCount == 0) {
            echo "<script>
                alert('Please Purchase Plan ".$request->planType."');
                window.location.href = '../../business-listing';
            </script>";
        }else{
            session(['planType' => $request->planType]);
            echo "<script>
            window.location.href = '../../add-business-details';
        </script>";
        }
    }


    public function businessListingView(Request $request){
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../login';
            </script>";
        }

        $userBusinessListingArray = BusinessListing::where(['bus_user_id' => Auth::user()->id])
            ->orderBy('bus_id', 'DESC')
            ->get();

        return view('user_admin.businessListing', ['userBusinessListingArray' => $userBusinessListingArray]);
    }

    public function checkBusinessListingCount(){
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../login';
            </script>";
        }
        $checkBusinessListingCount = BusinessListing::where(['bus_user_id' => Auth::user()->id])->count();
        return $checkBusinessListingCount;
    }

    public function checkFranchisePaymentCount(){
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../login';
            </script>";
        }
        $checkFranchisePaymentCount = BusinessListingPayment::where(['bus_pay_user_id' => Auth::user()->id,'bus_pay_status'=> STATUS_ACTIVE,'bus_pay_plan_type' => 'FL'])->count();
        return $checkFranchisePaymentCount;
    }

     public function checkBusinesListingPaymentCount(){
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../login';
            </script>";
        }
        $checkBusinesListingPaymentCount = BusinessListingPayment::where(['bus_pay_user_id' => Auth::user()->id,'bus_pay_status'=> STATUS_ACTIVE,'bus_pay_plan_type' => 'BL'])->count();
        return $checkBusinesListingPaymentCount;
    }

     public function checkProductAndServicePaymentCount(){
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../login';
            </script>";
        }
        $checkProductAndServicePaymentCount = BusinessListingPayment::where(['bus_pay_user_id' => Auth::user()->id,'bus_pay_status'=> STATUS_ACTIVE,'bus_pay_plan_type' => 'PSL'])->count();
        return $checkProductAndServicePaymentCount;
    }

     public function checkCouponAndOfferPaymentCount(){
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../login';
            </script>";
        }
        $checkCouponAndOfferPaymentCount = BusinessListingPayment::where(['bus_pay_user_id' => Auth::user()->id,'bus_pay_status'=> STATUS_ACTIVE,'bus_pay_plan_type' => 'OCFL'])->count();
        return $checkCouponAndOfferPaymentCount;
    }
}
