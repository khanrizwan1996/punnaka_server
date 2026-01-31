<?php

namespace App\Http\Controllers\user_admin;
use Illuminate\Support\Facades\Auth;
use App\Models\BusinessListing;
use App\Models\Franchise;
use App\Models\ProductService;
use App\Models\Offers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class userDashboardController extends Controller
{
    public function dashboardView(){
        
        $totalBusinessListingCount = BusinessListing::where(['bus_user_id' => Auth::user()->id])->count();    
        $totalFranchiseCount = Franchise::where(['f_user_id'=> Auth::user()->id])->count();
        $totalProductAndServiceCount = ProductService::where(['ps_user_id'=> Auth::user()->id])->count();

        $table1 = DB::table('franchise')
        ->select('f_id as id', 'f_company_name as name', 'f_added_time as created_at', 'f_status as status', DB::raw("'franchise' as source"))
        ->where(['f_user_id'=> Auth::user()->id])
        ->latest('created_at')->take(5)->get();

        $table2 = DB::table('business_listing')
            ->select('bus_id as id', 'bus_name as name', 'bus_added_time as created_at', 'bus_status as status', DB::raw("'business_listing' as source"))
            ->where(['bus_user_id'=> Auth::user()->id])
            ->latest('created_at')->take(5)->get();

        $table3 = DB::table('product_service')
            ->select('ps_id as id', 'ps_title as name', 'ps_added_time as created_at', 'ps_status as status', DB::raw("'product_service' as source"))
            ->where(['ps_user_id'=> Auth::user()->id])
            ->latest('created_at')->take(5)->get();

        $table4 = DB::table('coupon_offer')
        ->select('cf_id as id', 'cf_title as name', 'cf_added_time as created_at', 'cf_status as status', DB::raw("'coupon_offer' as source"))
        ->where(['cf_user_id'=> Auth::user()->id])
        ->latest('created_at')->take(5)->get();
        
        $allRecords = $table1->merge($table2)->merge($table3)->merge($table4)
        ->sortByDesc('created_at')
        ->values();
        
        return view('user_admin.dashboard',['totalBusinessListingCount' => $totalBusinessListingCount, 'totalFranchiseCount' => $totalFranchiseCount, 'totalProductAndServiceCount' => $totalProductAndServiceCount, 'records' => $allRecords]);
    }
}
