<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductService;

class productAndServiceController extends Controller
{
    
    public function businessListingHeaderMenu()
    {
        $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();    
        return $businessListingHeaderMenu;
    }
    
    public function blogCategoryHeaderMenu()
    {
        $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();        
        return $blogCategoryHeaderMenu;
    }
    
    public function mallCityHeaderMenu()
    {
        $mallCityHeaderMenu = (new mallController)->MallCityHeaderMenu();
        return $mallCityHeaderMenu;
    }
   
    public function couponHeaderMenu()
    {
        $couponHeaderMenu = (new couponController)->couponHeaderMenu();
        return $couponHeaderMenu;
    }

    public function offerHeaderMenu()
    {
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();
        return $offerHeaderMenu;
    }

    public function productAndServiceView(){
        $productAndServiceData = ProductService::where('ps_status',STATUS_ACTIVE)->orderBy('ps_id', 'DESC')->get();
        return view('frontend.productAndService',['productAndServiceData'=>$productAndServiceData,'blogCategoryHeaderMenu'=>$this->blogCategoryHeaderMenu(),'businessListingHeaderMenu'=>$this->businessListingHeaderMenu(),
        'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),
        'couponHeaderMenu' => $this->couponHeaderMenu(),
        'offerHeaderMenu' => $this->offerHeaderMenu()
    ]);
    }

    public function productAndServiceDetailView(Request $request){       
        $newPSTitle = str_replace('-', ' ', $request->title);
        $productAndServiceData = ProductService::where('ps_title',$newPSTitle)->first();
        if(empty($productAndServiceData) && $productAndServiceData == '' ){
            return '<img src="'.NOT_FOUND_IMAGE_PATH.'" style=" height: 650px; display: block;margin: auto;">';
        }else{
            $recentProductAndServiceData = ProductService::where('ps_status',STATUS_ACTIVE)->orderBy('ps_id', 'DESC')->limit('10')->get();
             return view('frontend.productAndServiceDetail',['blogCategoryHeaderMenu'=>$this->blogCategoryHeaderMenu(),'businessListingHeaderMenu'=>$this->businessListingHeaderMenu(),
            'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),
            'couponHeaderMenu' => $this->couponHeaderMenu(),
            'offerHeaderMenu' => $this->offerHeaderMenu(),
            'productAndServiceData' => $productAndServiceData,
            'recentProductAndServiceData' => $recentProductAndServiceData
            ]);
        }
    }
}
