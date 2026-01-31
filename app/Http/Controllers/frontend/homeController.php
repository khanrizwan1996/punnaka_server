<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\frontend\blogsCategoryController;
use App\Http\Controllers\admin\adminBannerController;
use Illuminate\Http\Request;
use App\Models\NewsLetter;

class homeController extends Controller
{
    public function indexView(){

        //$HomebannerData = (new adminBannerController)->HomebannerData();
        //$couponHeaderMenu = (new couponController)->couponHeaderMenu();
        //$offerHeaderMenu = (new offersController)->offerHeaderMenu();
        
        $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
        $getBlogCategoryIndexArray = (new blogsCategoryController)->getBlogCategoryIndexData();
        $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();
        $getbusinessListingIndexArray = (new businessListingController)->getbusinessListingIndexData();
        $getTopbusinessListingIndexData = (new businessListingController)->getTopbusinessListingIndexData();
        $mallCityHeaderMenu = (new mallController)->MallCityHeaderMenu();
        
        
        $mallInIndiaListArray = (new mallController)->mallInIndiaList();
        $mallInUSAListArray = (new blogsCategoryController)->mallInUSAList();
        $franchiseListingHeaderMenu = (new franchiseController)->franchiseListingHeaderMenu();
        
        //'HomebannerData'=>$HomebannerData,
        //'couponHeaderMenu' => $couponHeaderMenu,
        //'offerHeaderMenu' => $offerHeaderMenu,

        return view('frontend.index',['blogCategoryHeaderMenu'=>$blogCategoryHeaderMenu,
            'businessListingHeaderMenu' => $businessListingHeaderMenu,
            'getbusinessListingIndexArray' => $getbusinessListingIndexArray,
            'getBlogCategoryIndexArray' => $getBlogCategoryIndexArray,
            'mallCityHeaderMenu' => $mallCityHeaderMenu,
            'mallInIndiaListArray' => $mallInIndiaListArray,
            'mallInUSAListArray' => $mallInUSAListArray,
            'franchiseListingHeaderMenu' => $franchiseListingHeaderMenu,
            'getTopbusinessListingIndexData' => $getTopbusinessListingIndexData
        ]);
    }

    public function newsLetterStore(Request $request)
    {
        $newsLetterData = NewsLetter::create([
            'nl_email' => $request->userEmail,
            'nl_added_time' => CURRENT_DATE_TIME,
        ]);

        if ($newsLetterData) {
            echo "<script LANGUAGE='JavaScript'>
            window.alert('Thanks for subscribing! You’ll now receive the latest updates and news from Punnaka.com.');
            window.location.href = '/';
            </script>";
        } else {
            return redirect('/')->with('message', MSG_ADD_ERROR);
        }
    }

    public function newsLetterListView() {
        $newsLetterData = NewsLetter::orderBy('nl_id', 'DESC')->get();
        return view('admin.newsLetterList',['newsLetterData'=>$newsLetterData]);
    }
    public function newsLetterDelete(Request $request) {

        $newsLetterDeleteArray = NewsLetter::where(['nl_id'=>$request->id]);
        $newsLetterDeleteArray->delete();
        return redirect('/admin/newsLetterList')->with('msg', 'Record deleted successfully');
      }
}
