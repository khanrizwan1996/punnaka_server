<?php

namespace App\Http\Controllers\user_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offers;
use App\Models\CategoryMain;
use App\Models\Mall;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class userOfferController extends Controller
{

    public function offerListView(Request $request)
    {
       $offerData = DB::table('offers')
        ->select('offers.offer_status','offers.offer_id','offers.offer_user_id','offers.offer_mall_id','offers.offer_brand_id', 'offers.offer_title', 'offers.offer_main_category', 'offers.offer_sub_category',
        'offers.offer_title', 'offers.offer_country', 'offers.offer_state', 'offers.offer_city',
        'offers.offer_start_date', 'offers.offer_start_time', 'offers.offer_end_date', 'offers.offer_end_time',
        'offers.offer_detail', 'offers.offer_image', 'offers.offer_meta_title', 'offers.offer_meta_keyword',
        'offers.offer_meta_description','offers.offer_added_timestamp','offers.offer_changed_timestamp')
        ->where(['offer_user_id'=> Auth::user()->id])
        ->orderBy('offer_id', 'DESC')
        ->get();
        return view('user_admin.OfferList',['offerData'=>$offerData]);
    }

    public function OfferAddView()
    {
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = 'login';
            </script>";
        }else{
            
            $checkOfferCountByUserId = DB::table('offers')->where('offer_user_id', Auth::user()->id)->count();
            if($checkOfferCountByUserId > 0) {
                echo "<script>
                    alert('You can add only 1 offers');
                    window.location.href = 'dashboard';
                </script>";
            }else{
                $mainCategoryData = CategoryMain::where(['cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
                return view('user_admin.offerAdd',['mainCategoryData'=>$mainCategoryData]);
            }
        }
    }

    public function offerStore(Request $request)
    {
        //dd($request->all());
        //DB::enableQueryLog();
        $blogCategoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where(['cat_main_id'=>$request->offer_main_category,'cat_sub_id'=>$request->offer_sub_category])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);
      // dd(DB::getQueryLog());

        if($request->hasfile('offer_image'))
        {
            $offerImageFile = $request->file('offer_image');
            $offerImageFileName = $offerImageFile->getClientOriginalName();
            $newOfferImage = time().'.'.$offerImageFileName;
            $offerImageFile->move('custom-images/offers',$newOfferImage);
        }
        if($request->hasfile('offer_brand_image'))
        {
            $offerBrandImageFile = $request->file('offer_brand_image');
            $offerBrandImageFileName = $offerBrandImageFile->getClientOriginalName();
            $newOfferBrandImage = time().'.'.$offerBrandImageFileName;
            $offerBrandImageFile->move('custom-images/offers',$newOfferBrandImage);
        }

        $offerInsertData = Offers::create([
            'offer_main_category' => $blogCategoryData['cat_main_name'],
            'offer_sub_category' => $blogCategoryData['cat_sub_name'],
            'offer_user_id' => Auth::user()->id,
            'offer_title' => $request->offer_title,
            'offer_company_name' => $request->offer_company_name,
            'offer_country' => $request->offer_country,
            'offer_state' => $request->offer_state,
            'offer_city' => $request->offer_city,

            'offer_start_date' => $request->offer_start_date,
            'offer_start_time' => $request->offer_start_time,
            'offer_end_date' => $request->offer_end_date,
            'offer_end_time' => $request->offer_end_time,
            'offer_detail' => $request->offer_detail,

            'offer_image' => $newOfferImage,
            'offer_brand_image' => $newOfferBrandImage,
            'offer_meta_title' => $request->offer_meta_title,
            'offer_meta_keyword' => $request->offer_meta_keyword,
            'offer_meta_description' => $request->offer_meta_description,
            'offer_t_c' => $request->offer_t_c,

            'offer_status' => STATUS_INACTIVE,
            'offer_added_timestamp' => CURRENT_DATE_TIME
        ]);
        if($offerInsertData)
        {
            return redirect('user-admin/offerList/0')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('user-admin/offerList/0')->with('message',MSG_ADD_ERROR);
        }
    }


    public function OfferEditView(Request $request)
    {
        
        $mainCategoryData = CategoryMain::where(['cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
        $getOffereData = DB::table('offers')
        ->select('offers.offer_status','offers.offer_id','offers.offer_mall_id','offers.offer_brand_id', 'offers.offer_title', 'offers.offer_main_category', 'offers.offer_sub_category','offers.offer_company_name','offers.offer_brand_image','offers.offer_t_c',
        'offers.offer_title', 'offers.offer_country', 'offers.offer_state', 'offers.offer_city',
        'offers.offer_start_date', 'offers.offer_start_time', 'offers.offer_end_date', 'offers.offer_end_time',
        'offers.offer_detail', 'offers.offer_image', 'offers.offer_meta_title', 'offers.offer_meta_keyword',
        'offers.offer_meta_description')
        ->where('offers.offer_id', $request->id)
        ->first();
        return view('user_admin.OfferEdit', ['getOffereData'=>$getOffereData,'mainCategoryData'=>$mainCategoryData]);
    }

    public function offerUpdate(Request $request)
    {
        if($request->hasfile('offer_image'))
        {
            $offerImageFile = $request->file('offer_image');
            $offerImageFileName = $offerImageFile->getClientOriginalName();
            $newOfferImage = time().'.'.$offerImageFileName;
            $offerImageFile->move('custom-images/offers',$newOfferImage);
            if(isset($request->old_offer_image)){
                unlink('custom-images/offers/'.$request->old_offer_image);
            }
        }else{
            $newOfferImage = $request->old_offer_image;
        }

        if($request->hasfile('offer_brand_image')){
            $offerBrandImageFile = $request->file('offer_brand_image');
            $offerBrandImageFileName = $offerBrandImageFile->getClientOriginalName();
            $newOfferBrandImage = time().'.'.$offerBrandImageFileName;
            $offerBrandImageFile->move('custom-images/offers',$newOfferBrandImage);
            if(isset($request->old_offer_brand_image)){
                unlink('custom-images/offers/'.$request->old_offer_brand_image);
            }
        }else{
            $newOfferBrandImage = $request->old_offer_brand_image;
        }

        if(isset($request->offer_main_category) && isset($request->offer_sub_category)){
            $blogCategoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where(['cat_main_id'=>$request->offer_main_category,'cat_sub_id'=>$request->offer_sub_category])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);

            $catMainName = $blogCategoryData['cat_main_name'];
            $catSubName = $blogCategoryData['cat_sub_name'];

        }else{
            $catMainName = $request->old_offer_main_category;
            $catSubName = $request->old_offer_sub_category;
        }    
        $offerUpdateData =Offers::where("offer_id", $request->id)->update(
            [
                'offer_main_category' => $catMainName,
                'offer_sub_category' => $catSubName,
                'offer_title' => $request->offer_title,
                'offer_company_name' => $request->offer_company_name,
                'offer_country' => $request->offer_country,
                'offer_state' => $request->offer_state,
                'offer_city' => $request->offer_city,

                'offer_start_date' => $request->offer_start_date,
                'offer_start_time' => $request->offer_start_time,
                'offer_end_date' => $request->offer_end_date,
                'offer_end_time' => $request->offer_end_time,
                'offer_detail' => $request->offer_detail,

                'offer_image' => $newOfferImage,
                'offer_brand_image' => $newOfferBrandImage,
                'offer_meta_title' => $request->offer_meta_title,
                'offer_meta_keyword' => $request->offer_meta_keyword,
                'offer_meta_description' => $request->offer_meta_description,
                'offer_t_c' => $request->offer_t_c,
                'offer_changed_timestamp' => CURRENT_DATE_TIME
            ]
        );
        if($offerUpdateData){
            return redirect('user-admin/offerEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('user-admin/offerEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }
}
