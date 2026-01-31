<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\CategoryMain;
use App\Models\CategorySub;
use App\Models\BusinessListing;
use App\Models\BusinessListingImages;
use App\Models\BusinessListingSchedule;
use App\Models\BusinessListingReview;
use App\Http\Controllers\frontend\blogsCategoryController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;
use App\Models\BusinessListingPayment;
use Razorpay\Api\Errors\SignatureVerificationError;
class businessListingController extends Controller
{
    private $razorpayId = 'rzp_test_sHrlNomr69HkXI';
    private $razorpayKey = 'AIlcB3Jn7SSatVIzTIASrCWq';

    public function businessListingHeaderMenu(){
        
        // $businessListingHeaderMenu = BusinessListing::select('bus_id','bus_country')
        //     ->where(['bus_status' => STATUS_ACTIVE])
        //     ->groupBy('bus_country')
        //     ->orderBy('bus_country', 'ASC')
        //     ->toBase()
        //     ->get();

        $businessListingHeaderMenu = BusinessListing::where('bus_status', STATUS_ACTIVE)
            ->distinct()
            ->orderBy('bus_country', 'ASC')
            ->pluck('bus_country');
        return $businessListingHeaderMenu;
    }

    public function blogCategoryHeaderMenu()
    {
        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
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


    public function getTopbusinessListingIndexData(){
        $getbusinessListingIndexData = DB::table('business_listing')
            ->select('bus_id', 'bus_name', 'bus_city', 'bus_main_cat', 'bus_sub_cat', 'bus_address1','bus_contact_no')
            ->where(['bus_status' => STATUS_ACTIVE])
            ->orderBy('bus_added_time', 'ASC')
            ->inRandomOrder()
            ->limit(10)
            ->get();
        return $getbusinessListingIndexData;
    }

        public function getbusinessListingIndexData(){
        $getbusinessListingIndexData = DB::table('business_listing')
            ->select('bus_id', 'bus_name', 'bus_city', 'bus_main_cat', 'bus_sub_cat', 'bus_address1','bus_contact_no')
            ->where(['bus_status' => STATUS_ACTIVE])
            ->orderBy('bus_id', 'DESC')
            ->limit(10)
            ->get();
        return $getbusinessListingIndexData;
    }

    public function businessLisitngPlanView()
    {
        return view('frontend.businessListingPlan', ['blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(), 'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu() ]);
    }

    public function businessLisitngView(Request $request)
    {
         //DB::enableQueryLog();
         $businessCountryName = str_replace('-', ' ', $request->country);
        $businessCountryData = DB::table('business_listing')
            ->select('bus_id', 'bus_country', 'bus_state', 'bus_city')
            ->where(['bus_status' => STATUS_ACTIVE, 'bus_country' => $businessCountryName])
            ->groupBy('bus_state')
            ->get();
            //dd(DB::getQueryLog());
            return view('frontend.businessListing', ['blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(), 'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu(), 'businessDataArray' => $businessCountryData]);
    }

    public function businessLisitngCity($businesCountry, $businesState)
    {
        $businessStateDataArray = DB::table('business_listing')
            ->select('bus_id', 'bus_country', 'bus_state', 'bus_city')
            ->where(['bus_status' => STATUS_ACTIVE, 'bus_country' => $businesCountry, 'bus_state' => $businesState])
            ->groupBy('bus_city')
            ->get();
        return $businessStateDataArray;
    }

    public function businessLisitngAddView()
    {
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../user-admin/login';
            </script>";
        }

        $getUserPalnPaymentCount = BusinessListingPayment::where(['bus_pay_plan_type' => session('planType'),'bus_pay_user_id' => Auth::user()->id])
            ->orderBy('bus_pay_id', 'DESC')
            ->count();

            if($getUserPalnPaymentCount == 0) {
                echo "<script>
                    alert('Please Purchase Plan');
                    window.location.href = 'business-listing';
                </script>";
            }
        $businessMainCategoryData = CategoryMain::where(['cat_main_type' => TYPE_BUSINESS_LISTING, 'cat_main_status' => STATUS_ACTIVE])
            ->orderBy('cat_main_id', 'DESC')
            ->get();

        return view('frontend.businessListingAdd', ['blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(), 'businessMainCategoryData' => $businessMainCategoryData, 'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu()]);
    }

    public function getBusinessSubCategory(Request $request)
    {
        $businessSubCategorySingleData = CategorySub::where(['cat_sub_status' => STATUS_ACTIVE, 'cat_sub_main_id' => $request->catmain_id])
            ->orderBy('cat_sub_id', 'DESC')
            ->get();
        $optionTag = ' <option value="">Select Sub Category</option>';
        foreach ($businessSubCategorySingleData as $businessSubCategorySingleRow) {
            $optionTag .= ' <option value="' . $businessSubCategorySingleRow['cat_sub_id'] . '">' . $businessSubCategorySingleRow['cat_sub_name'] . '</option>';
        }
        echo $optionTag;
    }

