<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryMain;
use App\Models\Mall;
use App\Models\Brands;
use App\Models\Offers;
use DB;
use League\CommonMark\Extension\Table\Table;

class adminOffersController extends Controller
{

    public function offerListView(Request $request)
    {
       $offerListData = DB::table('offers')
        ->select('offers.offer_status','offers.offer_id','offers.offer_mall_id','offers.offer_brand_id', 'offers.offer_title', 'offers.offer_main_category', 'offers.offer_sub_category',
        'offers.offer_title', 'offers.offer_country', 'offers.offer_state', 'offers.offer_city',
        'offers.offer_start_date', 'offers.offer_start_time', 'offers.offer_end_date', 'offers.offer_end_time',
        'offers.offer_detail', 'offers.offer_image', 'offers.offer_meta_title', 'offers.offer_meta_keyword',
        'offers.offer_meta_description','offers.offer_added_timestamp','offers.offer_changed_timestamp',
        'mall.mall_id','mall_name','brands.brand_id','brands.brand_name')
        ->join('mall', 'mall.mall_id', '=', 'offers.offer_mall_id')
        ->where('offers.offer_status',$request->status)
        ->leftjoin('brands', 'brands.brand_id', '=', 'offers.offer_brand_id')
        ->orderBy('offer_id', 'DESC')
        ->get();
        return view('admin.offerList',['offerListData'=>$offerListData]);
    }


