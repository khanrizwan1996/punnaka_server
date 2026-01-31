<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\BusinessListing;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\orWhere;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function searchView(Request $request){
       
        $search = $request->search;

        $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController)->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController)->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

       //DB::enableQueryLog();
       $searchMallArray = array();
       $searchBrandsArray = array();
       $searchShoppingBlogArray = array();
       $searchBlogsArray = array();
       $searchBusinessLisitngArray = array();
       if($request->search_type == 'Business Listing' && !empty($request->search)){
        $searchBusinessLisitngArray = DB::table('business_listing')
            ->select('bus_id', 'bus_name', 'bus_country', 'bus_city', 'bus_sub_cat', 'bus_sub_cat', 'bus_address1' ,'bus_contact_no' ,'bus_email' ,'bus_state')
            ->where('bus_id','>', 0)
            ->where(['bus_status' => STATUS_ACTIVE])

            ->where(function($searchBusinessLisitngWhere) use ($request) {
                $searchBusinessLisitngWhere->where('bus_name', 'like', '%'.$request->search.'%')
                ->orWhere('bus_country', 'like', '%'.$request->search.'%')
                //->orWhere('bus_state', 'like', '%'.$request->search.'%')
                ->orWhere('bus_city', 'like', '%'.$request->search.'%');
            })

            // ->Where('bus_name', 'like', '%'.$request->search.'%')
            // ->orWhere('bus_country', 'like', '%'.$request->search.'%')
            // ->orWhere('bus_city', 'like', '%'.$request->search.'%')
            ->orderBy('bus_id', 'DESC')
            ->get();
        }
        // else if($request->search_type == 'Business Listing' && empty($request->search)){
        // $searchBusinessLisitngArray = DB::table('business_listing')
        //     ->select('bus_id', 'bus_name', 'bus_city', 'bus_sub_cat', 'bus_sub_cat', 'bus_address1' ,'bus_contact_no' ,'bus_email' ,'bus_state')
        //     ->where(['bus_status' => STATUS_ACTIVE])
        //     ->orderBy('bus_id', 'DESC')
        //     ->get();
        // }
        else if($request->search_type == 'Malls' && !empty($request->search)){
            $searchMallArray = DB::table('mall')
            ->select('mall_id','mall_name','mall_city','mall_logo','mall_location')
            ->where('mall_id','>', 0)
            ->where(['mall_status' => STATUS_ACTIVE])
            
            ->where(function($searchMallWhere) use ($request) {
                $searchMallWhere->where('mall_name', 'like', '%'.$request->search.'%')
                ->orWhere('mall_city', 'like', '%'.$request->search.'%');
            })

            //->Where('mall_name', 'like', '%'.$request->search.'%')
            //->orWhere('mall_city', 'like', '%'.$request->search.'%')

            ->orderBy('mall_id', 'DESC')
            ->get();
       }
    //    else if($request->search_type == 'Malls' && empty($request->search))
    //    {
    //         $searchMallArray = DB::table('mall')
    //         ->select('mall_id','mall_name','mall_city','mall_logo','mall_location')
    //         ->where(['mall_status' => STATUS_ACTIVE])
    //         ->orderBy('mall_id', 'DESC')
    //         ->get();
    //    }
       
       else if($request->search_type == 'Brands' && !empty($request->search)){
            $searchBrandsArray = DB::table('brands')
            ->select('brand_id','brand_name','brand_mall_id','brand_logo','brand_email','brand_location','brand_city')
            ->where('brand_id','>', 0)
            ->where(['brand_status' => STATUS_ACTIVE])

            ->where(function($searchBrandsWhere) use ($request) {
                $searchBrandsWhere->where('brand_name', 'like', '%'.$request->search.'%')
                ->orWhere('brand_city', 'like', '%'.$request->search.'%');
            })

            //->Where('brand_name', 'like', '%'.$request->search.'%')
            //->orWhere('brand_city', 'like', '%'.$request->search.'%')
            ->orderBy('brand_id', 'DESC')
            ->get();
       }
        /*else if($request->search_type == 'shopping Blog' && !empty($request->search)){
            $searchShoppingBlogArray = DB::table('blog')
            ->select('blog_id','blog_title','blog_image')
            ->where('blog_id','>', 0)
            ->where(['blog_status' => STATUS_ACTIVE])
            ->Where('blog_title', 'like', '%'.$request->search.'%')
            //->orWhere('brand_city', 'like', '%'.$request->search.'%')
            ->orderBy('blog_id', 'DESC')
            ->get();
        }
        else if($request->search_type == 'Blogs' && !empty($request->search)){
            $searchBlogsArray = DB::table('blog_category')
            ->select('blog_cat_id','blog_cat_title','blog_cat_image','blog_cat_subcat')
            ->where('blog_cat_id','>', 0)
            ->where(['blog_cat_status' => STATUS_ACTIVE])

            ->where(function($searchBlogsWhere) use ($request) {
                $searchBlogsWhere->where('blog_cat_title', 'like', '%'.$request->search.'%')
                ->orWhere('blog_cat_country', 'like', '%'.$request->search.'%')
                ->orWhere('blog_cat_city', 'like', '%'.$request->search.'%');
            })



            //->Where('blog_cat_title', 'like', '%'.$request->search.'%')
            //->orWhere('blog_cat_country', 'like', '%'.$request->search.'%')
            //->orWhere('blog_cat_city', 'like', '%'.$request->search.'%')
            ->orderBy('blog_cat_id', 'DESC')
            ->get();
        }*/