    public function businessDetailStore(Request $request)
    {
        $bus_payment_mode = implode(',', $request->bus_payment_mode);
        $bus_payment_que_ans = implode(',', $request->bus_payment_que_ans);

        $businessCategoryData = CategoryMain::join('category_sub', 'category_sub.cat_sub_main_id', '=', 'category_main.cat_main_id')
            ->where(['cat_main_type' => TYPE_BUSINESS_LISTING, 'cat_main_id' => $request->bus_main_cat, 'cat_sub_id' => $request->bus_sub_cat])
            ->orderBy('cat_sub_id', 'DESC')
            ->first(['category_sub.cat_sub_id', 'category_sub.cat_sub_main_id', 'category_sub.cat_sub_name', 'category_main.cat_main_name']);

        $businessListingData = BusinessListing::create([
            'bus_user_id' => $request->bus_user_id,
            'bus_plan_type' => $request->bus_plan_type,
            'bus_name' => $request->bus_name,
            'bus_contact_no' => $request->bus_contact_no,
            'bus_alt_contact_no' => $request->bus_alt_contact_no,
            'bus_email' => $request->bus_email,
            'bus_state' => $request->bus_state,
            'bus_country' => $request->bus_country,
            'bus_city' => $request->bus_city,

            'bus_pin_code' => $request->bus_pin_code,
            'bus_address1' => $request->bus_address1,
            'bus_address2' => $request->bus_address2,
            'bus_start_year' => $request->bus_start_year,
            'bus_main_cat' => $businessCategoryData['cat_main_name'],
            'bus_sub_cat' => $businessCategoryData['cat_sub_name'],
            'bus_product_service' => $request->bus_product_service,
            'bus_desc' => $request->bus_desc,

            'bus_website_url' => $request->bus_website_url,
            'bus_facebook_url' => $request->bus_facebook_url,
            'bus_instagram_url' => $request->bus_instagram_url,
            'bus_twitter_url' => $request->bus_twitter_url,
            'bus_video_url' => $request->bus_video_url,
            'bus_avg_price_range' => $request->bus_avg_price_range,
            'bus_payment_mode' => $bus_payment_mode,
            'bus_punnaka_discount' => $request->bus_punnaka_discount,
            'bus_google_profile_url' => $request->bus_google_profile_url,
            'bus_map_direction_url' => $request->bus_map_direction_url,

            'bus_tags' => $request->bus_tags,
            'bus_location_tags' => $request->bus_location_tags,
            'bus_meta_title' => $request->bus_meta_title,
            'bus_meta_keyword' => $request->bus_meta_keyword,
            'bus_meta_description' => $request->bus_meta_description,
            'bus_payment_que_ans' => $bus_payment_que_ans,
            'bus_status' => STATUS_INACTIVE,
            'bus_multiple_excel_status' => STATUS_INACTIVE,
            'bus_added_time' => CURRENT_DATE_TIME,
        ]);
        $businessLastInsertId = DB::getPdo()->lastInsertId();

        session(['businessListingId' => $businessLastInsertId]);

        if ($businessListingData) {
            if ($request->hasfile('bus_img_log')) {
                foreach ($request->file('bus_img_log') as $file) {
                    $filename = time() . '.' . $file->getClientOriginalName();
                    $file->move('custom-images/business-images/images/', $filename);
                    $file = new BusinessListingImages();
                    $file->bus_img_path = $filename;
                    $file->bus_img_business_id = $businessLastInsertId;
                    $file->bus_img_status = STATUS_ACTIVE;
                    $file->bus_img_type = TYPE_IMAGE;
                    $file->bus_img_added_time = CURRENT_DATE_TIME;
                    $file->save();
                }
            }

            if ($request->hasfile('bus_img_id_proof')) {
                foreach ($request->file('bus_img_id_proof') as $fileIdProof) {
                    $fileNameIdProof = time() . '.' . $fileIdProof->getClientOriginalName();
                    $fileIdProof->move('custom-images/business-images/id-proof/', $fileNameIdProof);
                    $fileIdProof = new BusinessListingImages();
                    $fileIdProof->bus_img_path = $fileNameIdProof;
                    $fileIdProof->bus_img_business_id = $businessLastInsertId;
                    $fileIdProof->bus_img_status = STATUS_ACTIVE;
                    $fileIdProof->bus_img_type = TYPE_ID_PROOF;
                    $fileIdProof->bus_img_added_time = CURRENT_DATE_TIME;
                    $fileIdProof->save();
                }
            }

             $bus_sch_mon_status = $request->bus_sch_mon_status;
            $bus_sch_tue_status = $request->bus_sch_tue_status;
            $bus_sch_wed_status = $request->bus_sch_wed_status;
            $bus_sch_thu_status = $request->bus_sch_thu_status;
            $bus_sch_fri_status = $request->bus_sch_fri_status;
            $bus_sch_sat_status = $request->bus_sch_sat_status;
            $bus_sch_sun_status = $request->bus_sch_sun_status;

            if ($bus_sch_mon_status == 0) {
                $bus_sch_mon_time_status = 0;
                $bus_sch_mon_start = '';
                $bus_sch_mon_end = '';
            } else {
                if ($bus_sch_mon_status == 2) {
                    $bus_sch_mon_start = '';
                    $bus_sch_mon_end = '';
                } else {
                    $bus_sch_mon_time_status = $request->bus_sch_mon_24;
                    $bus_sch_mon_start = $request->bus_sch_mon_start;
                    $bus_sch_mon_end = $request->bus_sch_mon_end;
                }
            }

            if ($bus_sch_tue_status == 0) {
                $bus_sch_tue_time_status = 0;
                $bus_sch_tue_start = '';
                $bus_sch_tue_end = '';
            } else {
                if ($bus_sch_tue_status == 2) {
                    $bus_sch_tue_start = '';
                    $bus_sch_tue_end = '';
                } else {
                    $bus_sch_tue_time_status = $request->bus_sch_tue_24;
                    $bus_sch_tue_start = $request->bus_sch_tue_start;
                    $bus_sch_tue_end = $request->bus_sch_tue_end;
                }
            }

            if ($bus_sch_wed_status == 0) {
                $bus_sch_wed_time_status = 0;
                $bus_sch_wed_start = '';
                $bus_sch_wed_end = '';
            } else {
                if ($bus_sch_wed_status == 2) {
                    $bus_sch_wed_start = '';
                    $bus_sch_wed_end = '';
                } else {
                    $bus_sch_wed_time_status = $request->bus_sch_wed_24;
                    $bus_sch_wed_start = $request->bus_sch_wed_start;
                    $bus_sch_wed_end = $request->bus_sch_wed_end;
                }
            }

            if ($bus_sch_thu_status == 0) {
                $bus_sch_thu_time_status = 0;
                $bus_sch_thu_start = '';
                $bus_sch_thu_end = '';
            } else {
                if ($bus_sch_thu_status == 2) {
                    $bus_sch_thu_start = '';
                    $bus_sch_thu_end = '';
                } else {
                    $bus_sch_thu_time_status = $request->bus_sch_thu_24;
                    $bus_sch_thu_start = $request->bus_sch_thu_start;
                    $bus_sch_thu_end = $request->bus_sch_thu_end;
                }
            }

            if ($bus_sch_fri_status == 0) {
                $bus_sch_fri_time_status = 0;
                $bus_sch_fri_start = '';
                $bus_sch_fri_end = '';
            } else {
                if ($bus_sch_fri_status == 2) {
                    $bus_sch_fri_start = '';
                    $bus_sch_fri_end = '';
                } else {
                    $bus_sch_fri_time_status = $request->bus_sch_fri_24;
                    $bus_sch_fri_start = $request->bus_sch_fri_start;
                    $bus_sch_fri_end = $request->bus_sch_fri_end;
                }
            }

            if ($bus_sch_sat_status == 0) {
                $bus_sch_sat_time_status = 0;
                $bus_sch_sat_start = '';
                $bus_sch_sat_end = '';
            } else {
                if ($bus_sch_sat_status == 2) {
                    $bus_sch_sat_start = '';
                    $bus_sch_sat_end = '';
                } else {
                    $bus_sch_sat_time_status = $request->bus_sch_sat_24;
                    $bus_sch_sat_start = $request->bus_sch_sat_start;
                    $bus_sch_sat_end = $request->bus_sch_sat_end;
                }
            }

            if ($bus_sch_sun_status == 0) {
                $bus_sch_sun_time_status = 0;
                $bus_sch_sun_start = '';
                $bus_sch_sun_end = '';
            } else {
                if ($bus_sch_sun_status == 2) {
                    $bus_sch_sun_start = '';
                    $bus_sch_sun_end = '';
                } else {
                    $bus_sch_sun_time_status = $request->bus_sch_sun_24;
                    $bus_sch_sun_start = $request->bus_sch_sun_start;
                    $bus_sch_sun_end = $request->bus_sch_sun_end;
                }
            }
            
            BusinessListingSchedule::create([
                'bus_sch_business_id' => $businessLastInsertId,
                
                'bus_sch_mon_status' => $bus_sch_mon_status,
                'bus_sch_mon_time_status' => $bus_sch_mon_time_status,
                'bus_sch_mon_start' => $bus_sch_mon_start,
                'bus_sch_mon_end' => $bus_sch_mon_end,

                'bus_sch_tue_status' => $bus_sch_tue_status,
                'bus_sch_tue_time_status' => $bus_sch_tue_time_status,
                'bus_sch_tue_start' => $bus_sch_tue_start,
                'bus_sch_tue_end' => $bus_sch_tue_end,

                'bus_sch_wed_status' => $bus_sch_wed_status,
                'bus_sch_wed_time_status' => $bus_sch_wed_time_status,
                'bus_sch_wed_start' => $bus_sch_wed_start,
                'bus_sch_wed_end' => $bus_sch_wed_end,

                'bus_sch_thu_status' => $bus_sch_thu_status,
                'bus_sch_thu_time_status' => $bus_sch_thu_time_status,
                'bus_sch_thu_start' => $bus_sch_thu_start,
                'bus_sch_thu_end' => $bus_sch_thu_end,

                'bus_sch_fri_status' => $bus_sch_fri_status,
                'bus_sch_fri_time_status' => $bus_sch_fri_time_status,
                'bus_sch_fri_start' => $bus_sch_fri_start,
                'bus_sch_fri_end' => $bus_sch_fri_end,

                'bus_sch_sat_status' => $bus_sch_sat_status,
                'bus_sch_sat_time_status' => $bus_sch_sat_time_status,
                'bus_sch_sat_start' => $bus_sch_sat_start,
                'bus_sch_sat_end' => $bus_sch_sat_end,

                'bus_sch_sun_status' => $bus_sch_sun_status,
                'bus_sch_sun_time_status' => $bus_sch_sun_time_status,
                'bus_sch_sun_start' => $bus_sch_sun_start,
                'bus_sch_sun_end' => $bus_sch_sun_end,

                'bus_sch_added_time' => CURRENT_DATE_TIME,
            ]);
            $msg = 'Your business listing has been submitted successfully!\n\nWe’ve received your details and our review team will verify them soon. You’ll receive an update once it goes live on Punnaka.com.\n\nFor any assistance, WhatsApp us at +91-7875155538 or email us at info@punnaka.com';
            echo "<script>alert(\"$msg\")
            window.location.href='user-admin/dashboard';
            </script>";
            // echo "<script>
            // alert('Greetings of the day!\n 
            // 'Thank you for choosing punnaka.com for business listing. We are delighted to show your business to our audience. Your business listing will be activated on priority! For any queries and questions, email us at info@punnaka.com. After your business listing activation, your business listing will be displayed in the www.punnaka.com – Find Business option menu. To check your business listing, go to www.punnaka.com  - Find Business - Select Country - Click State - Click City'');
            // window.location.href='/';
            // </script>";
            //return redirect('/pay')->with('message', MSG_ADD_SUCCESS);
        } else {
            return redirect('/add-business-details')->with('message', MSG_ADD_ERROR);
        }
    }

