<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessListing;
use App\Models\BusinessListingImages;
use App\Models\BusinessListingSchedule;
use App\Models\BusinessListingPayment;
use App\Models\BusinessListingReview;
use App\Models\CategoryMain;
use App\Models\CategorySub;
use Excel;
use App\Exports\businessListingExport;
use App\Imports\businessListingImport;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Helper\Downloader;

use function PHPUnit\Framework\at;

class adminBusinessListingController extends Controller
{
    public function businessListingReviewView(Request $request){

    $businessListingReviewData = DB::table('business_listing_review')
    ->leftJoin('business_listing', 'business_listing_review.blr_business_listing_id', '=', 'business_listing.bus_id')
    ->leftJoin('users', 'business_listing_review.blr_user_id', '=', 'users.id')
    ->where(['business_listing_review.blr_business_listing_id' => $request->id])
    ->select('business_listing_review.*', 'business_listing.bus_name', 'users.name')
    ->get();

        return view('admin.businessListingReviewList', ['businessListingReviewData' => $businessListingReviewData]);
    }
    
    public function businessListingAddView()
    {
        $userData = User::select('id', 'name')
            ->where(['status' => STATUS_ACTIVE])
            ->orderBy('id', 'DESC')
            ->get();

        $businessMainCategoryData = CategoryMain::where(['cat_main_type' => TYPE_BUSINESS_LISTING, 'cat_main_status' => STATUS_ACTIVE])
            ->orderBy('cat_main_id', 'DESC')
            ->get();

        return view('admin.businessListingAdd', ['businessMainCategoryData' => $businessMainCategoryData, 'userData' => $userData]);
    }