else if($request->search_type == 'Blogs' && !empty($request->search)){

//DB::enableQueryLog();

         $shoppingBlogs = DB::table('blog')
        ->select(
            'blog_id as id',
            'blog_title as title',
            'blog_image as image',
            'blog_maincat_name as sub_category',
            DB::raw("'blog' as source")
        )
        ->where('blog_status', STATUS_ACTIVE)
        ->where('blog_title', 'like', "%{$search}%");

    // Second table: blog_category
    $blogs = DB::table('blog_category')
        ->select(
            'blog_cat_id as id',
            'blog_cat_title as title',
            'blog_cat_image as image',
            'blog_cat_subcat as sub_category',
            DB::raw("'blog_category' as source")
        )
        ->where('blog_cat_status', STATUS_ACTIVE)
        ->where(function ($q) use ($search) {
            $q->where('blog_cat_title', 'like', "%{$search}%")
              ->orWhere('blog_cat_country', 'like', "%{$search}%")
              ->orWhere('blog_cat_city', 'like', "%{$search}%");
        });

    // UNION both queries
    $blogsData = $shoppingBlogs
        ->unionAll($blogs)
        ->orderBy('id', 'DESC')
        ->get();
        }
//dd(DB::getQueryLog());
    //    else if($request->search_type == 'Brands' && empty($request->search))
    //    {
    //     $searchBrandsArray = DB::table('brands')
    //     ->select('brand_id','brand_name','brand_mall_id','brand_logo','brand_email','brand_location','brand_city')
    //     ->where(['brand_status' => STATUS_ACTIVE])
    //     ->orderBy('brand_id', 'DESC')
    //     ->get();
    //    }
        //dd(DB::getQueryLog());
        
        return view('frontend.search',['blogCategoryHeaderMenu'=>$blogCategoryHeaderMenu,'businessListingHeaderMenu'=>$businessListingHeaderMenu,'mallCityHeaderMenu' => $mallCityHeaderMenu,'searchBusinessLisitngArray' => $searchBusinessLisitngArray,'searchMallArray' => $searchMallArray,'searchBrandsArray' => $searchBrandsArray,
        'couponHeaderMenu'=> $couponHeaderMenu,
        'offerHeaderMenu'=> $offerHeaderMenu,
        'searchType' => $request->search_type,
        'blogsData' => $blogsData,
        // 'searchShoppingBlogArray' => $searchShoppingBlogArray,
        // 'searchBlogsArray' => $searchBlogsArray
     ]);
    }

    
}