    public function businessLisitngCityView(Request $request)
    {
        $businessCityName = str_replace('-', ' ', $request->city);
        $businessCityData = DB::table('business_listing')
            ->select('bus_id', 'bus_country', 'bus_state', 'bus_city', 'bus_main_cat', 'bus_sub_cat')
            ->where(['bus_status' => STATUS_ACTIVE, 'bus_city' => $businessCityName])
            ->groupBy('bus_main_cat')
            ->get();

        return view('frontend.businessListingCity', ['blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(), 'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu(), 'businessCityDataArray' => $businessCityData]);
    }
    public function businessLisitngCityBusinessList($busniessCity, $businessMainCategory)
    {
        $businessSubCatDataArray = DB::table('business_listing')
            ->select('bus_id', 'bus_country', 'bus_state', 'bus_city', 'bus_main_cat', 'bus_sub_cat')
            ->where(['bus_status' => STATUS_ACTIVE, 'bus_city' => $busniessCity, 'bus_main_cat' => $businessMainCategory])
            ->groupBy('bus_sub_cat')
            ->get();
        return $businessSubCatDataArray;
    }

    public function businessLisitngCityView_BK(Request $request)
    {
        $businessCityName = str_replace('-', ' ', $request->city);
        $businessCityDataArray = [];
        $businessCityData = DB::table('business_listing')
            ->select('bus_id', 'bus_country', 'bus_state', 'bus_city', 'bus_main_cat', 'bus_sub_cat')
            ->where(['bus_status' => STATUS_ACTIVE, 'bus_city' => $businessCityName])
            ->groupBy('bus_main_cat')
            ->get();
        foreach ($businessCityData as $businessCityDataRow) {
            $businessCityDataArray[] = $businessCityDataRow;

            $businessSubCatDataArray = DB::table('business_listing')
                ->select('bus_id', 'bus_country', 'bus_state', 'bus_city', 'bus_main_cat', 'bus_sub_cat')
                ->where(['bus_status' => STATUS_ACTIVE, 'bus_city' => $businessCityDataRow->bus_city])
                ->groupBy('bus_city')
                ->get();
        }

        return view('frontend.businessListingCity', ['blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(), 'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu(), 'businessCityDataArray' => $businessCityDataArray, 'businessSubCatDataArray' => $businessSubCatDataArray]);
    }

