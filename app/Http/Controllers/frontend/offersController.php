<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Offers;
use App\Models\CategoryMain;
use App\Models\Mall;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class offersController extends Controller
{
    public function offerHeaderMenu()
    {
        $offerHeaderMenu = Offers::where(['offer_status' => STATUS_ACTIVE])
            ->groupBy('offer_city')
            ->orderBy('offer_id', 'DESC')
            ->get();
        return $offerHeaderMenu;
    }

    public function cityWiseOfferDataHeaderMenu($city){
        //DB::enableQueryLog();
        $cityWiseOfferDataHeaderMenu = DB::table('offers')
        ->select('offers.offer_status','offers.offer_id','offers.offer_mall_id','offers.offer_brand_id', 'offers.offer_title', 'offers.offer_main_category', 'offers.offer_sub_category',
        'offers.offer_title', 'offers.offer_country', 'offers.offer_state', 'offers.offer_city',
        'offers.offer_start_date', 'offers.offer_start_time', 'offers.offer_end_date', 'offers.offer_end_time',
        'offers.offer_detail', 'offers.offer_image', 'offers.offer_meta_title', 'offers.offer_meta_keyword',
        'offers.offer_meta_description','offers.offer_added_timestamp','offers.offer_changed_timestamp',
        'mall.mall_id','mall.mall_name','mall.mall_city','brands.brand_id','brands.brand_name')
        ->join('mall', 'mall.mall_id', '=', 'offers.offer_mall_id')
        ->where(['offers.offer_city' => $city,'offers.offer_status' => STATUS_ACTIVE])
        ->leftjoin('brands', 'brands.brand_id', '=', 'offers.offer_brand_id')
        ->groupBy('mall.mall_city')
        ->orderBy('offers.offer_city', 'ASC')
        ->get();
        //dd(DB::getQueryLog());
        return $cityWiseOfferDataHeaderMenu;
    }


    public function offerListingView($city,$mallName){

        $newCityName = substr($city,9);
        $newMallName = str_replace('-', ' ',$mallName);

        $offerCityWiseMallData = DB::table('offers')
        ->select('offers.offer_status','offers.offer_id','offers.offer_mall_id','offers.offer_brand_id', 'offers.offer_title', 'offers.offer_main_category', 'offers.offer_sub_category',
        'offers.offer_title', 'offers.offer_country', 'offers.offer_state', 'offers.offer_city',
        'offers.offer_start_date', 'offers.offer_start_time', 'offers.offer_end_date', 'offers.offer_end_time',
        'offers.offer_image', 'offers.offer_added_timestamp','mall.mall_id','mall.mall_name','mall.mall_city')
        ->join('mall', 'mall.mall_id', '=', 'offers.offer_mall_id')
        ->where(['offers.offer_city' => $newCityName, 'mall.mall_name' => $newMallName, 'offers.offer_status' => STATUS_ACTIVE])
        ->orderBy('offers.offer_id', 'DESC')
        ->get();

        $mallCityHeaderMenu = (new mallController)->MallCityHeaderMenu();
        $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();
        $couponHeaderMenu = (new couponController)->couponHeaderMenu();

        $recentCityWiseOfferData = DB::table('offers')
        ->select('offers.offer_status','offers.offer_id','offers.offer_mall_id','offers.offer_brand_id', 'offers.offer_title', 'offers.offer_main_category', 'offers.offer_sub_category',
        'offers.offer_title', 'offers.offer_country', 'offers.offer_state', 'offers.offer_city',
        'offers.offer_start_date', 'offers.offer_start_time', 'offers.offer_end_date', 'offers.offer_end_time',
        'offers.offer_image', 'offers.offer_added_timestamp','mall.mall_id','mall.mall_name','mall.mall_city')
        ->join('mall', 'mall.mall_id', '=', 'offers.offer_mall_id')
        ->where(['offers.offer_city' => $newCityName, 'offers.offer_status' => STATUS_ACTIVE])
        ->orderBy('offers.offer_id', 'DESC')
        ->get();

        return view('frontend.offerListing',['offerCityWiseMallData' => $offerCityWiseMallData,
        'recentCityWiseOfferData' =>$recentCityWiseOfferData ,'mallCityHeaderMenu'=>$mallCityHeaderMenu,
        'blogCategoryHeaderMenu'=>$blogCategoryHeaderMenu,'couponHeaderMenu'=> $couponHeaderMenu,
        'offerHeaderMenu' => $this->offerHeaderMenu(),'businessListingHeaderMenu'=>$businessListingHeaderMenu]);
    }


    public function offerDetailView($city,$mallName,$title){

        $newCityName = substr($city,9);
        $newMallName = str_replace('-', ' ',$mallName);
        $newTitle = str_replace('-', ' ',$title);

        $mallCityHeaderMenu = (new mallController)->MallCityHeaderMenu();
        $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();
        $couponHeaderMenu = (new couponController)->couponHeaderMenu();

        $offerSingleData = DB::table('offers')
       ->select('offers.offer_status','offers.offer_id','offers.offer_mall_id','offers.offer_brand_id', 'offers.offer_title', 'offers.offer_main_category', 'offers.offer_sub_category',
       'offers.offer_title', 'offers.offer_country', 'offers.offer_state', 'offers.offer_city',
       'offers.offer_start_date', 'offers.offer_start_time', 'offers.offer_end_date', 'offers.offer_end_time',
       'offers.offer_detail', 'offers.offer_image', 'offers.offer_meta_title', 'offers.offer_meta_keyword',
       'offers.offer_meta_description', 'mall.mall_id','mall_name','brands.brand_id','brands.brand_name')
       ->join('mall', 'mall.mall_id', '=', 'offers.offer_mall_id')
       ->leftjoin('brands', 'brands.brand_id', '=', 'offers.offer_brand_id')
       ->where(['offers.offer_status' => STATUS_ACTIVE,'offers.offer_city' => $newCityName,'mall.mall_name' => $newMallName,'offers.offer_title' => $newTitle])
       ->first();

        if(empty($offerSingleData) && $offerSingleData == '' ){
            return '<img src="'.NOT_FOUND_IMAGE_PATH.'" style=" height: 650px; display: block;margin: auto;">';
        }else{
            // $recentCityWiseOfferData = DB::table('offers')
            // ->select('offers.offer_status','offers.offer_id','offers.offer_mall_id','offers.offer_brand_id', 'offers.offer_title', 'offers.offer_main_category', 'offers.offer_sub_category',
            // 'offers.offer_title', 'offers.offer_country', 'offers.offer_state', 'offers.offer_city',
            // 'offers.offer_start_date', 'offers.offer_start_time', 'offers.offer_end_date', 'offers.offer_end_time',
            // 'offers.offer_image', 'offers.offer_added_timestamp','mall.mall_id','mall.mall_name','mall.mall_city')
            // ->join('mall', 'mall.mall_id', '=', 'offers.offer_mall_id')
            // ->where(['offers.offer_city' => $newCityName, 'offers.offer_status' => STATUS_ACTIVE])
            // ->orderBy('offers.offer_id', 'DESC')
            // ->get();

            return view('frontend.offerDetail',['offerSingleData' => $offerSingleData,'mallCityHeaderMenu'=>$mallCityHeaderMenu,
            'blogCategoryHeaderMenu'=>$blogCategoryHeaderMenu,'couponHeaderMenu'=> $couponHeaderMenu,
            'offerHeaderMenu' => $this->offerHeaderMenu(),'businessListingHeaderMenu'=>$businessListingHeaderMenu]);
        }
    }


    public function offerListView(Request $request)
    {
        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();
       $offerData = DB::table('offers')
        ->select('offers.offer_status','offers.offer_id','offers.offer_user_id','offers.offer_mall_id','offers.offer_brand_id', 'offers.offer_title', 'offers.offer_main_category', 'offers.offer_sub_category',
        'offers.offer_title', 'offers.offer_country', 'offers.offer_state', 'offers.offer_city',
        'offers.offer_start_date', 'offers.offer_start_time', 'offers.offer_end_date', 'offers.offer_end_time',
        'offers.offer_detail', 'offers.offer_image', 'offers.offer_meta_title', 'offers.offer_meta_keyword',
        'offers.offer_meta_description','offers.offer_added_timestamp','offers.offer_changed_timestamp')
        //->join('mall', 'mall.mall_id', '=', 'offers.offer_mall_id')
        ->where(['offers.offer_status' => $request->status,'offer_user_id'=> Auth::user()->id])
        //->leftjoin('brands', 'brands.brand_id', '=', 'offers.offer_brand_id')
        ->orderBy('offer_id', 'DESC')
        ->get();
        return view('frontend.userOfferList',['offerData'=>$offerData,'blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu, 'mallCityHeaderMenu' => $mallCityHeaderMenu, 'couponHeaderMenu' => $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu]);
    }

    public function OfferAddView()
    {
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = 'login';
            </script>";
        }

        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        $mainCategoryData = CategoryMain::where(['cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
        $mallData = Mall::where(['mall_status'=>STATUS_ACTIVE])->orderBy('mall_id', 'DESC')->get();

        return view('user_admin.userOfferAdd', ['blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu, 'mallCityHeaderMenu' => $mallCityHeaderMenu, 'couponHeaderMenu' => $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu,'mainCategoryData'=>$mainCategoryData,'mallData'=>$mallData]);
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
            //'offer_mall_id' => $request->offer_mall_id,
            //'offer_brand_id' => $request->offer_brand_id,
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
            return redirect('/offerAdd')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/offerAdd')->with('message',MSG_ADD_ERROR);
        }
    }


    public function OfferEditView(Request $request)
    {
        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();


        $mainCategoryData = CategoryMain::where(['cat_main_status'=>STATUS_ACTIVE])->orderBy('cat_main_id', 'DESC')->get();
        $mallData = Mall::where(['mall_status'=>STATUS_ACTIVE])->orderBy('mall_id', 'DESC')->get();

       $geOffereData = DB::table('offers')
       ->select('offers.offer_status','offers.offer_id','offers.offer_mall_id','offers.offer_brand_id', 'offers.offer_title', 'offers.offer_main_category', 'offers.offer_sub_category','offers.offer_company_name','offers.offer_brand_image','offers.offer_t_c',
       'offers.offer_title', 'offers.offer_country', 'offers.offer_state', 'offers.offer_city',
       'offers.offer_start_date', 'offers.offer_start_time', 'offers.offer_end_date', 'offers.offer_end_time',
       'offers.offer_detail', 'offers.offer_image', 'offers.offer_meta_title', 'offers.offer_meta_keyword',
       'offers.offer_meta_description')
       //->join('mall', 'mall.mall_id', '=', 'offers.offer_mall_id')
       //->leftjoin('brands', 'brands.brand_id', '=', 'offers.offer_brand_id')
       ->where('offers.offer_id', $request->id)
       ->first();

        return view('frontend.userOfferEdit', ['geOffereData'=>$geOffereData,'blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu, 'mallCityHeaderMenu' => $mallCityHeaderMenu, 'couponHeaderMenu' => $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu,'mainCategoryData'=>$mainCategoryData,'mallData'=>$mallData]);
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

        if($request->hasfile('offer_brand_image'))
        {
            $offerBrandImageFile = $request->file('offer_brand_image');
            $offerBrandImageFileName = $offerBrandImageFile->getClientOriginalName();
            $newOfferBrandImage = time().'.'.$offerBrandImageFileName;
            $offerBrandImageFile->move('custom-images/offers',$newOfferBrandImage);
            if(isset($request->old_offer_brand_image))
            {
                unlink('custom-images/offers/'.$request->old_offer_brand_image);
            }
        }else{
            $newOfferImage = $request->old_offer_brand_image;
        }

        if(isset($request->offer_main_category) && isset($request->offer_sub_category))
        {
            $blogCategoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where(['cat_main_id'=>$request->offer_main_category,'cat_sub_id'=>$request->offer_sub_category])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);

            $catMainName = $blogCategoryData['cat_main_name'];
            $catSubName = $blogCategoryData['cat_sub_name'];

        }else{
            $catMainName = $request->old_offer_main_category;
            $catSubName = $request->old_offer_sub_category;
        }

        // if(isset($request->offer_mall_id) && isset($request->offer_brand_id))
        // {
        //     $offerMallId = $request->offer_mall_id;
        //     $offerBrandId = $request->offer_brand_id;
        // }else{
        //     $offerMallId = $request->old_offer_mall_id;
        //     $offerBrandId = $request->old_offer_brand_id;
        // }

        $offerUpdateData =Offers::where("offer_id", $request->id)->update(
            [
                'offer_main_category' => $catMainName,
                'offer_sub_category' => $catSubName,
                // 'offer_mall_id' => $offerMallId,
                // 'offer_brand_id' => $offerBrandId,

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

                'offer_status' => $request->offer_status,
                'offer_changed_timestamp' => CURRENT_DATE_TIME
            ]
        );
        if($offerUpdateData)
        {
            return redirect('offerEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('offerEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }


}
