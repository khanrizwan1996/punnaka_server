<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PressRelease;

class pressReleaseController extends Controller{
    
    public function getpressReleaseListingHeaderMenu(){
        // $pressReleaseListingHeaderMenu = PressRelease::select('pr_id','pr_main_cat')
        // ->where('pr_status',STATUS_ACTIVE)
        // ->groupBy('pr_main_cat')
        // ->orderBy('pr_main_cat', 'ASC')
        // ->toBase()
        // ->get();

        $pressReleaseListingHeaderMenu = PressRelease::where('pr_status', STATUS_ACTIVE)
        ->distinct()
        ->orderBy('pr_main_cat', 'ASC')
        ->pluck('pr_main_cat');
        
        //dd($pressReleaseListingHeaderMenu);
        return $pressReleaseListingHeaderMenu;
    }

    public function pressReleaseCategoryListingView(Request $request){
       $prCatMain = str_replace('-', ' ', $request->category);
    
        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        $getPressReleaseCategoryData = PressRelease::where(['pr_status' => STATUS_ACTIVE, 'pr_main_cat' => $prCatMain])
        ->orderBy('pr_id', 'DESC')
        ->toBase()
        ->get();

        $getLatestPressReleaseListing = PressRelease::where(['pr_status' => STATUS_ACTIVE])
        ->orderBy('pr_id', 'DESC')
        ->toBase()
        ->limit(10)
        ->get();

        return view('frontend.pressReleaseCategoryListing', ['blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu,'mallCityHeaderMenu' => $mallCityHeaderMenu,'couponHeaderMenu'=> $couponHeaderMenu,  'offerHeaderMenu'=> $offerHeaderMenu,'getPressReleaseCategoryData' => $getPressReleaseCategoryData,'getLatestPressReleaseListing' => $getLatestPressReleaseListing]);
    }
   
   
    public function pressReleaseFlowView(Request $request){

        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        
        return view('frontend.pressRelease', ['blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu,'mallCityHeaderMenu' => $mallCityHeaderMenu,'couponHeaderMenu'=> $couponHeaderMenu,  'offerHeaderMenu'=> $offerHeaderMenu]);
    
    }

    public function pressReleaseDetailView(Request $request){
       $prTitle = str_replace('-', ' ', $request->title);
    
        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        $getPressReleaseData = PressRelease::where([
            'pr_status' => STATUS_ACTIVE,
            'pr_title'  => $prTitle
        ])
        ->with('PressReleaseImages')
        ->get();
        
        $getLatestPressReleaseListing = PressRelease::where(['pr_status' => STATUS_ACTIVE])
        ->orderBy('pr_id', 'DESC')
        ->toBase()
        ->limit(10)
        ->get();

        return view('frontend.pressReleaseDetail', ['blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu,'mallCityHeaderMenu' => $mallCityHeaderMenu,'couponHeaderMenu'=> $couponHeaderMenu,  'offerHeaderMenu'=> $offerHeaderMenu, 'getPressReleaseData' => $getPressReleaseData,'getLatestPressReleaseListing' => $getLatestPressReleaseListing]);
    }
}