    public function businessLisitngCategoryView(Request $request)
    {
        $businessCityName = str_replace('-', ' ', $request->city);
        $businessCategoryName = str_replace('-', ' ', $request->category);
       // DB::enableQueryLog();
       // dd(DB::getQueryLog());
        $businessLisitngCategoryArray = BusinessListing::where(['bus_status' => STATUS_ACTIVE, 'bus_city' => $businessCityName, 'bus_sub_cat' => $businessCategoryName])
            ->orderBy('bus_id', 'DESC')
            ->get();

        return view('frontend.businessListingCategory', ['blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(), 'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu(), 'businessLisitngCategoryArray' => $businessLisitngCategoryArray]);
    }

    public function GetBusinessImage($id)
    {
        $imagePath = '';
        $businessLisitngArray = BusinessListingImages::where(['bus_img_type' => TYPE_IMAGE, 'bus_img_business_id' => $id])
            ->orderBy('bus_img_id', 'ASC')
            ->first();
        if(isset($businessLisitngArray['bus_img_path']) && !empty($businessLisitngArray['bus_img_path'])){
            $imagePath = $businessLisitngArray['bus_img_path'];
        }
        return $imagePath;
    }

    public function businessLisitngDetailView(Request $request)
    {
        $businessCityName = str_replace('-', ' ', $request->city);
        $businessCategoryName = str_replace('-', ' ', $request->category);
        $businessName = str_replace('-', ' ', $request->title);

        $businessLisitngDetailArray = BusinessListing::where(['bus_status' => STATUS_ACTIVE, 'bus_city' => $businessCityName, 'bus_sub_cat' => $businessCategoryName, 'bus_name' => $businessName])
            ->with('BusinessListingScheduleData')
            ->orderBy('bus_id', 'DESC')
            ->first();

        // $businessLisitngReview = BusinessListingReview::where(['blr_status' => STATUS_ACTIVE, 'blr_business_listing_id' => $businessLisitngDetailArray->bus_id])
        // ->orderBy('blr_id', 'DESC')
        // ->get();

         $businessLisitngReview = BusinessListingReview::join('users','users.id', '=' , 'business_listing_review.blr_user_id')
         ->where(['blr_status' => STATUS_ACTIVE, 'blr_business_listing_id' => $businessLisitngDetailArray->bus_id])
         ->orderBy('blr_id', 'DESC')
         ->get(['users.name','business_listing_review.blr_star','business_listing_review.blr_review','business_listing_review.blr_adde_time']);

        
        if(empty($businessLisitngDetailArray) && $businessLisitngDetailArray == '' ){
            return '<img src="'.NOT_FOUND_IMAGE_PATH.'" style=" height: 650px; display: block;margin: auto;">';
        }else{
            return view('frontend.businessListingDetail', ['blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(), 'businessListingHeaderMenu' =>  $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu(), 'businessLisitngDetailArray' => $businessLisitngDetailArray,'businessLisitngReview' => $businessLisitngReview]);
        }
    }

    public function getAllBusinessImage($id)
    {
        $allBusinessLisitngImageArray = BusinessListingImages::where(['bus_img_type' => TYPE_IMAGE, 'bus_img_business_id' => $id])
            ->orderBy('bus_img_id', 'ASC')
            ->get();
        return $allBusinessLisitngImageArray;
    }

    public function getLatestBusinessListing($city)
    {
        $getLatestBusinessListingArray = BusinessListing::where(['bus_status' => STATUS_ACTIVE, 'bus_city' => $city])
            ->groupBy('bus_sub_cat')
            ->orderBy('bus_id', 'DESC')
            ->limit(10)
            ->get();
        return $getLatestBusinessListingArray;
    }
    public function businessLisitngPlanSessionSet(Request $request)
    {
        session(['planType' => $request->plan_type]);
        session(['planCurrency' => $request->currency]);
        session(['planAmount' => $request->amount]);
        if(session('planType')){
            
           // return redirect('/add-business-details');
            return redirect('/pay');
        } else {
            return redirect('/business-listing');
        }
    }

    public function businessListingPaymentView(){
        
        $planType = session('planType');
        $planCurrency = session('planCurrency');
        $planAmount = session('planAmount');
        if (isset($planType)) {

            /* if(session('planType') == 'Priority') {
                $planAmount = 1;
                $totalAmount = $planAmount * 100;
            }elseif(session('planType') == 'SEO Optimize') {
                $planAmount = 2;
                $totalAmount = $planAmount * 100;
            }elseif(session('planType') == 'Premium') {
                $planAmount = 5;
                $totalAmount = $planAmount * 100;
            } */
            
            if(session('planType') == 'FL'){
                $planAmount = $planAmount;
                $totalAmount = $planAmount * 100;
            }elseif(session('planType') == 'BL'){
                $planAmount = $planAmount;
                $totalAmount = $planAmount * 100;
            }elseif(session('planType') == 'PSL'){
                $planAmount = $planAmount;
                $totalAmount = $planAmount * 100;
            }elseif(session('planType') == 'OCFL'){
                $planAmount = $planAmount;
                $totalAmount = $planAmount * 100;
            }


        }else{
            echo '<script LANGUAGE="JavaScript">
                window.alert("Please select plan");
                window.location.href = "/business-listing";
            </script>';
            die();
        }
        
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $order = $api->order->create([
            'receipt' => 'order_' . uniqid(),
            'amount' => $totalAmount, 
            'currency' => $planCurrency,
            'payment_capture' => 1
        ]);
        $payment = BusinessListingPayment::create([
           'bus_pay_user_id' => Auth::user()->id,
           'bus_pay_random_id' => $order['id'],
           'bus_pay_plan_type' => $planType,
           'bus_pay_amount' => $planAmount,
           'bus_pay_payment_currency' => $planCurrency,
           'bus_pay_status' => STATUS_INACTIVE,
           'bus_pay_added_time' => CURRENT_DATE_TIME
        ]);    

        return view('frontend.businessListingPayment', ['blogCategoryHeaderMenu' => $this->blogCategoryHeaderMenu(), 'businessListingHeaderMenu' => $this->businessListingHeaderMenu(),'mallCityHeaderMenu' => $this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu(),'orderId' => $order['id']]);
    }

    public function businessListingPaymentProcess(Request $request){
        //echo 'RK_SESSION________'.session('businessPayRandomNumber');

        //dd($request->all());
        $input = $request->all();



        $api = new Api($this->razorpayId, $this->razorpayKey);

        $payment = $api->payment->fetch($request->razorpay_payment_id);

        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $payment->capture(['amount' => $payment['amount']]);
            } catch (\Exception $e) {
                return $e->getMessage();
                return redirect()->back();
            }
        }
                BusinessListingPayment::where("bus_pay_random_id", session('businessPayRandomNumber'))->update(
                [
                    'bus_pay_payment_id' => $request->razorpay_payment_id,
                    'bus_pay_status' => STATUS_ACTIVE,
                    'bus_pay_changed_time' => CURRENT_DATE_TIME,
                ]
            );
        if ($payment) {

            /*  $checkUserRegisterCount = user::where(['contact_no' => $request->user_contact_no,'email' => $request->user_email])
                ->orderBy('id', 'ASC')
                ->count();
                if($checkUserRegisterCount == 0){

                    $user=user::create([
                        'name' => $request->user_name,
                        'email' => $request->user_email,
                        'contact_no' => $request->user_contact_no,
                        'status' => STATUS_INACTIVE,
                        'created_at' => CURRENT_DATE_TIME,
                    ]);
                    Auth::login($user);
                } */

            return response()->json(['success' => 'Payment successful']);
        } else {
            return response()->json(['error' => 'Payment fail']);
        }
    }

