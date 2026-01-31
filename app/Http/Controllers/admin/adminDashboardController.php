<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Brands;
use App\Models\BusinessListing;
use App\Models\BusinessListingPayment;
use App\Models\Mall;
use App\Models\OurServices;
use App\Models\User;
use App\Models\WriteForUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class adminDashboardController extends Controller
{
    public function adminDashboardView(){

        $totalUsersCounts = User::OrderBy('id','DESC')->count();   
        $totalMallCounts = Mall::OrderBy('mall_id','DESC')->count();
        $totalActiveBrandsCounts = Brands::where(['brand_status' => STATUS_ACTIVE])->OrderBy('brand_id','DESC')->count();
        $totalInActiveBrandsCounts = Brands::where(['brand_status' => STATUS_INACTIVE])->OrderBy('brand_id','DESC')->count();
        $totalShoppingBlogs = Blog::OrderBy('blog_id','DESC')->count();
        $totalBlogs = BlogCategory::OrderBy('blog_cat_id','DESC')->count();
        $totalServiceEnquiryCounts = OurServices::OrderBy('se_id','DESC')->count();
        $totalWriteForUsEnquiryCounts = WriteForUs::OrderBy('wfu_id','DESC')->count();
        $totalActiveBusinessListingCounts = BusinessListing::where(['bus_status' => STATUS_ACTIVE])->OrderBy('bus_id','DESC')->count();
        $totalInActiveBusinessListingCounts = BusinessListing::where(['bus_status' => STATUS_INACTIVE])->OrderBy('bus_id','DESC')->count();
        $totalPaidBusinessListingCounts = BusinessListingPayment::where(['bus_pay_status' => STATUS_ACTIVE])->OrderBy('bus_pay_id','DESC')->count();
        $totalUnPaidBusinessListingCounts = BusinessListingPayment::where(['bus_pay_status' => STATUS_INACTIVE])->OrderBy('bus_pay_id','DESC')->count();

         $table1 = DB::table('franchise')
        ->select('f_id as id', 'f_company_name as name', 'f_added_time as created_at', 'f_status as status', DB::raw("'franchise' as source"))
        ->where(['f_status'=> STATUS_INACTIVE])
        ->latest('created_at')->take(5)->get();

        $table2 = DB::table('business_listing')
            ->select('bus_id as id', 'bus_name as name', 'bus_added_time as created_at', 'bus_status as status', DB::raw("'business_listing' as source"))
            ->where(['bus_status'=> STATUS_INACTIVE])
            ->latest('created_at')->take(5)->get();

        $table3 = DB::table('product_service')
            ->select('ps_id as id', 'ps_title as name', 'ps_added_time as created_at', 'ps_status as status', DB::raw("'product_service' as source"))
            ->where(['ps_status'=> STATUS_INACTIVE])
            ->latest('created_at')->take(5)->get();

        $table4 = DB::table('coupon_offer')
        ->select('cf_id as id', 'cf_title as name', 'cf_added_time as created_at', 'cf_status as status', DB::raw("'coupon_offer' as source"))
        ->where(['cf_status'=> STATUS_INACTIVE])
        ->latest('created_at')->take(5)->get();
        
        $allRecords = $table1->merge($table2)->merge($table3)->merge($table4)
        ->sortByDesc('created_at')
        ->values();

        return view('admin.dashboard',['totalUsersCounts'=>$totalUsersCounts, 'totalMallCounts'=>$totalMallCounts, 'totalActiveBrandsCounts'=>$totalActiveBrandsCounts, 'totalInActiveBrandsCounts'=>$totalInActiveBrandsCounts, 'totalShoppingBlogs'=>$totalShoppingBlogs, 'totalBlogs'=>$totalBlogs, 'totalServiceEnquiryCounts'=>$totalServiceEnquiryCounts, 'totalWriteForUsEnquiryCounts'=>$totalWriteForUsEnquiryCounts, 'totalActiveBusinessListingCounts'=>$totalActiveBusinessListingCounts, 'totalInActiveBusinessListingCounts'=>$totalInActiveBusinessListingCounts, 'totalPaidBusinessListingCounts'=>$totalPaidBusinessListingCounts, 'totalUnPaidBusinessListingCounts'=>$totalUnPaidBusinessListingCounts,
        'records' => $allRecords
         ]);
    }

    public function imageFolderView(){
        $path = public_path('custom-images/images-folder');
        $years = [];

        if (File::exists($path)) {
            $dirs = File::directories($path);

            foreach ($dirs as $dir) {
                $yearName = basename($dir);

                // Count all images recursively inside this year
                $files = File::allFiles($dir);
                $years[] = [
                    'year' => $yearName,
                    'count' => count($files)
                ];
            }
        }
        return view('admin.imageFolder', compact('years'));
    }

    public function imageFolderByYearView($year){
        $path = public_path("custom-images/images-folder/$year");
        if (!File::exists($path)) {
        abort(404);
    }

    // Get all images recursively under the year
    $files = File::allFiles($path);

    $images = collect($files)->map(function ($file) use ($year) {
        // Get relative path from public folder
        $relativePath = str_replace(public_path().'\\', '', $file); // works on Windows
        $relativePath = str_replace('\\', '/', $relativePath); // replace backslashes

        return asset($relativePath); // Full HTTP URL
    });
        return view('admin.imageFolderByYear',  compact('images', 'year'));
    }

    public function storeImages(Request $request){

        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $year  = date('Y');
        $basePath = public_path("custom-images/images-folder/$year");

        if (!File::exists($basePath)) {
            File::makeDirectory($basePath, 0755, true);
        }

        foreach ($request->file('images') as $image) {
            $name = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
            $image->move($basePath, $name);
        }

        return redirect()->back()->with('success', 'Images uploaded successfully');
    }
}
