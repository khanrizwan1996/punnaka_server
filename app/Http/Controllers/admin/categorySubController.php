<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryMain;
use App\Models\CategorySub;

class categorySubController extends Controller
{
    public function blogCategorySubListView()
    {

        $blogCategoryMainData = CategoryMain::where(['cat_main_type' => TYPE_BLOG,'cat_main_status' => STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();

        $blogCategorySubData = CategorySub::join('category_main','category_main.cat_main_id', '=' , 'category_sub.cat_sub_main_id')->where('cat_main_type',TYPE_BLOG)->orderBy('cat_sub_id', 'DESC')->get(['category_sub.cat_sub_id','category_sub.cat_sub_main_id', 'category_sub.cat_sub_status', 'category_sub.cat_sub_name', 'category_sub.cat_sub_image', 'category_sub.cat_sub_added_time', 'category_sub.cat_sub_changed_time','category_main.cat_main_name']);

        return view('admin.blogCategorySubList',['blogCategorySubData'=>$blogCategorySubData, 'blogCategoryMainData' => $blogCategoryMainData]);
    }

    public function blogSubCategoryStore(Request $request)
    {

        if($request->hasfile('cat_sub_image'))
        {
            $file = $request->file('cat_sub_image');
            $filename = $file->getClientOriginalName();
            $newFileName = time().'.'.$filename;
            $file->move('custom-images/blog-cat-images',$newFileName);
        }


        $blogCategorySubInsert = CategorySub::create([
            'cat_sub_main_id' => $request->cat_sub_main_id,
            'cat_sub_name' => $request->cat_sub_name,
            'cat_sub_image' => $newFileName,
            'cat_sub_status' => STATUS_INACTIVE,
            'cat_sub_added_time' => CURRENT_DATE_TIME
        ]);
        if($blogCategorySubInsert)
        {
            return redirect('admin/blogCategorySubList')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('admin/blogCategorySubList')->with('message',MSG_ADD_ERROR);
        }
    }

    public function blogCategorySubEditView(Request $request)
    {
        $blogCategoryMainData = CategoryMain::where(['cat_main_type' => TYPE_BLOG,'cat_main_status' => STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();


        $blogCategorySubSingleData = CategorySub::where('cat_sub_id',$request->id)->first();
        return view('admin.blogCategorySubEdit',['blogCategorySubSingleData'=>$blogCategorySubSingleData, 'blogCategoryMainData' => $blogCategoryMainData]);
    }

    public function blogSubCategoryUpdate(Request $request)
    {
        //dd($request->all());
        if($request->hasfile('cat_sub_image'))
        {
            $file = $request->file('cat_sub_image');
            $filename = $file->getClientOriginalName();
            $newFileName = time().'.'.$filename;
            $file->move('custom-images/blog-cat-images',$newFileName);
            unlink('custom-images/blog-cat-images/'.$request->old_cat_sub_image);
        }else{
            $newFileName = $request->old_cat_sub_image;
        }

        $blogCategorySubSingleUpdate =CategorySub::where("cat_sub_id", $request->id)->update(
            [
                'cat_sub_main_id' => $request->cat_sub_main_id,
                'cat_sub_name' => $request->cat_sub_name,
                'cat_sub_image' => $newFileName,
                'cat_sub_status' => $request->cat_sub_status,
                'cat_sub_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($blogCategorySubSingleUpdate)
        {
            return redirect('admin/blogCategorySubEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/blogCategorySubEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }



    public function businessListingCategorySubView()
    {

        $busniessListingMainData = CategoryMain::where(['cat_main_type' => TYPE_BUSINESS_LISTING,'cat_main_status' => STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();

        $busniessListingSubData = CategorySub::join('category_main','category_main.cat_main_id', '=' , 'category_sub.cat_sub_main_id')->where('cat_main_type',TYPE_BUSINESS_LISTING)->orderBy('cat_sub_id', 'DESC')->get(['category_sub.cat_sub_id','category_sub.cat_sub_main_id', 'category_sub.cat_sub_status', 'category_sub.cat_sub_name', 'category_sub.cat_sub_image', 'category_sub.cat_sub_added_time', 'category_sub.cat_sub_changed_time','category_main.cat_main_name']);

        return view('admin.businessListingSubList',['busniessListingSubData'=>$busniessListingSubData, 'busniessListingMainData' => $busniessListingMainData]);
    }

    public function businessListingCategorySubStore(Request $request)
    {

        if($request->hasfile('cat_sub_image'))
        {
            $file = $request->file('cat_sub_image');
            $filename = $file->getClientOriginalName();
            $newFileName = time().'.'.$filename;
            $file->move('custom-images/blog-cat-images',$newFileName);
        }


        $businessListingCategorySubInsert = CategorySub::create([
            'cat_sub_main_id' => $request->cat_sub_main_id,
            'cat_sub_name' => $request->cat_sub_name,
            'cat_sub_image' => $newFileName,
            'cat_sub_status' => STATUS_INACTIVE,
            'cat_sub_added_time' => CURRENT_DATE_TIME
        ]);
        if($businessListingCategorySubInsert)
        {
            return redirect('admin/businessListingCategorySubList')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('admin/businessListingCategorySubList')->with('message',MSG_ADD_ERROR);
        }
    }

    
    
    public function businessListingCategorySubEditView(Request $request)
    {
        $businessListingCategoryMainData = CategoryMain::where(['cat_main_type' => TYPE_BUSINESS_LISTING,'cat_main_status' => STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();


        $businessListingCategorySubSingleData = CategorySub::where('cat_sub_id',$request->id)->first();
        return view('admin.businessListingCategorySubEdit',['businessListingCategorySubSingleData'=>$businessListingCategorySubSingleData, 'businessListingCategoryMainData' => $businessListingCategoryMainData]);
    }


    public function businessListingCategorySubUpdate(Request $request)
    {
        if($request->hasfile('cat_sub_image'))
        {
            $file = $request->file('cat_sub_image');
            $filename = $file->getClientOriginalName();
            $newFileName = time().'.'.$filename;
            $file->move('custom-images/blog-cat-images',$newFileName);
            unlink('custom-images/blog-cat-images/'.$request->old_cat_sub_image);
        }else{
            $newFileName = $request->old_cat_sub_image;
        }

        $businessListingCategorySubSingleUpdate =CategorySub::where("cat_sub_id", $request->id)->update(
            [
                'cat_sub_main_id' => $request->cat_sub_main_id,
                'cat_sub_name' => $request->cat_sub_name,
                'cat_sub_image' => $newFileName,
                'cat_sub_status' => $request->cat_sub_status,
                'cat_sub_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($businessListingCategorySubSingleUpdate)
        {
            return redirect('admin/businessListingCategorySubEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/businessListingCategorySubEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }

}
