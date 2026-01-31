<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryMain;
use App\Models\CategorySub;
use App\Models\BlogCategory;
use DB;
class blogCategoryController extends Controller
{

    public function blogCategoryListView()
    {
        $blogCategoryListData = BlogCategory::orderBy('blog_cat_id', 'DESC')->get();
        return view('admin.blogCategoryList',['blogCategoryListData'=>$blogCategoryListData]);
    }

    public function blogCategoryAddView()
    {
       // DB::enableQueryLog();
        $blogCategoryMainData = CategoryMain::where(['cat_main_type'=>TYPE_BLOG,'cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
        //dd(DB::getQueryLog());
        return view('admin.blogCategoryAdd',['blogCategoryMainData'=>$blogCategoryMainData]);
    }

    public function getBlogSubCategory(Request $request){
        $blogCategorySubSingleData = CategorySub::where(['cat_sub_status'=>STATUS_ACTIVE,'cat_sub_main_id'=>$request->catmain_id])->orderBy('cat_sub_id', 'DESC')->get();
        $optionTag = ' <option value="">Select Sub Category</option>';
        foreach($blogCategorySubSingleData as $blogCategorySubSingleRow)
        {
            $optionTag .= ' <option value="'.$blogCategorySubSingleRow['cat_sub_id'].'">'.$blogCategorySubSingleRow['cat_sub_name'].'</option>';
        }
        echo $optionTag;
    }

    public function blogCategoryStore(Request $request)
    {
        //dd($request->all());

        //DB::enableQueryLog();
        $blogCategoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where(['cat_main_type'=>TYPE_BLOG, 'cat_main_id'=>$request->blog_cat_maincat,'cat_sub_id'=>$request->blog_cat_subcat])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);
       // dd(DB::getQueryLog());


        if($request->hasfile('blog_cat_image'))
        {
            $BlogCatImageFile = $request->file('blog_cat_image');
            $BlogCatImageFileName = $BlogCatImageFile->getClientOriginalName();
            $newBlogCatImage = time().'.'.$BlogCatImageFileName;
            $BlogCatImageFile->move('custom-images/blog-cat-images',$newBlogCatImage);
        }
        if($request->hasfile('blog_cat_subcat_image'))
        {
            $BlogCatSubcatImageFile = $request->file('blog_cat_subcat_image');
            $BlogCatSubcatImageFileName = $BlogCatSubcatImageFile->getClientOriginalName();
            $newBlogCatSubcatImage = time().'.'.$BlogCatSubcatImageFileName;
            $BlogCatSubcatImageFile->move('custom-images/blog-cat-images',$newBlogCatSubcatImage);
        }

        $blogCategoryInsertData = BlogCategory::create([
            'blog_cat_maincat' => $blogCategoryData['cat_main_name'],
            'blog_cat_subcat' => $blogCategoryData['cat_sub_name'],
            'blog_cat_title' => $request->blog_cat_title,
            'blog_cat_country' => $request->blog_cat_country,
            'blog_cat_state' => $request->blog_cat_state,
            'blog_cat_city' => $request->blog_cat_city,
            'blog_cat_start_date' => $request->blog_cat_start_date,
            'blog_cat_start_time' => $request->blog_cat_start_time,
            'blog_cat_image' => $newBlogCatImage,
            'blog_cat_subcat_image' => $newBlogCatSubcatImage,
            'blog_cat_desc' => $request->blog_cat_desc,
            'blog_cat_meta_title' => $request->blog_cat_meta_title,
            'blog_cat_meta_keyword' => $request->blog_cat_meta_keyword,
            'blog_cat_meta_desc' => $request->blog_cat_meta_desc,
            'blog_cat_admin_comment' => $request->blog_cat_admin_comment,
            'blog_cat_status' => STATUS_INACTIVE,
            'blog_cat_added_time' => CURRENT_DATE_TIME
        ]);
        if($blogCategoryInsertData)
        {
            return redirect('/admin/blogCategoryAdd')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/admin/blogCategoryAdd')->with('message',MSG_ADD_ERROR);
        }
    }

    public function blogCategoryEditView(Request $request)
    {
        $blogCategoryMainData = CategoryMain::where(['cat_main_type'=>TYPE_BLOG,'cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();

        $blogCategorySingleData = BlogCategory::where('blog_cat_id',$request->id)->first();
        return view('admin.blogCategoryEdit',['blogCategoryMainData'=>$blogCategoryMainData,'blogCategorySingleData'=>$blogCategorySingleData]);
    }

    public function blogCategoryUpdate(Request $request){

        if($request->hasfile('blog_cat_image')){
            $BlogCatImageFile = $request->file('blog_cat_image');
            $BlogCatImageFileName = $BlogCatImageFile->getClientOriginalName();
            $newBlogCatImage = time().'.'.$BlogCatImageFileName;
            $BlogCatImageFile->move('custom-images/blog-cat-images',$newBlogCatImage);

            $imagePathOldBlog = 'custom-images/blog-cat-images/'.$request->old_blog_cat_image;
            if(file_exists($imagePathOldBlog)){
                unlink($imagePathOldBlog);
            }


            // if(isset($request->old_blog_cat_image)){
            //     unlink('custom-images/blog-cat-images/'.$request->old_blog_cat_image);
            // }
        }else{
            $newBlogCatImage = $request->old_blog_cat_image;
        }

        if($request->hasfile('blog_cat_subcat_image')){
            $BlogCatSubcatImageFile = $request->file('blog_cat_subcat_image');
            $BlogCatSubcatImageFileName = $BlogCatSubcatImageFile->getClientOriginalName();
            $newBlogCatSubcatImage = time().'.'.$BlogCatSubcatImageFileName;
            $BlogCatSubcatImageFile->move('custom-images/blog-cat-images',$newBlogCatSubcatImage);

            $imagePathOldBlogCat = 'custom-images/blog-cat-images/'.$request->old_blog_cat_subcat_image;
            if(file_exists($imagePathOldBlogCat)){
                unlink($imagePathOldBlogCat);
            }

            // if(isset($request->old_blog_cat_subcat_image)){
            //     unlink('custom-images/blog-cat-images/'.$request->old_blog_cat_subcat_image);
            // }
        }else{
            $newBlogCatSubcatImage = $request->old_blog_cat_subcat_image;
        }

        if(isset($request->blog_cat_maincat) && isset($request->blog_cat_subcat))
        {
            $blogCategoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where(['cat_main_type'=>TYPE_BLOG, 'cat_main_id'=>$request->blog_cat_maincat,'cat_sub_id'=>$request->blog_cat_subcat])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);
            
            $catMainName = $blogCategoryData['cat_main_name'];
            $catSubName = $blogCategoryData['cat_sub_name'];

        }else{
            $catMainName = $request->old_blog_cat_maincat;
            $catSubName = $request->old_blog_cat_subcat;
        }

        $blogCategoryUpdateData =BlogCategory::where("blog_cat_id", $request->id)->update(
            [
                'blog_cat_maincat' => $catMainName,
                'blog_cat_subcat' => $catSubName,
                'blog_cat_title' => $request->blog_cat_title,
                'blog_cat_country' => $request->blog_cat_country,
                'blog_cat_state' => $request->blog_cat_state,
                'blog_cat_city' => $request->blog_cat_city,
                'blog_cat_start_date' => $request->blog_cat_start_date,
                'blog_cat_start_time' => $request->blog_cat_start_time,
                'blog_cat_image' => $newBlogCatImage,
                'blog_cat_subcat_image' => $newBlogCatSubcatImage,
                'blog_cat_desc' => $request->blog_cat_desc,
                'blog_cat_meta_title' => $request->blog_cat_meta_title,
                'blog_cat_meta_keyword' => $request->blog_cat_meta_keyword,
                'blog_cat_meta_desc' => $request->blog_cat_meta_desc,
                'blog_cat_status' => $request->blog_cat_status,
                'blog_cat_admin_comment' => $request->blog_cat_admin_comment,
                'blog_cat_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($blogCategoryUpdateData)
        {
            return redirect('admin/blogCategoryEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/blogCategoryEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    } 

}
