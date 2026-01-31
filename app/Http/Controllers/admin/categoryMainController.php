<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryMain;

class categoryMainController extends Controller
{
    public function blogCategoryMainListView()
    {
        $blogCategoryMainData = CategoryMain::where('cat_main_type',TYPE_BLOG)->orderBy('cat_main_id', 'DESC')->get();
        return view('admin.blogCategoryMainList',['blogCategoryMainData'=>$blogCategoryMainData]);
    }

    public function blogMainCategoryStore(Request $request)
    {
        $blogCategoryMainInsert = CategoryMain::create([
            'cat_main_type' => TYPE_BLOG,
            'cat_main_name' => $request->cat_main_name,
            'cat_main_status' => STATUS_INACTIVE,
            'cat_main_added_time' => CURRENT_DATE_TIME
        ]);
        if($blogCategoryMainInsert)
        {
            return redirect('admin/blogCategoryMainList')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('admin/blogCategoryMainList')->with('message',MSG_ADD_ERROR);
        }
    }

    public function blogCategoryMainEditView(Request $request)
    {
        $blogCategoryMainSingleData = CategoryMain::where(['cat_main_id'=>$request->id,'cat_main_type'=>TYPE_BLOG])->first();
        return view('admin.blogCategoryMainEdit',['blogCategoryMainSingleData'=>$blogCategoryMainSingleData]);
    }

    public function blogMainCategoryUpdate(Request $request)
    {
        $blogCategoryMainUpdate =CategoryMain::where(['cat_main_id'=>$request->id,'cat_main_type'=>TYPE_BLOG])->update(
            [
                'cat_main_name' => $request->cat_main_name,
                'cat_main_status' => $request->cat_main_status,
                'cat_main_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($blogCategoryMainUpdate)
        {
            return redirect('admin/blogCategoryMainEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/blogCategoryMainEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }


    public function businessListingCategoryMainListView()
    {
        $businessListCategoryMainListArray = CategoryMain::where('cat_main_type',TYPE_BUSINESS_LISTING)->orderBy('cat_main_id', 'DESC')->get();
        return view('admin.busniessListingMainList',['businessListCategoryMainListArray'=>$businessListCategoryMainListArray]);
    }

    public function businessListingMainCategoryStore(Request $request)
    {
        $businessListingCategoryMainInsert = CategoryMain::create([
            'cat_main_type' => TYPE_BUSINESS_LISTING,
            'cat_main_name' => $request->cat_main_name,
            'cat_main_status' => STATUS_INACTIVE,
            'cat_main_added_time' => CURRENT_DATE_TIME
        ]);
        if($businessListingCategoryMainInsert)
        {
            return redirect('admin/businessListingCategoryMainList')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('admin/businessListingCategoryMainList')->with('message',MSG_ADD_ERROR);
        }
    } 

    public function businessListCategoryMainEditView(Request $request)
    {
        $businessListingCategoryMainSingleData = CategoryMain::where(['cat_main_id'=>$request->id,'cat_main_type'=>TYPE_BUSINESS_LISTING])->first();
        return view('admin.busniessListingMainEdit',['businessListingCategoryMainSingleData'=>$businessListingCategoryMainSingleData]);
    }

    public function businessListingMainCategoryUpdate(Request $request){

        $businessListingCategoryMainUpdate =CategoryMain::where(['cat_main_id'=>$request->id,'cat_main_type'=>TYPE_BUSINESS_LISTING])->update([
            'cat_main_name' => $request->cat_main_name,
            'cat_main_status' => $request->cat_main_status,
            'cat_main_changed_time' => CURRENT_DATE_TIME
        ]);
        
        if($businessListingCategoryMainUpdate){
            return redirect('admin/businessListCategoryMainEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/businessListCategoryMainEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }
}
