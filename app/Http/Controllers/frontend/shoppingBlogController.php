<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogComments;
use App\Models\businessListing;
use App\Http\Controllers\frontend\blogsCategoryController;
use Illuminate\Support\Facades\DB;
class shoppingBlogController extends Controller
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

    public function shoppingBlogView(){
        //$blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
        $blogData = Blog::where('blog_status',STATUS_ACTIVE)->orderBy('blog_id', 'DESC')->get();
        return view('frontend.shoppingBlog',['blogData'=>$blogData,'blogCategoryHeaderMenu'=>$this->blogCategoryHeaderMenu(),'businessListingHeaderMenu'=>$this->businessListingHeaderMenu(),
        'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),
        'couponHeaderMenu' => $this->couponHeaderMenu(),
        'offerHeaderMenu' => $this->offerHeaderMenu()
    ]);
    }

    public function shoppingBlogDetailView(Request $request ){

       // $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
        
        $newBlogTitle = str_replace('-', ' ', $request->title);
        $blogSingleData = Blog::where(['blog_title' => $newBlogTitle,'blog_status' => STATUS_ACTIVE])->first();
        if(empty($blogSingleData) && $blogSingleData == '' ){
            return '<img src="'.NOT_FOUND_IMAGE_PATH.'" style=" height: 650px; display: block;margin: auto;">';
        }else{
            $recentBlogData = Blog::where('blog_status',STATUS_ACTIVE)->orderBy('blog_id', 'DESC')->limit('10')->get();
            //$recentBlogCommentsData = BlogComments::where('bc_blog_id',$blogSingleData['blog_id'])->orderBy('bc_id', 'DESC')->limit('10')->get();
            $recentBlogCommentsData = BlogComments::join('users','users.id', '=' , 'blog_comments.bc_user_id')->where('bc_blog_id',$blogSingleData['blog_id'])->orderBy('bc_id', 'DESC')->limit('10')->get(['users.name','blog_comments.bc_desc','blog_comments.created_at']);
            //dd($recentBlogCommentsData);

            $recentBusinessListingArray = DB::table('business_listing')
            ->select('bus_id','bus_name', 'bus_contact_no','bus_address1','bus_city','bus_sub_cat')
            ->where(['bus_status' => STATUS_ACTIVE])
            ->orderByDesc('bus_id')
            ->limit(10)
            ->get();
        
            return view('frontend.shoppingBlogDetail',['blogSingleData'=>$blogSingleData,'recentBlogData'=>$recentBlogData,'recentBlogCommentsData'=>$recentBlogCommentsData,'recentBusinessListingArray'=>$recentBusinessListingArray,'blogCategoryHeaderMenu'=>$this->blogCategoryHeaderMenu(),'businessListingHeaderMenu'=>$this->businessListingHeaderMenu(),
            'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),
            'couponHeaderMenu' => $this->couponHeaderMenu(),
            'offerHeaderMenu' => $this->offerHeaderMenu() ]);
        }
    }

    public function blogCommentStore(Request $request)
    {
        $blogData = BlogComments::create([
            'bc_blog_id' => $request->bc_blog_id,
            'bc_user_id' => $request->bc_user_id,
            'bc_desc' => $request->bc_desc,
            'created_at' => CURRENT_DATE_TIME
        ]);

        $blogSingleData = Blog::where('blog_id',$request->bc_blog_id)->first();
        $newBlogTitle = str_replace(' ', '-', $blogSingleData['blog_title']);

        if($blogData)
        {
            return redirect('/detail-blog/'.$newBlogTitle)->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/detail-blog/'.$newBlogTitle)->with('message',MSG_ADD_ERROR);
        }
    }
}