    public function businessListingPaymentProcessTemp(Request $request){

        // $checkusinessListingPaymentDataTempCount = BusinessListingPayment::where(['bus_pay_business_id' => $request->business_listing_id])
        //     ->orderBy('bus_pay_id', 'ASC')
        //     ->count();
        //if($checkusinessListingPaymentDataTempCount == 0){

        $randomNumber = random_int(100000, 999999);
        session(['businessPayRandomNumber' => $randomNumber]);

        $businessListingPaymentDataTemp = BusinessListingPayment::create([
            'bus_pay_user_id' => Auth::user()->id,
            'bus_pay_random_id' => $randomNumber,
            'bus_pay_plan_type' => $request->plan_type,
            'bus_pay_amount' => $request->plan_amount,
            'bus_pay_payment_currency' => $request->plan_currency,
            'bus_pay_user_name' => $request->user_name,
            'bus_pay_user_email' => $request->user_email,
            'bus_pay_user_contact_no' => $request->user_contact_no,
            'bus_pay_user_business_name' => $request->user_business_name,
            'bus_pay_status' => STATUS_INACTIVE,
            'bus_pay_added_time' => CURRENT_DATE_TIME,
        ]);

        /*$checkUserRegisterCount = user::where(['email' => $request->user_email])
        ->orderBy('id', 'ASC')
        ->count();
        if($checkUserRegisterCount == 0){

            $user = user::create([
                'name' => $request->user_name,
                'email' => $request->user_email,
                'contact_no' => $request->user_contact_no,
                'status' => STATUS_INACTIVE,
                'created_at' => CURRENT_DATE_TIME,
            ]);
            Auth::login($user);


        }else{
            return response()->json(['success' => 'Already Registered']);
        }*/

        if ($businessListingPaymentDataTemp) {
            return response()->json(['success' => 'Payment successful','uniqueNumber' => $randomNumber]);
        } else {
            return response()->json(['error' => 'Payment fail']);
        }
    }

    public function checkPlanPurchaseStatus(Request $request){
        $getUserPalnPaymentCount = BusinessListingPayment::where(['bus_pay_plan_type' => $request->planType,'bus_pay_user_id' => Auth::user()->id])
        ->orderBy('bus_pay_id', 'DESC')
        ->count();

        if($getUserPalnPaymentCount == 0) {
            echo "<script>
                alert('Please Purchase Plan ".$request->planType."');
                window.location.href = '../business-listing';
            </script>";
        }else{
            session(['planType' => $request->planType]);
            echo "<script>
            window.location.href = '../add-business-details';
        </script>";
        }
    }

    public function businessListingView(Request $request){
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../user-admin/login';
            </script>";
        }

        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        $userBusinessListingArray = BusinessListing::where(['bus_status' => $request->status,'bus_user_id' => Auth::user()->id])
            ->orderBy('bus_id', 'DESC')
            ->get();