    public function businessListingStore(Request $request)
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
            // echo "RK____ ".$request->bus_sch_sun_24;
            // dd($request->all());

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
            return redirect('admin/businessListingAdd')->with('message', MSG_ADD_SUCCESS);
        } else {
            return redirect('admin/businessListingAdd')->with('message', MSG_ADD_ERROR);
        }
    }

    public function businessListingListView()
    {
        //DB::enableQueryLog();
        // $allBusinessListingArray = BusinessListing::join('users', 'users.id', '=', 'business_listing.bus_user_id')
        //     ->orderBy('bus_id', 'desc')
        //     ->get(['users.name', 'business_listing.bus_id', 'business_listing.bus_name', 'business_listing.bus_contact_no', 'business_listing.bus_status', 'business_listing.bus_user_id', 'business_listing.bus_email', 'business_listing.bus_added_time', 'business_listing.bus_changed_time']);

        $allBusinessListingArray = BusinessListing::orderBy('bus_id', 'desc')->get();

        //dd(DB::getQueryLog());
        return view('admin.businessListingList', ['allBusinessListingArray' => $allBusinessListingArray]);
    }

    public function businessListingEditView(Request $request)
    {
        $businessListingMainArray = CategoryMain::where(['cat_main_type' => TYPE_BUSINESS_LISTING, 'cat_main_status' => STATUS_ACTIVE])
            ->orderBy('cat_main_id', 'DESC')
            ->get();

        $businessListingEditData = BusinessListing::where(['bus_id' => $request->id])->first();

        // $businessListingEditData = BusinessListing::join('users', 'users.id', '=', 'business_listing.bus_user_id')
        //     ->where('bus_id',$request->id)
        //     ->orderBy('bus_id', 'desc')
        //     ->first();

        return view('admin.businessListingEdit', ['businessListingEditData' => $businessListingEditData, 'businessListingMainArray' => $businessListingMainArray]);
    }

    public function businessListingUpdate(Request $request)
    {
        if (isset($request->bus_main_cat) && isset($request->bus_sub_cat)) {
            $businessCategoryData = CategoryMain::join('category_sub', 'category_sub.cat_sub_main_id', '=', 'category_main.cat_main_id')
                ->where(['cat_main_type' => TYPE_BUSINESS_LISTING, 'cat_main_id' => $request->bus_main_cat, 'cat_sub_id' => $request->bus_sub_cat])
                ->orderBy('cat_sub_id', 'DESC')
                ->first(['category_sub.cat_sub_id', 'category_sub.cat_sub_main_id', 'category_sub.cat_sub_name', 'category_main.cat_main_name']);

            $catMainName = $businessCategoryData['cat_main_name'];
            $catSubName = $businessCategoryData['cat_sub_name'];
        } else {
            $catMainName = $request->old_bus_main_cat;
            $catSubName = $request->old_bus_sub_cat;
        }

        if (isset($request->old_bus_payment_mode) && empty($request->bus_payment_mode)) {
            $bus_payment_mode = $request->old_bus_payment_mode;
        } else {
            $bus_payment_mode = implode(',', $request->bus_payment_mode);
        }
        $businessUpdateData = BusinessListing::where('bus_id', $request->id)->update([
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
            'bus_punnaka_discount' => $request->bus_punnaka_discount,
            'bus_avg_price_range' => $request->bus_avg_price_range,
            'bus_product_service' => $request->bus_product_service,
            'bus_desc' => $request->bus_desc,
            'bus_tags' => $request->bus_tags,
            'bus_location_tags' => $request->bus_location_tags,
            'bus_google_profile_url' => $request->bus_google_profile_url,
            'bus_map_direction_url' => $request->bus_map_direction_url,
            'bus_meta_title' => $request->bus_meta_title,
            'bus_meta_keyword' => $request->bus_meta_keyword,
            'bus_meta_description' => $request->bus_meta_description,
            'bus_status' => $request->bus_status,
            'bus_admin_comment' => $request->bus_admin_comment,
            'bus_changed_time' => CURRENT_DATE_TIME,
        ]);
        if ($businessUpdateData) {
            return redirect('admin/businessListingEdit/' . $request->id)->with('message', MSG_UPDATE_SUCCESS);
        } else {
            return redirect('admin/businessListingEdit/' . $request->id)->with('message', MSG_UPDATE_ERROR);
        }
    }

    public function businessListingTimingEditView(Request $request)
    {
        $businessTimingData = BusinessListing::leftJoin('business_listing_schedule', 'business_listing.bus_id', '=', 'business_listing_schedule.bus_sch_business_id')
            ->where('business_listing.bus_id', $request->id)
            ->first([
                'business_listing.bus_id',
                'business_listing.bus_name',
                'business_listing.bus_contact_no',
                'business_listing_schedule.bus_sch_id',
                'business_listing_schedule.bus_sch_business_id',
                'business_listing_schedule.bus_sch_mon_status',
                'business_listing_schedule.bus_sch_mon_start',
                'business_listing_schedule.bus_sch_mon_end',
                'business_listing_schedule.bus_sch_tue_status',
                'business_listing_schedule.bus_sch_tue_start',
                'business_listing_schedule.bus_sch_tue_end',
                'business_listing_schedule.bus_sch_wed_status',
                'business_listing_schedule.bus_sch_wed_start',
                'business_listing_schedule.bus_sch_wed_end',
                'business_listing_schedule.bus_sch_thu_status',
                'business_listing_schedule.bus_sch_thu_start',
                'business_listing_schedule.bus_sch_thu_end',
                'business_listing_schedule.bus_sch_fri_status',
                'business_listing_schedule.bus_sch_fri_start',
                'business_listing_schedule.bus_sch_fri_end',
                'business_listing_schedule.bus_sch_sat_status',
                'business_listing_schedule.bus_sch_sat_start',
                'business_listing_schedule.bus_sch_sat_end',
                'business_listing_schedule.bus_sch_sat_end',
                'business_listing_schedule.bus_sch_sun_status',
                'business_listing_schedule.bus_sch_sun_start',
                'business_listing_schedule.bus_sch_sun_end',
                'business_listing_schedule.bus_sch_sun_time_status',
                'business_listing_schedule.bus_sch_mon_time_status',
                'business_listing_schedule.bus_sch_tue_time_status',
                'business_listing_schedule.bus_sch_wed_time_status',
                'business_listing_schedule.bus_sch_thu_time_status',
                'business_listing_schedule.bus_sch_fri_time_status',
                'business_listing_schedule.bus_sch_sat_time_status',
            ]);
        return view('admin.businessListingTimingEdit', ['businessTimingData' => $businessTimingData]);
    }

    public function businessListingTimingAdd(Request $request)
    {
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

        $businessListingTimingInsertData = BusinessListingSchedule::create([
            'bus_sch_business_id' => $request->bus_sch_business_id,
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

            'bus_sch_changed_time' => CURRENT_DATE_TIME,
        ]);
        if ($businessListingTimingInsertData) {
            return redirect('admin/businessListingTimingEdit/' . $request->bus_sch_business_id)->with('message', MSG_ADD_SUCCESS);
        } else {
            return redirect('admin/businessListingTimingEdit/' . $request->bus_sch_business_id)->with('message', MSG_ADD_ERROR);
        }
    }

    public function businessListingTimingUpdate(Request $request)
    {
        //dd($request->all());
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

        $businessListingTimingUpdateData = BusinessListingSchedule::where('bus_sch_id', $request->id)->update([
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

            'bus_sch_changed_time' => CURRENT_DATE_TIME,
        ]);
        if ($businessListingTimingUpdateData) {
            return redirect('admin/businessListingTimingEdit/' . $request->bus_sch_business_id)->with('message', MSG_UPDATE_SUCCESS);
        } else {
            return redirect('admin/businessListingTimingEdit/' . $request->bus_sch_business_id)->with('message', MSG_UPDATE_ERROR);
        }
    }

    public function businessListingImagesEditView(Request $request)
    {
        $businessLogoImagesArray = BusinessListingImages::where(['bus_img_type' => TYPE_IMAGE, 'bus_img_business_id' => $request->id])
            ->orderBy('bus_img_id', 'DESC')
            ->get();

        $businessoIdProofImagesArray = BusinessListingImages::where(['bus_img_type' => TYPE_ID_PROOF, 'bus_img_business_id' => $request->id])
            ->orderBy('bus_img_id', 'DESC')
            ->get();

        $businessLisitingData = BusinessListing::select('bus_id', 'bus_name', 'bus_contact_no')
            ->where(['bus_id' => $request->id])
            ->first();
        return view('admin.businessListingImagesEdit', ['businessLogoImagesArray' => $businessLogoImagesArray, 'businessoIdProofImagesArray' => $businessoIdProofImagesArray, 'businessLisitingData' => $businessLisitingData]);
    }

    public function businessListingImagesLogoStore(Request $request)
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
            return redirect('/admin/businessListingImagesEdit/' . $request->id)->with('message', MSG_ADD_SUCCESS);
        } else {
            return redirect('/admin/businessListingImagesEdit/' . $request->id)->with('message', MSG_ADD_ERROR);
        }
    }
    public function businessListingImagesIDProodStore(Request $request)
    {
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
            return redirect('/admin/businessListingImagesEdit/' . $request->id)->with('message', MSG_ADD_SUCCESS);
        } else {
            return redirect('/admin/businessListingImagesEdit/' . $request->id)->with('message', MSG_ADD_ERROR);
        }
    }

    public function businessListingImagesDelete(Request $request)
    {
        $BusinessListingImagesArray = BusinessListingImages::where(['bus_img_id' => $request->id]);

        $BusinessListingImagesArray->delete();
        if ($request->type == 'LOGO') {
            $imagePath = 'custom-images/business-images/images/' . $request->path;
        } else {
            $imagePath = 'custom-images/business-images/id-proof/' . $request->path;
        }

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        return redirect('/admin/businessListingImagesEdit/' . $request->business_id)->with('msg', 'Record deleted successfully');
    }

    public function businessListingPaidView()
    {
        $businessListingPaidArray = BusinessListingPayment::where('bus_pay_status', STATUS_ACTIVE)
            ->orderBy('bus_pay_id', 'DESC')
            ->get();
        return view('admin.businessListingPaidList', ['businessListingPaidArray' => $businessListingPaidArray]);
    }
    public function businessListingUnPaidView()
    {
        $businessListingUnPaidArray = BusinessListingPayment::where('bus_pay_status', STATUS_INACTIVE)
            ->orderBy('bus_pay_id', 'DESC')
            ->get();
        return view('admin.businessListingUnPaidList', ['businessListingUnPaidArray' => $businessListingUnPaidArray]);
    }

    public function exportBusinessListingExcel()
    {
        return Excel::download(new businessListingExport(), 'businessListing-' . date('Y-m-d') . '-' . time() . '.xlsx');
    }

    public function importBusinessListingExcel(Request $request)
    {
        Excel::import(new businessListingImport(), $request->file('excel_file'));

        return redirect()->to('admin/businessListing');

        // $allBusinessListingArray = BusinessListing::join('users', 'users.id', '=', 'business_listing.bus_user_id')
        //     ->orderBy('bus_id', 'desc')
        //     ->get(['users.name', 'business_listing.bus_id', 'business_listing.bus_name', 'business_listing.bus_contact_no', 'business_listing.bus_status', 'business_listing.bus_user_id', 'business_listing.bus_email', 'business_listing.bus_added_time', 'business_listing.bus_changed_time']);
        // return view('admin.businessListingList', ['allBusinessListingArray' => $allBusinessListingArray]);
    }
}