    public function offerAddView()
    {
         // DB::enableQueryLog();
         $blogCategoryMainData = CategoryMain::where(['cat_main_type'=>TYPE_BLOG,'cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
         $mallData = Mall::where(['mall_status'=>STATUS_ACTIVE])->orderBy('mall_id', 'DESC')->get();
         //dd(DB::getQueryLog());
        return view('admin.offerAdd',['blogCategoryMainData'=>$blogCategoryMainData,'mallData'=>$mallData]);
    }

    public function offerStore(Request $request)
    {
        //dd($request->all());

        //DB::enableQueryLog();
        $blogCategoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where(['cat_main_type'=>TYPE_BLOG, 'cat_main_id'=>$request->offer_main_category,'cat_sub_id'=>$request->offer_sub_category])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);
       //dd(DB::getQueryLog());

        if($request->hasfile('offer_image'))
        {
            $offerImageFile = $request->file('offer_image');
            $offerImageFileName = $offerImageFile->getClientOriginalName();
            $newOfferImage = time().'.'.$offerImageFileName;
            $offerImageFile->move('custom-images/offers',$newOfferImage);
        }

        $offerInsertData = Offers::create([
            'offer_main_category' => $blogCategoryData['cat_main_name'],
            'offer_sub_category' => $blogCategoryData['cat_sub_name'],
            'offer_mall_id' => $request->offer_mall_id,
            'offer_brand_id' => $request->offer_brand_id,
            'offer_title' => $request->offer_title,
            'offer_country' => $request->offer_country,
            'offer_state' => $request->offer_state,
            'offer_city' => $request->offer_city,

            'offer_start_date' => $request->offer_start_date,
            'offer_start_time' => $request->offer_start_time,
            'offer_end_date' => $request->offer_end_date,
            'offer_end_time' => $request->offer_end_time,
            'offer_detail' => $request->offer_detail,

            'offer_image' => $newOfferImage,
            'offer_meta_title' => $request->offer_meta_title,
            'offer_meta_keyword' => $request->offer_meta_keyword,
            'offer_meta_description' => $request->offer_meta_description,

            'offer_status' => STATUS_INACTIVE,
            'offer_added_timestamp' => CURRENT_DATE_TIME
        ]);
        if($offerInsertData)
        {
            return redirect('/admin/offerAdd')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/admin/offerAdd')->with('message',MSG_ADD_ERROR);
        }
    }

    public function offerEditView(Request $request)
    {
        $blogCategoryMainData = CategoryMain::where(['cat_main_type'=>TYPE_BLOG,'cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
        $mallData = Mall::where(['mall_status'=>STATUS_ACTIVE])->orderBy('mall_id', 'DESC')->get();
        //$offerSingleData = offers::where('offer_id',$request->id)->first();


       // DB::enableQueryLog();
       $offerSingleData = DB::table('offers')
       ->select('offers.offer_status','offers.offer_id','offers.offer_mall_id','offers.offer_brand_id', 'offers.offer_title', 'offers.offer_main_category', 'offers.offer_sub_category',
       'offers.offer_title', 'offers.offer_country', 'offers.offer_state', 'offers.offer_city',
       'offers.offer_start_date', 'offers.offer_start_time', 'offers.offer_end_date', 'offers.offer_end_time',
       'offers.offer_detail', 'offers.offer_image', 'offers.offer_meta_title', 'offers.offer_meta_keyword',
       'offers.offer_meta_description', 'mall.mall_id','mall_name','brands.brand_id','brands.brand_name')
       ->join('mall', 'mall.mall_id', '=', 'offers.offer_mall_id')
       ->leftjoin('brands', 'brands.brand_id', '=', 'offers.offer_brand_id')
       ->where('offers.offer_id', $request->id)
       ->first();
       //dd(DB::getQueryLog());
        return view('admin.offerEdit',['blogCategoryMainData'=>$blogCategoryMainData,'mallData'=>$mallData,'offerSingleData'=>$offerSingleData]);
    }


    public function offerUpdate(Request $request)
    {
        if($request->hasfile('offer_image'))
        {
            $offerImageFile = $request->file('offer_image');
            $offerImageFileName = $offerImageFile->getClientOriginalName();
            $newOfferImage = time().'.'.$offerImageFileName;
            $offerImageFile->move('custom-images/offers',$newOfferImage);
            if(isset($request->old_offer_image))
            {
                unlink('custom-images/offers/'.$request->old_offer_image);
            }
        }else{
            $newOfferImage = $request->old_offer_image;
        }

        if(isset($request->offer_main_category) && isset($request->offer_sub_category))
        {
            $blogCategoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where(['cat_main_type'=>TYPE_BLOG, 'cat_main_id'=>$request->offer_main_category,'cat_sub_id'=>$request->offer_sub_category])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);

            $catMainName = $blogCategoryData['cat_main_name'];
            $catSubName = $blogCategoryData['cat_sub_name'];

        }else{
            $catMainName = $request->old_offer_main_category;
            $catSubName = $request->old_offer_sub_category;
        }


        if(isset($request->offer_mall_id) && isset($request->offer_brand_id))
        {
            $offerMallId = $request->offer_mall_id;
            $offerBrandId = $request->offer_brand_id;

        }else{
            $offerMallId = $request->old_offer_mall_id;
            $offerBrandId = $request->old_offer_brand_id;
        }


        $offerUpdateData =Offers::where("offer_id", $request->id)->update(
            [
                'offer_main_category' => $catMainName,
                'offer_sub_category' => $catSubName,
                'offer_mall_id' => $offerMallId,
                'offer_brand_id' => $offerBrandId,

                'offer_title' => $request->offer_title,
                'offer_country' => $request->offer_country,
                'offer_state' => $request->offer_state,
                'offer_city' => $request->offer_city,

                'offer_start_date' => $request->offer_start_date,
                'offer_start_time' => $request->offer_start_time,
                'offer_end_date' => $request->offer_end_date,
                'offer_end_time' => $request->offer_end_time,
                'offer_detail' => $request->offer_detail,

                'offer_image' => $newOfferImage,
                'offer_meta_title' => $request->offer_meta_title,
                'offer_meta_keyword' => $request->offer_meta_keyword,
                'offer_meta_description' => $request->offer_meta_description,

                'offer_status' => $request->offer_status,
                'offer_changed_timestamp' => CURRENT_DATE_TIME
            ]
        );
        if($offerUpdateData)
        {
            return redirect('admin/offerEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/offerEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }
}