        return view('frontend.userBusinessListing', ['userBusinessListingArray' => $userBusinessListingArray, 'blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu, 'mallCityHeaderMenu' => $mallCityHeaderMenu, 'couponHeaderMenu' => $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu]);
    }

    public function businessListingEditView(Request $request){
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../user-admin/login';
            </script>";
        }

        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        $businessMainCategoryData = CategoryMain::where(['cat_main_type' => TYPE_BUSINESS_LISTING, 'cat_main_status' => STATUS_ACTIVE])
            ->orderBy('cat_main_id', 'DESC')
            ->get();

        $businessListingEditData = BusinessListing::where(['bus_id' => $request->id,'bus_user_id' => Auth::user()->id])
            ->first();

        return view('frontend.userBusinessListingEdit', ['businessListingEditData' => $businessListingEditData,'businessMainCategoryData'=>$businessMainCategoryData,'blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu, 'mallCityHeaderMenu' => $mallCityHeaderMenu, 'couponHeaderMenu' => $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu]);
    }

    public function businessListingDetailUpdate(Request $request){
        if(isset($request->bus_main_cat) && isset($request->bus_sub_cat))
        {
            $businessCategoryData = CategoryMain::join('category_sub','category_sub.cat_sub_main_id', '=' , 'category_main.cat_main_id')->where(['cat_main_type'=>TYPE_BUSINESS_LISTING, 'cat_main_id'=>$request->bus_main_cat,'cat_sub_id'=>$request->bus_sub_cat])->orderBy('cat_sub_id', 'DESC')->first(['category_sub.cat_sub_id','category_sub.cat_sub_main_id','category_sub.cat_sub_name','category_main.cat_main_name']);

            $catMainName = $businessCategoryData['cat_main_name'];
            $catSubName = $businessCategoryData['cat_sub_name'];

        }else{
            $catMainName = $request->old_bus_main_cat;
            $catSubName = $request->old_bus_sub_cat;
        }


        if(isset($request->bus_payment_mode) && !empty($request->bus_payment_mode)){
            $bus_payment_mode = implode(',', $request->bus_payment_mode);
        }
        else{
            $bus_payment_mode = $request->old_bus_payment_mode;
        }

        if(isset($request->bus_payment_que_ans) && !empty($request->bus_payment_que_ans)){
            $bus_payment_que_ans = implode(',', $request->bus_payment_que_ans);
        }
        else{
            $bus_payment_que_ans = $request->old_bus_payment_que_ans;
        }
        $businessUpdateData =BusinessListing::where("bus_id", $request->id)->update(
            [
                'bus_main_cat' => $catMainName,
                'bus_sub_cat' => $catSubName,
                'bus_name' => $request->bus_name,
                'bus_contact_no' => $request->bus_contact_no,
                'bus_alt_contact_no' => $request->bus_alt_contact_no,
                'bus_email' => $request->bus_email,
                'bus_country' => $request->bus_country,
                'bus_state' => $request->bus_state,
                'bus_city' => $request->bus_city,
                'bus_pin_code' => $request->bus_pin_code,
                'bus_address1' => $request->bus_address1,
                'bus_address2' => $request->bus_address2,

                'bus_start_year' => $request->bus_start_year,
                'bus_website_url' => $request->bus_website_url,
                'bus_facebook_url' => $request->bus_facebook_url,
                'bus_instagram_url' => $request->bus_instagram_url,
                'bus_twitter_url' => $request->bus_twitter_url,
                'bus_video_url' => $request->bus_video_url,
                'bus_payment_mode' => $bus_payment_mode,
                'bus_google_profile_url' => $request->bus_google_profile_url,
                'bus_map_direction_url' => $request->bus_map_direction_url,

                'bus_punnaka_discount' => $request->bus_punnaka_discount,
                'bus_avg_price_range' => $request->bus_avg_price_range,
                'bus_product_service' => $request->bus_product_service,
                'bus_desc' => $request->bus_desc,
                'bus_tags' => $request->bus_tags,
                'bus_location_tags' => $request->bus_location_tags,
                'bus_meta_title' => $request->bus_meta_title,
                'bus_meta_keyword' => $request->bus_meta_keyword,
                'bus_meta_description' => $request->bus_meta_description,
                'bus_payment_que_ans' => $bus_payment_que_ans,
                'bus_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($businessUpdateData)
        {
            return redirect('businessListingEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('businessListingEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }

    public function businessListingTimingEditView(Request $request){
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../user-admin/login';
            </script>";
        }

        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        $businessTimingData = BusinessListingSchedule::join('business_listing','business_listing.bus_id', '=' , 'business_listing_schedule.bus_sch_business_id')->where(['bus_sch_business_id'=>$request->id,'bus_user_id' => Auth::user()->id])->first([
            'business_listing.bus_id','business_listing.bus_user_id','business_listing.bus_name','business_listing.bus_contact_no',
            'business_listing_schedule.bus_sch_id','business_listing_schedule.bus_sch_business_id','business_listing_schedule.bus_sch_mon_status','business_listing_schedule.bus_sch_mon_start','business_listing_schedule.bus_sch_mon_end','business_listing_schedule.bus_sch_tue_status','business_listing_schedule.bus_sch_tue_start','business_listing_schedule.bus_sch_tue_end','business_listing_schedule.bus_sch_wed_status','business_listing_schedule.bus_sch_wed_start','business_listing_schedule.bus_sch_wed_end','business_listing_schedule.bus_sch_thu_status','business_listing_schedule.bus_sch_thu_start','business_listing_schedule.bus_sch_thu_end','business_listing_schedule.bus_sch_fri_status','business_listing_schedule.bus_sch_fri_start','business_listing_schedule.bus_sch_fri_end','business_listing_schedule.bus_sch_sat_status','business_listing_schedule.bus_sch_sat_start','business_listing_schedule.bus_sch_sat_end','business_listing_schedule.bus_sch_sat_end','business_listing_schedule.bus_sch_sun_status','business_listing_schedule.bus_sch_sun_start','business_listing_schedule.bus_sch_sun_end',
            'business_listing_schedule.bus_sch_sun_time_status','business_listing_schedule.bus_sch_mon_time_status','business_listing_schedule.bus_sch_tue_time_status','business_listing_schedule.bus_sch_wed_time_status','business_listing_schedule.bus_sch_thu_time_status','business_listing_schedule.bus_sch_fri_time_status','business_listing_schedule.bus_sch_sat_time_status'
                ]);

            return view('frontend.userBusinessListingTimingEdit', ['businessTimingData' => $businessTimingData,'blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu, 'mallCityHeaderMenu' => $mallCityHeaderMenu, 'couponHeaderMenu' => $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu]);
    }

    public function businessListingTimingUpdate(Request $request){

        $bus_sch_mon_status = $request->bus_sch_mon_status;
        $bus_sch_tue_status = $request->bus_sch_tue_status;
        $bus_sch_wed_status = $request->bus_sch_wed_status;
        $bus_sch_thu_status = $request->bus_sch_thu_status;
        $bus_sch_fri_status = $request->bus_sch_fri_status;
        $bus_sch_sat_status = $request->bus_sch_sat_status;
        $bus_sch_sun_status = $request->bus_sch_sun_status;

        if ($bus_sch_mon_status == 0) {
            $bus_sch_mon_time_status = 0;
            $bus_sch_mon_start = '';
            $bus_sch_mon_end = '';
        } else {
            if ($bus_sch_mon_status == 2) {
                $bus_sch_mon_start = '';
                $bus_sch_mon_end = '';
            } else {
                $bus_sch_mon_time_status = $request->bus_sch_mon_24;
                $bus_sch_mon_start = $request->bus_sch_mon_start;
                $bus_sch_mon_end = $request->bus_sch_mon_end;
            }
        }

        if ($bus_sch_tue_status == 0) {
            $bus_sch_tue_time_status = 0;
            $bus_sch_tue_start = '';
            $bus_sch_tue_end = '';
        } else {
            if ($bus_sch_tue_status == 2) {
                $bus_sch_tue_start = '';
                $bus_sch_tue_end = '';
            } else {
                $bus_sch_tue_time_status = $request->bus_sch_tue_24;
                $bus_sch_tue_start = $request->bus_sch_tue_start;
                $bus_sch_tue_end = $request->bus_sch_tue_end;
            }
        }

        if ($bus_sch_wed_status == 0) {
            $bus_sch_wed_time_status = 0;
            $bus_sch_wed_start = '';
            $bus_sch_wed_end = '';
        } else {
            if ($bus_sch_wed_status == 2) {
                $bus_sch_wed_start = '';
                $bus_sch_wed_end = '';
            } else {
                $bus_sch_wed_time_status = $request->bus_sch_wed_24;
                $bus_sch_wed_start = $request->bus_sch_wed_start;
                $bus_sch_wed_end = $request->bus_sch_wed_end;
            }
        }

        if ($bus_sch_thu_status == 0) {
            $bus_sch_thu_time_status = 0;
            $bus_sch_thu_start = '';
            $bus_sch_thu_end = '';
        } else {
            if ($bus_sch_thu_status == 2) {
                $bus_sch_thu_start = '';
                $bus_sch_thu_end = '';
            } else {
                $bus_sch_thu_time_status = $request->bus_sch_thu_24;
                $bus_sch_thu_start = $request->bus_sch_thu_start;
                $bus_sch_thu_end = $request->bus_sch_thu_end;
            }
        }

        if ($bus_sch_fri_status == 0) {
            $bus_sch_fri_time_status = 0;
            $bus_sch_fri_start = '';
            $bus_sch_fri_end = '';
        } else {
            if ($bus_sch_fri_status == 2) {
                $bus_sch_fri_start = '';
                $bus_sch_fri_end = '';
            } else {
                $bus_sch_fri_time_status = $request->bus_sch_fri_24;
                $bus_sch_fri_start = $request->bus_sch_fri_start;
                $bus_sch_fri_end = $request->bus_sch_fri_end;
            }
        }

        if ($bus_sch_sat_status == 0) {
            $bus_sch_sat_time_status = 0;
            $bus_sch_sat_start = '';
            $bus_sch_sat_end = '';
        } else {
            if ($bus_sch_sat_status == 2) {
                $bus_sch_sat_start = '';
                $bus_sch_sat_end = '';
            } else {
                $bus_sch_sat_time_status = $request->bus_sch_sat_24;
                $bus_sch_sat_start = $request->bus_sch_sat_start;
                $bus_sch_sat_end = $request->bus_sch_sat_end;
            }
        }

        if ($bus_sch_sun_status == 0) {
            $bus_sch_sun_time_status = 0;
            $bus_sch_sun_start = '';
            $bus_sch_sun_end = '';
        } else {
            if ($bus_sch_sun_status == 2) {
                $bus_sch_sun_start = '';
                $bus_sch_sun_end = '';
            } else {
                $bus_sch_sun_time_status = $request->bus_sch_sun_24;
                $bus_sch_sun_start = $request->bus_sch_sun_start;
                $bus_sch_sun_end = $request->bus_sch_sun_end;
            }
        }

        $businessListingTimingUpdateData =BusinessListingSchedule::where("bus_sch_id", $request->id)->update([
            'bus_sch_mon_status' => $bus_sch_mon_status,
            'bus_sch_mon_time_status' => $bus_sch_mon_time_status,
            'bus_sch_mon_start' => $bus_sch_mon_start,
            'bus_sch_mon_end' => $bus_sch_mon_end,

            'bus_sch_tue_status' => $bus_sch_tue_status,
            'bus_sch_tue_time_status' => $bus_sch_tue_time_status,
            'bus_sch_tue_start' => $bus_sch_tue_start,
            'bus_sch_tue_end' => $bus_sch_tue_end,

            'bus_sch_wed_status' => $bus_sch_wed_status,
            'bus_sch_wed_time_status' => $bus_sch_wed_time_status,
            'bus_sch_wed_start' => $bus_sch_wed_start,
            'bus_sch_wed_end' => $bus_sch_wed_end,

            'bus_sch_thu_status' => $bus_sch_thu_status,
            'bus_sch_thu_time_status' => $bus_sch_thu_time_status,
            'bus_sch_thu_start' => $bus_sch_thu_start,
            'bus_sch_thu_end' => $bus_sch_thu_end,

            'bus_sch_fri_status' => $bus_sch_fri_status,
            'bus_sch_fri_time_status' => $bus_sch_fri_time_status,
            'bus_sch_fri_start' => $bus_sch_fri_start,
            'bus_sch_fri_end' => $bus_sch_fri_end,

            'bus_sch_sat_status' => $bus_sch_sat_status,
            'bus_sch_sat_time_status' => $bus_sch_sat_time_status,
            'bus_sch_sat_start' => $bus_sch_sat_start,
            'bus_sch_sat_end' => $bus_sch_sat_end,

            'bus_sch_sun_status' => $bus_sch_sun_status,
            'bus_sch_sun_time_status' => $bus_sch_sun_time_status,
            'bus_sch_sun_start' => $bus_sch_sun_start,
            'bus_sch_sun_end' => $bus_sch_sun_end,
            'bus_sch_changed_time' => CURRENT_DATE_TIME

            ]);
        if($businessListingTimingUpdateData)
        {
            return redirect('businessListingTimingEdit/'.$request->bus_sch_business_id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('businessListingTimingEdit/'.$request->bus_sch_business_id)->with('message',MSG_UPDATE_ERROR);
        }
    }

    public function businessListingImageEditView(Request $request)
    {
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../user-admin/login';
            </script>";
        }

        $blogCategoryHeaderMenu = (new blogsCategoryController())->blogCategoryHeaderMenu();
        $businessListingHeaderMenu = (new businessListingController())->businessListingHeaderMenu();
        $mallCityHeaderMenu = (new mallController())->MallCityHeaderMenu();
        $couponHeaderMenu = (new couponController())->couponHeaderMenu();
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();

        $businessLogoImagesData = BusinessListingImages::where(['bus_img_type'=>TYPE_IMAGE,'bus_img_business_id'=> $request->id])->orderBy('bus_img_id', 'DESC')->get();
        $businessoIdProofImagesData = BusinessListingImages::where(['bus_img_type'=>TYPE_ID_PROOF,'bus_img_business_id'=> $request->id])->orderBy('bus_img_id', 'DESC')->get();

        return view('frontend.userBusinessListingImageEdit', ['businessLogoImagesData' => $businessLogoImagesData,'businessoIdProofImagesData' => $businessoIdProofImagesData,'blogCategoryHeaderMenu' => $blogCategoryHeaderMenu, 'businessListingHeaderMenu' => $businessListingHeaderMenu, 'mallCityHeaderMenu' => $mallCityHeaderMenu, 'couponHeaderMenu' => $couponHeaderMenu, 'offerHeaderMenu'=>$offerHeaderMenu]);
    }

    public function userBusinessListingImagesLogoStore(Request $request)
    {
        if ($request->hasfile('bus_img_log')) {
            foreach ($request->file('bus_img_log') as $file) {
                $filename = time() . '.' . $file->getClientOriginalName();
                $file->move('custom-images/business-images/images/', $filename);
                $file = new BusinessListingImages();
                $file->bus_img_path = $filename;
                $file->bus_img_business_id = $request->id;
                $file->bus_img_status = STATUS_ACTIVE;
                $file->bus_img_type = TYPE_IMAGE;
                $file->bus_img_added_time = CURRENT_DATE_TIME;
                $file->save();
            }
            return redirect('/businessListingImageEdit/'.$request->id)->with('message', MSG_ADD_SUCCESS);
        } else {
            return redirect('/businessListingImageEdit/'.$request->id)->with('message', MSG_ADD_ERROR);
        }
    }

    public function userBusinessListingImagesIDProodStore(Request $request){
        if ($request->hasfile('bus_img_id_proof')) {
            foreach ($request->file('bus_img_id_proof') as $fileIdProof) {
                $fileNameIdProof = time() . '.' . $fileIdProof->getClientOriginalName();
                $fileIdProof->move('custom-images/business-images/id-proof/', $fileNameIdProof);
                $fileIdProof = new BusinessListingImages();
                $fileIdProof->bus_img_path = $fileNameIdProof;
                $fileIdProof->bus_img_business_id = $request->id;
                $fileIdProof->bus_img_status = STATUS_ACTIVE;
                $fileIdProof->bus_img_type = TYPE_ID_PROOF;
                $fileIdProof->bus_img_added_time = CURRENT_DATE_TIME;
                $fileIdProof->save();
            }
            return redirect('/businessListingImageEdit/'.$request->id)->with('message', MSG_ADD_SUCCESS);
        } else {
            return redirect('/businessListingImageEdit/'.$request->id)->with('message', MSG_ADD_ERROR);
        }
    }

    public function userBusinessListingImagesDelete(Request $request){
        $BusinessListingImagesArray = BusinessListingImages::where(['bus_img_id'=>$request->id]);
        $BusinessListingImagesArray->delete();
        if($request->type == 'LOGO'){
            $imagePath = 'custom-images/business-images/images/'.$request->path;
        }else{
            $imagePath = 'custom-images/business-images/id-proof/'.$request->path;
        }

        if(file_exists($imagePath)){
            unlink($imagePath);
        }
        return redirect('/businessListingImageEdit/'.$request->business_id)->with('msg', 'Record deleted successfully');
    }


    public function paymentSuccess(Request $request){
        if(!$request->razorpay_payment_id || !$request->razorpay_order_id) {
            return back()->with('error', 'Payment failed. Please try again.');
        }
        $payment = BusinessListingPayment::where("bus_pay_random_id", $request->razorpay_order_id)->update([
            'bus_pay_payment_id' => $request->razorpay_payment_id,
            'bus_pay_status' => STATUS_ACTIVE,
            'bus_pay_changed_time' => CURRENT_DATE_TIME,
        ]);
        if($payment){
            $planType = session('planType');
            if($planType == 'FL'){
                $redirect = '/user-admin/franchiseAdd';
            }elseif($planType == 'BL'){
                $redirect = '/add-business-details';
            }elseif($planType == 'PSL'){
                $redirect = '/user-admin/productServiceAdd';
            }elseif($planType == 'OCFL'){
                $redirect = '/user-admin/couponOfferAdd';
            }else{
                $redirect = '/';
            }
            return redirect($redirect)->with([
            'success' => 'Payment Successful!',
            'payment' => $payment
        ]);    
        }else{
            return redirect('/')->with([ 'failed' => 'Payment Failed']);
        }
    }

    public function businessListingReviewStore(Request $request){
        $business_city = $request->business_city;
        $business_category = $request->business_category;
        $business_title = $request->business_title;

         $businessListingReview = BusinessListingReview::create([
            'blr_user_id' => Auth::user()->id,
            'blr_business_listing_id' => $request->blr_business_listing_id,
            'blr_star' => $request->blr_star,
            'blr_review' => $request->blr_review,
            'blr_status' => STATUS_ACTIVE,
            'blr_adde_time' => CURRENT_DATE_TIME,
        ]);
        
        if($businessListingReview) {

            $url = url('/detail/'.$business_city.'/'.$business_category.'/'.$business_title.'/');

            echo "<script LANGUAGE='JavaScript'>
            window.alert('Thank you! Your review has been submitted for approval....!!');
            window.location.href = '$url';
            </script>";

        }else{
            return redirect('/detail/'.$business_city.'/'.$business_category.'/'.$business_title.'/')->with('message', MSG_ADD_ERROR);
        }
    }
}
