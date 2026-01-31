<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogCatComments;
use App\Http\Controllers\frontend\businessListingController;
use Illuminate\Support\Facades\DB;
//use DB;
class blogsCategoryController extends Controller
{

    public function blogCategoryHeaderMenu() 
    {
        // $blogCategoryHeaderMenu = BlogCategory::select('blog_cat_id','blog_cat_country')
        // ->where(['blog_cat_status'=>STATUS_ACTIVE])
        // ->groupBy('blog_cat_country')
        // ->orderBy('blog_cat_country', 'ASC')
        // ->get();

        $blogCategoryHeaderMenu = BlogCategory::where('blog_cat_status', STATUS_ACTIVE)
            ->distinct()
            ->orderBy('blog_cat_country', 'ASC')
            ->pluck('blog_cat_country');

        return $blogCategoryHeaderMenu;
    }

    public function businessListingHeaderMenu()
    {
        $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();    
        return $businessListingHeaderMenu;
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

    public function getBlogCategoryIndexData()
    {
        $getBlogCategoryIndexArray = DB::table('blog_category')
            ->select('blog_cat_id', 'blog_cat_title', 'blog_cat_subcat', 'blog_cat_maincat', 'blog_cat_image', 'blog_cat_added_time')
            ->where(['blog_cat_status' => STATUS_ACTIVE])
            ->orderBy('blog_cat_id', 'DESC')
            ->limit(8)
            ->get();
        return $getBlogCategoryIndexArray;
    }
    public function mallInUSAList()
    {
        $mallInUSAListArray = DB::table('blog_category')
            ->select('blog_cat_id', 'blog_cat_title','blog_cat_subcat','blog_cat_state','blog_cat_image', 'blog_cat_image', 'blog_cat_country')
            ->where(['blog_cat_status' => STATUS_ACTIVE, 'blog_cat_country' => 'USA'])
            ->inRandomOrder()
            ->limit(10)
            ->get();
        return $mallInUSAListArray;
    }



    public function blogCategoryListView(Request $request)
    {
       // DB::enableQueryLog();
       // dd(DB::getQueryLog());
       
       $newBlogCatTitle = str_replace('-', ' ', $request->title);
       $newBlogCatTitle1 = str_replace('-', ' ', $request->title1);

       $BlogCategorySubData = BlogCategory::where(['blog_cat_status'=>STATUS_ACTIVE,'blog_cat_country'=>$newBlogCatTitle])->groupBy('blog_cat_subcat')->orderBy('blog_cat_subcat', 'ASC')->get();
       $BlogCategoryStateData = BlogCategory::where(['blog_cat_status'=>STATUS_ACTIVE,'blog_cat_country'=>$newBlogCatTitle])->groupBy('blog_cat_state')->orderBy('blog_cat_subcat', 'ASC')->get();

        if($newBlogCatTitle1 == 'ALL')
        {
            $BlogCategoryData = BlogCategory::where(['blog_cat_status'=>STATUS_ACTIVE,'blog_cat_country'=>$newBlogCatTitle])->orderBy('blog_cat_id', 'DESC')->get();
        }else
        {
                $BlogCategoryData = BlogCategory::where('blog_cat_status', STATUS_ACTIVE)
                    ->where('blog_cat_country', $newBlogCatTitle)
                    ->where(function($query) use ($newBlogCatTitle1) {
                        $query->where('blog_cat_subcat', $newBlogCatTitle1)
                            ->orWhere('blog_cat_state', $newBlogCatTitle1);
                    })
                    ->orderBy('blog_cat_id', 'DESC')
                    ->get();
            // $BlogCategoryData = BlogCategory::where('blog_cat_status',STATUS_ACTIVE)->where('blog_cat_country',$newBlogCatTitle)->where('blog_cat_subcat',$newBlogCatTitle1)->orWhere('blog_cat_state',$newBlogCatTitle1)
            // ->orderBy('blog_cat_id', 'DESC')->get();
        }

        return view('frontend.blogCategoryList',['BlogCategoryData'=>$BlogCategoryData,'BlogCategorySubData'=>$BlogCategorySubData,'BlogCategoryStateData'=>$BlogCategoryStateData,'blogCategoryHeaderMenu'=>$this->blogCategoryHeaderMenu(),'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=>$this->couponHeaderMenu(),'offerHeaderMenu'=> $this->offerHeaderMenu()]);
    }

    public function blogCategoryDetailView(Request $request)
    {
        $newBlogCatTitle = str_replace('-', ' ', $request->title);
        $newBlogCatTitle1 = str_replace('-', ' ', $request->title1);
        $blogCatSingleData = BlogCategory::where(['blog_cat_subcat'=>$newBlogCatTitle,'blog_cat_title'=>$newBlogCatTitle1])->first();
        if(empty($blogCatSingleData) && $blogCatSingleData == '' ){
            return '<img src="'.NOT_FOUND_IMAGE_PATH.'" style=" height: 650px; display: block;margin: auto;">';
        }else{
            $blogCatRecentData = BlogCategory::where('blog_cat_status',STATUS_ACTIVE)->orderBy('blog_cat_id', 'DESC')->limit('10')->get();
            // DB::enableQueryLog();
            $recentBlogCatCommentsData = BlogCatComments::join('users','users.id', '=' , 'blog_cat_comments.blogcat_comment_user_id')->where('blogcat_comment_blog_id',$blogCatSingleData['blog_cat_id'])->orderBy('blogcat_comment_id', 'DESC')->limit('10')->get(['users.name','blog_cat_comments.blogcat_comment_desc','blog_cat_comments.blogcat_comment_added_time']);
            //dd(DB::getQueryLog()); 

            $recentBusinessListingArray = DB::table('business_listing')
            ->select('bus_id','bus_name', 'bus_contact_no','bus_address1','bus_city','bus_sub_cat')
            ->where(['bus_status' => STATUS_ACTIVE])
            ->orderByDesc('bus_id')
            ->limit(10)
            ->get();
            return view('frontend.blogCategoryDetail',['blogCatSingleData'=>$blogCatSingleData,'recentBusinessListingArray' => $recentBusinessListingArray, 'blogCategoryHeaderMenu'=>$this->blogCategoryHeaderMenu(),'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=>$this->couponHeaderMenu(),'offerHeaderMenu'=> $this->offerHeaderMenu(),'blogCatRecentData'=>$blogCatRecentData,'recentBlogCatCommentsData'=>$recentBlogCatCommentsData]);
        }
    }

    public function blogCatCommentStore(Request $request)
    {
        $blogCatData = BlogCatComments::create([
            'blogcat_comment_blog_id' => $request->blogcat_comment_blog_id,
            'blogcat_comment_user_id' => $request->blogcat_comment_user_id,
            'blogcat_comment_desc' => $request->blogcat_comment_desc,
            'blogcat_comment_added_time' => CURRENT_DATE_TIME
        ]);

        $blogCatSingleData = BlogCategory::where('blog_cat_id',$request->blogcat_comment_blog_id)->first();
        $newBlogSubCat = str_replace(' ', '-', $blogCatSingleData['blog_cat_subcat']);
        $newBlogCatTitle = str_replace(' ', '-', $blogCatSingleData['blog_cat_title']);
        
        if($blogCatData)
        {
            return redirect('/blog-info/'.$newBlogSubCat.'/'.$newBlogCatTitle)->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/blog-info/'.$newBlogSubCat.'/'.$newBlogCatTitle)->with('message',MSG_ADD_ERROR);
        }
    }

}
