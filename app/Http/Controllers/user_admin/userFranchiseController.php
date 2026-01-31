<?php

namespace App\Http\Controllers\user_admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Franchise;
use App\Models\FranchiseCategoryChild;
use App\Models\FranchiseCategoryMain;
use App\Models\FranchiseCategorySub;
use App\Models\FranchiseImages;
use App\Models\FranchiseLocationDetail;
use Illuminate\Http\Request;

class userFranchiseController extends Controller{
    public function franchiseListView(Request $request){
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = 'login';
            </script>";
        }
        $getFranchiseData = Franchise::where(['f_user_id'=>Auth::user()->id])->orderBy('f_id', 'DESC')->get();
        return view('user_admin.franchiseList',['getFranchiseData'=>$getFranchiseData]);
    }
    public function franchiseAddView(){
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = 'login';
            </script>";
        }
        $mainCategoryData = FranchiseCategoryMain::where(['fcm_status'=>STATUS_ACTIVE])->orderBy('fcm_id', 'DESC')->get();
        return view('user_admin.franchiseAdd',['mainCategoryData'=>$mainCategoryData]);
    }
    
    public function getFranchiseSubCategory(Request $request){
        $franchiseCategorySubData = FranchiseCategorySub::where(['fcs_status'=>STATUS_ACTIVE,'fcs_cat_main_id'=>$request->catmain_id])->orderBy('fcs_id', 'DESC')->get();
        $optionTag = ' <option value="">Select Sub Category</option>';
        foreach($franchiseCategorySubData as $franchiseCategorySubRow)
        {
            $optionTag .= ' <option value="'.$franchiseCategorySubRow['fcs_id'].'">'.$franchiseCategorySubRow['fcs_name'].'</option>';
        }
        echo $optionTag;
    }

    public function franchiseStore(Request $request){
        //dd($request->all());
        //DB::enableQueryLog();
        $franchiseCategoryData = FranchiseCategoryMain::join('franchise_category_sub', 'franchise_category_sub.fcs_cat_main_id', '=', 'franchise_category_main.fcm_id')
        ->where(['fcm_id' => $request->f_main_cat, 'fcs_id' => $request->f_sub_cat])
        ->orderBy('fcs_id', 'DESC')
        ->first(['franchise_category_sub.fcs_name', 'franchise_category_main.fcm_name']);
        //dd(DB::getQueryLog());

        $newCompanyLogoImageFileName='';
        if($request->file('f_company_logo')){
            $companyLogoImageFile = $request->file('f_company_logo');
            $companyLogoImageFileName = $companyLogoImageFile->getClientOriginalName();
            $newCompanyLogoImageFileName = time().'.'.$companyLogoImageFileName;
            $companyLogoImageFile->move('custom-images/franchise-images/',$newCompanyLogoImageFileName);
        }
        
        $newFranchiseBrochureFileName='';
        if($request->file('f_franchise_brochure')){
            $franchiseBrochureFile = $request->file('f_franchise_brochure');
            $franchiseBrochureFileName = $franchiseBrochureFile->getClientOriginalName();
            $newFranchiseBrochureFileName = time().'.'.$franchiseBrochureFileName;
            $franchiseBrochureFile->move('custom-images/franchise-images/',$newFranchiseBrochureFileName);
        }
        
        $newBusinessRegistrationCertificateFileName='';
        if($request->file('f_business_registration_certificate')){
            $businessRegistrationCertificateFile = $request->file('f_business_registration_certificate');
            $businessRegistrationCertificateFileName = $businessRegistrationCertificateFile->getClientOriginalName();
            $newBusinessRegistrationCertificateFileName = time().'.'.$businessRegistrationCertificateFileName;
            $businessRegistrationCertificateFile->move('custom-images/franchise-images/',$newBusinessRegistrationCertificateFileName);
        }

        $newFranchiseDisclosureDocumentFileName='';
        if($request->file('f_franchise_disclosure_document')){
            $franchiseDisclosureDocumentFile = $request->file('f_franchise_disclosure_document');
            $franchiseDisclosureDocumentFileName = $franchiseDisclosureDocumentFile->getClientOriginalName();
            $newFranchiseDisclosureDocumentFileName = time().'.'.$franchiseDisclosureDocumentFileName;
            $franchiseDisclosureDocumentFile->move('custom-images/franchise-images/',$newFranchiseDisclosureDocumentFileName);
        }

        $newProductsServicesFileNameName='';
        if($request->file('f_products_services')){
            $productsServicesFile = $request->file('f_products_services');
            $productsServicesFileName = $productsServicesFile->getClientOriginalName();
            $newProductsServicesFileNameName = time().'.'.$productsServicesFileName;
            $productsServicesFile->move('custom-images/franchise-images/',$newProductsServicesFileNameName);
        }

        $f_business_type = '';
        if(isset($request->f_business_type) && !empty($request->f_business_type)){
            $f_business_type = implode(',', $request->f_business_type);
        }
        
        $f_franchisee_type = '';
        if(isset($request->f_franchisee_type) && !empty($request->f_franchisee_type)){
            $f_franchisee_type = implode(',', $request->f_franchisee_type);
        }

        $f_training_provided = '';
        if(isset($request->f_training_provided) && !empty($request->f_training_provided)){
            $f_training_provided = implode(',', $request->f_training_provided);
        }

        $franchiseInsertData = Franchise::create([
            'f_user_id' => Auth::user()->id,
            'f_status' => STATUS_INACTIVE,
            'f_name' => $request->f_name,
            'f_email' => $request->f_email,
            'f_contact_no' => $request->f_contact_no,
            'f_alt_contact_no' => $request->f_alt_contact_no,
            'f_website' => $request->f_website,

            'f_main_cat' =>$franchiseCategoryData['fcm_name'],
            'f_sub_cat' => $franchiseCategoryData['fcs_name'],
            'f_child_cat' => $request->f_child_cat,
            'f_brand_name' => $request->f_brand_name,
            'f_company_name' => $request->f_company_name,
            'f_business_year_established' => $request->f_business_year_established,
            'f_business_type' => $f_business_type,

            'f_franchise_website_url' => $request->f_franchise_website_url,
            'f_business_desc' => $request->f_business_desc,
            'f_country' => $request->f_country,
            'f_state' => $request->f_state,
            'f_city' => $request->f_city,
            'f_pin_code' => $request->f_pin_code,
            'f_franchisee_address' => $request->f_franchisee_address,

            'f_franchisee_type' => $f_franchisee_type,
            'f_franchisee_year_established' => $request->f_franchisee_year_established,
            'f_total_investment' => $request->f_total_investment,
            'f_franchise_fee' => $request->f_franchise_fee,
            'f_royalty_fee' => $request->f_royalty_fee,
            'f_marketing_fee' => $request->f_marketing_fee,
            'f_total_company_owned_outlets' => $request->f_total_company_owned_outlets,
            'f_total_franchise_outlets_opened' => $request->f_total_franchise_outlets_opened,
            'f_other_investment_requirements' => $request->f_other_investment_requirements,
            'f_franchisee_desc' => $request->f_franchisee_desc,
            'f_available_in_india' => $request->f_available_in_india,

            'f_international_expansion' => $request->f_international_expansion,
            'f_training_provided' => $f_training_provided,
            'f_training_duration' => $request->f_training_duration,
            'f_financing_aid' => $request->f_financing_aid,
            'f_site_selection_assistance' => $request->f_site_selection_assistance,
            'f_head_office_support_open' => $request->f_head_office_support_open,
            'f_it_systems_included' => $request->f_it_systems_included,
            'f_performance_guarantee' => $request->f_performance_guarantee,
            'f_expected_roi' => $request->f_expected_roi,
            'f_payback_period' => $request->f_payback_period,

            'f_franchise_term_duration' => $request->f_franchise_term_duration,
            'f_term_renewable' => $request->f_term_renewable,
            'f_type_property_required' => $request->f_type_property_required,
            'f_minimum_area_required' => $request->f_minimum_area_required,
            'f_property_location_preference' => $request->f_property_location_preference,
            'f_who_will_furnish_premises' => $request->f_who_will_furnish_premises,

            'f_company_logo' => $newCompanyLogoImageFileName,
            'f_franchise_brochure' => $newFranchiseBrochureFileName,
            'f_business_registration_certificate' => $newBusinessRegistrationCertificateFileName,
            'f_franchise_disclosure_document' => $newFranchiseDisclosureDocumentFileName,
            'f_products_services' => $newProductsServicesFileNameName,
            
            'f_corporate_video_url' => $request->f_corporate_video_url,
            'f_facebook_url' => $request->f_facebook_url,
            'f_twitter_url' => $request->f_twitter_url,
            'f_instagram_url' => $request->f_instagram_url,
            'f_youtube_url' => $request->f_youtube_url,

            'f_why_choose_you' => $request->f_why_choose_you,
            'f_success_story' => $request->f_success_story,
            'f_added_time' => CURRENT_DATE_TIME
        ]);
        if($franchiseInsertData){

            $franchiseLastInsertId = DB::getPdo()->lastInsertId();
            $data = [];
            $country = $request->input('country');
            $city = $request->input('city');

            if(isset($country) && isset($city)){
                for($i = 0; $i < count($country); $i++){
                    $data[] = [
                        'fld_franchise_id' => $franchiseLastInsertId,
                        'fld_country' => $country[$i],
                        'fld_city' => $city[$i],
                        'fld_added_timestamp' => CURRENT_DATE_TIME
                    ];
                }
                if($data){
                    FranchiseLocationDetail::insert($data);
                }
            }

            if($request->hasfile('franchise_images')) {
                foreach ($request->file('franchise_images') as $file) {
                    $filename = time() . '.' . $file->getClientOriginalName();
                    $file->move('custom-images/franchise-images/', $filename);
                    $file = new FranchiseImages();
                    $file->fi_path = $filename;
                    $file->fi_franchise_id = $franchiseLastInsertId;
                    $file->fi_added_time = CURRENT_DATE_TIME;
                    $file->save();
                }
            }

            $msg = 'Your franchisee listing has been submitted successfully!\n\nWe’ve received your details and our review team will verify them soon. You’ll receive an update once it goes live on Punnaka.com.\n\nFor any assistance, WhatsApp us at +91-7875155538 Or email us at info@punnaka.com';
            echo "<script>alert(\"$msg\")
            window.location.href='/user-admin/dashboard';
            </script>";
            //return redirect('user-admin/franchiseList')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('user-admin/franchiseList')->with('message',MSG_ADD_ERROR);
        }
    }

     public function franchiseEditView(Request $request){
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = 'login';
            </script>";
        }
        $getFranchiseData = Franchise::where('f_id',$request->id)->first();
        $mainCategoryData = FranchiseCategoryMain::where(['fcm_status'=>STATUS_ACTIVE])->orderBy('fcm_id', 'DESC')->get();
        $getFranchiseLocationDetail = FranchiseLocationDetail::where(['fld_franchise_id'=>$request->id])->orderBy('fld_id', 'ASC')->get();
        return view('user_admin.franchiseEdit',['getFranchiseData'=>$getFranchiseData,'mainCategoryData'=>$mainCategoryData, 'getFranchiseLocationDetail' => $getFranchiseLocationDetail]);
    }

    public function franchiseUpdate(Request $request){
        
        if(isset($request->f_main_cat) && isset($request->f_sub_cat) && isset($request->f_child_cat)){

        $franchiseCategoryData = FranchiseCategoryMain::join('franchise_category_sub', 'franchise_category_sub.fcs_cat_main_id', '=', 'franchise_category_main.fcm_id')
            ->where(['fcm_id' => $request->f_main_cat, 'fcs_id' => $request->f_sub_cat])
            ->orderBy('fcs_id', 'DESC')
            ->first(['franchise_category_sub.fcs_name', 'franchise_category_main.fcm_name']);

            $catMainName = $franchiseCategoryData['fcm_name'];
            $catSubName = $franchiseCategoryData['fcs_name'];
        }else{
            $catMainName = $request->old_f_main_cat;
            $catSubName = $request->old_f_sub_cat;
        }
        //dd(DB::getQueryLog());

        
        if($request->file('f_company_logo')){
            $companyLogoImageFile = $request->file('f_company_logo');
            $companyLogoImageFileName = $companyLogoImageFile->getClientOriginalName();
            $newCompanyLogoImageFileName = time().'.'.$companyLogoImageFileName;
            $companyLogoImageFile->move('custom-images/franchise-images/',$newCompanyLogoImageFileName);
            
            $companyLogoImageFilePath = 'custom-images/franchise-images/'.$request->old_f_company_logo;
            if(isset($request->old_f_company_logo) && file_exists($companyLogoImageFilePath)){
                unlink($companyLogoImageFilePath);
            }
            
        }else{
            $newCompanyLogoImageFileName = $request->old_f_company_logo;
        }
        
        if($request->file('f_franchise_brochure')){
            $franchiseBrochureFile = $request->file('f_franchise_brochure');
            $franchiseBrochureFileName = $franchiseBrochureFile->getClientOriginalName();
            $newFranchiseBrochureFileName = time().'.'.$franchiseBrochureFileName;
            $franchiseBrochureFile->move('custom-images/franchise-images/',$newFranchiseBrochureFileName);
            
            $franchiseBrochureFilePath = 'custom-images/franchise-images/'.$request->old_f_franchise_brochure;
            if(isset($request->old_f_franchise_brochure) && file_exists($franchiseBrochureFilePath)){
                unlink($franchiseBrochureFilePath);
            }

        }else{
            $newFranchiseBrochureFileName = $request->old_f_franchise_brochure;
        }
        
        if($request->file('f_business_registration_certificate')){
            $businessRegistrationCertificateFile = $request->file('f_business_registration_certificate');
            $businessRegistrationCertificateFileName = $businessRegistrationCertificateFile->getClientOriginalName();
            $newBusinessRegistrationCertificateFileName = time().'.'.$businessRegistrationCertificateFileName;
            $businessRegistrationCertificateFile->move('custom-images/franchise-images/',$newBusinessRegistrationCertificateFileName);
            
            $businessRegistrationCertificateFilePath = 'custom-images/franchise-images/'.$request->old_f_business_registration_certificate;
            if(isset($request->old_f_business_registration_certificate) && file_exists($businessRegistrationCertificateFilePath)){
                unlink($businessRegistrationCertificateFilePath);
            }

        }else{
            $newBusinessRegistrationCertificateFileName = $request->old_f_business_registration_certificate;
        }

        if($request->file('f_franchise_disclosure_document')){
            $franchiseDisclosureDocumentFile = $request->file('f_franchise_disclosure_document');
            $franchiseDisclosureDocumentFileName = $franchiseDisclosureDocumentFile->getClientOriginalName();
            $newFranchiseDisclosureDocumentFileName = time().'.'.$franchiseDisclosureDocumentFileName;
            $franchiseDisclosureDocumentFile->move('custom-images/franchise-images/',$newFranchiseDisclosureDocumentFileName);
           
            $franchiseDisclosureDocumentFilePath = 'custom-images/franchise-images/'.$request->old_f_franchise_disclosure_document;
            if(isset($request->old_f_franchise_disclosure_document) && file_exists($franchiseDisclosureDocumentFilePath)){
                unlink($franchiseDisclosureDocumentFilePath);
            }

        }else{
            $newFranchiseDisclosureDocumentFileName = $request->old_f_franchise_disclosure_document;
        }

        if($request->file('f_products_services')){
            $productsServicesFile = $request->file('f_products_services');
            $productsServicesFileName = $productsServicesFile->getClientOriginalName();
            $newProductsServicesFileName = time().'.'.$productsServicesFileName;
            $productsServicesFile->move('custom-images/franchise-images/',$newProductsServicesFileName);
           
            $productsServicesFilePath = 'custom-images/franchise-images/'.$request->old_f_products_services;
            if(isset($request->old_f_products_services) && file_exists($productsServicesFilePath)){
                unlink($productsServicesFilePath);
            }

        }else{
            $newProductsServicesFileName = $request->old_f_products_services;
        }

        if(isset($request->f_business_type) && !empty($request->f_business_type)){
            $f_business_type = implode(',', $request->f_business_type);
        }else{
            $f_business_type = $request->old_f_business_type;
        }
        
        if(isset($request->f_franchisee_type) && !empty($request->f_franchisee_type)){
            $f_franchisee_type = implode(',', $request->f_franchisee_type);
        }else{
            $f_franchisee_type = $request->old_f_franchisee_type;
        }

        if(isset($request->f_training_provided) && !empty($request->f_training_provided)){
            $f_training_provided = implode(',', $request->f_training_provided);
        }else{
            $f_training_provided = $request->old_f_training_provided;
        }


        $franchiseUpdateData =Franchise::where("f_id", $request->id)->update([
            'f_status' => $request->f_status,
            'f_name' => $request->f_name,
            'f_email' => $request->f_email,
            'f_contact_no' => $request->f_contact_no,
            'f_alt_contact_no' => $request->f_alt_contact_no,
            'f_website' => $request->f_website,
            'f_main_cat' =>$catMainName,
            'f_sub_cat' => $catSubName,
            'f_child_cat' => $request->f_child_cat,

            'f_brand_name' => $request->f_brand_name,
            'f_company_name' => $request->f_company_name,
            'f_business_year_established' => $request->f_business_year_established,
            'f_business_type' => $f_business_type,

            'f_franchise_website_url' => $request->f_franchise_website_url,
            'f_business_desc' => $request->f_business_desc,
            'f_country' => $request->f_country,
            'f_state' => $request->f_state,
            'f_city' => $request->f_city,
            'f_pin_code' => $request->f_pin_code,
            'f_franchisee_address' => $request->f_franchisee_address,

            'f_franchisee_type' => $f_franchisee_type,
            'f_franchisee_year_established' => $request->f_franchisee_year_established,
            'f_total_investment' => $request->f_total_investment,
            'f_franchise_fee' => $request->f_franchise_fee,
            'f_royalty_fee' => $request->f_royalty_fee,
            'f_marketing_fee' => $request->f_marketing_fee,
            'f_total_company_owned_outlets' => $request->f_total_company_owned_outlets,
            'f_total_franchise_outlets_opened' => $request->f_total_franchise_outlets_opened,
            'f_other_investment_requirements' => $request->f_other_investment_requirements,
            'f_franchisee_desc' => $request->f_franchisee_desc,
            'f_available_in_india' => $request->f_available_in_india,

            'f_international_expansion' => $request->f_international_expansion,
            'f_training_provided' => $f_training_provided,
            'f_training_duration' => $request->f_training_duration,
            'f_financing_aid' => $request->f_financing_aid,
            'f_site_selection_assistance' => $request->f_site_selection_assistance,
            'f_head_office_support_open' => $request->f_head_office_support_open,
            'f_it_systems_included' => $request->f_it_systems_included,
            'f_performance_guarantee' => $request->f_performance_guarantee,
            'f_expected_roi' => $request->f_expected_roi,
            'f_payback_period' => $request->f_payback_period,

            'f_franchise_term_duration' => $request->f_franchise_term_duration,
            'f_term_renewable' => $request->f_term_renewable,
            'f_type_property_required' => $request->f_type_property_required,
            'f_minimum_area_required' => $request->f_minimum_area_required,
            'f_property_location_preference' => $request->f_property_location_preference,
            'f_who_will_furnish_premises' => $request->f_who_will_furnish_premises,

            'f_company_logo' => $newCompanyLogoImageFileName,
            'f_franchise_brochure' => $newFranchiseBrochureFileName,
            'f_business_registration_certificate' => $newBusinessRegistrationCertificateFileName,
            'f_franchise_disclosure_document' => $newFranchiseDisclosureDocumentFileName,
            'f_products_services' => $newProductsServicesFileName,
            
            'f_corporate_video_url' => $request->f_corporate_video_url,
            'f_facebook_url' => $request->f_facebook_url,
            'f_twitter_url' => $request->f_twitter_url,
            'f_instagram_url' => $request->f_instagram_url,
            'f_youtube_url' => $request->f_youtube_url,

            'f_why_choose_you' => $request->f_why_choose_you,
            'f_success_story' => $request->f_success_story,
            'f_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($franchiseUpdateData){
            return redirect(USER_ADMIN_URL.'franchiseEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect(USER_ADMIN_URL.'franchiseEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }

    public function franchiseOtherDetailListView(Request $request){
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = 'login';
            </script>";
        }

        $franchiseData = DB::table('franchise')
        ->select('f_id', 'f_user_id', 'f_name')
        ->where(['f_id' => $request->id])
        ->first();      

        $getFranchiseImageData = FranchiseImages::where('fi_franchise_id',$request->id)->orderBy('fi_id', 'DESC')->get();
        $getFranchiseLocationDetail = FranchiseLocationDetail::where(['fld_franchise_id'=>$request->id])->orderBy('fld_id', 'DESC')->get();
        return view('user_admin.franchiseOtherDetailList',['franchiseData' => $franchiseData ,'getFranchiseImageData'=>$getFranchiseImageData,'getFranchiseLocationDetail' => $getFranchiseLocationDetail]);
    }

    public function franchiseImageStore(Request $request){
        if ($request->hasfile('franchise_images')) {
            foreach ($request->file('franchise_images') as $file) {
                $filename = time() . '.' . $file->getClientOriginalName();
                $file->move('custom-images/franchise-images/', $filename);
                $file = new FranchiseImages();
                $file->fi_path = $filename;
                $file->fi_franchise_id = $request->fi_franchise_id;
                $file->fi_added_time = CURRENT_DATE_TIME;
                $file->save();
                $save = true;
            }
            if($save){
                return redirect('user-admin/franchiseOtherDetailList/'.$request->fi_franchise_id)->with('message',MSG_ADD_SUCCESS);
            }else{
                return redirect('user-admin/franchiseOtherDetailList/'.$request->fi_franchise_id)->with('message',MSG_ADD_ERROR);
            }
        }else{
            return redirect('user-admin/franchiseOtherDetailList/'.$request->fi_franchise_id)->with('message',MSG_ADD_ERROR);
        }
    }

    public function franchiseImageRemove(Request $request){
        $FranchiseImagesData = FranchiseImages::where(['fi_id'=>$request->id]);
        $FranchiseImagesData->delete();
        $imagePath = 'custom-images/franchise-images/'.$request->path;
        if(file_exists($imagePath)){
            unlink($imagePath);
        }
        return redirect('user-admin/franchiseOtherDetailList/'.$request->franchiseId)->with('msg', 'Record deleted successfully');
    }

    public function franchiseLocationDetailStore(Request $request){

        $data = [];
        $country = $request->input('country');
        $city = $request->input('city');

        if(isset($country) && isset($city)){
            for($i = 0; $i < count($country); $i++){
                $data[] = [
                    'fld_franchise_id' => $request->fld_franchise_id,
                    'fld_country' => $country[$i],
                    'fld_city' => $city[$i],
                    'fld_added_timestamp' => CURRENT_DATE_TIME
                ];
            }
            if($data){
                FranchiseLocationDetail::insert($data);
                return redirect('user-admin/franchiseOtherDetailList/'.$request->fld_franchise_id)->with('message',MSG_ADD_SUCCESS);
            }else{
                return redirect('user-admin/franchiseOtherDetailList/'.$request->fld_franchise_id)->with('message',MSG_ADD_ERROR);
            }
         }else{
            return redirect('user-admin/franchiseOtherDetailList/'.$request->fld_franchise_id)->with('message',MSG_ADD_ERROR);
        }
    }

    public function franchiseLocationDetailRemove(Request $request){
        $FranchiseLocationDetailData = FranchiseLocationDetail::where(['fld_id'=>$request->id]);
        $FranchiseLocationDetailData->delete();
        if($FranchiseLocationDetailData){
            return redirect('user-admin/franchiseOtherDetailList/'.$request->franchiseId)->with('msg', 'Record deleted successfully');
        }else{
            return redirect('user-admin/franchiseOtherDetailList/'.$request->franchiseId)->with('msg', 'No Record deleted');
        }
    }

    public function checkFranchiseListingCount(){
        if(!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../login';
            </script>";
        }
        $checkFranchiseListingCount = Franchise::where(['f_user_id' => Auth::user()->id])->count();
        return $checkFranchiseListingCount;
    }
    /*
    public function franchiseAddViewOldBK(){
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../login';
            </script>";
        }
        $mainCategoryData = FranchiseCategoryMain::where(['fcm_status'=>STATUS_ACTIVE])->orderBy('fcm_id', 'DESC')->get();
        return view('user_admin.franchiseAdd',['mainCategoryData'=>$mainCategoryData]);
    }
    public function franchiseEditViewOldBK(Request $request){
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../login';
            </script>";
        }
        $getFranchiseData = Franchise::where('f_id',$request->id)->first();
        $mainCategoryData = FranchiseCategoryMain::where(['fcm_status'=>STATUS_ACTIVE])->orderBy('fcm_id', 'DESC')->get();
        $getFranchiseLocationDetail = FranchiseLocationDetail::where(['fld_franchise_id'=>$request->id])->orderBy('fld_id', 'ASC')->get();
        return view('user_admin.franchiseEdit',['getFranchiseData'=>$getFranchiseData,'mainCategoryData'=>$mainCategoryData, 'getFranchiseLocationDetail' => $getFranchiseLocationDetail]);
    }

    public function getFranchiseSubCategoryOldBK(Request $request){
        $franchiseCategorySubData = FranchiseCategorySub::where(['fcs_status'=>STATUS_ACTIVE,'fcs_cat_main_id'=>$request->catmain_id])->orderBy('fcs_id', 'DESC')->get();
        $optionTag = ' <option value="">Select Sub Category</option>';
        foreach($franchiseCategorySubData as $franchiseCategorySubRow)
        {
            $optionTag .= ' <option value="'.$franchiseCategorySubRow['fcs_id'].'">'.$franchiseCategorySubRow['fcs_name'].'</option>';
        }
        echo $optionTag;
    }
    public function getFranchiseChildCategoryOldBK(Request $request){
        $franchiseCategoryChildData = FranchiseCategoryChild::where(['fcc_status'=>STATUS_ACTIVE,'fcc_cat_main_id'=>$request->catmain_id,'fcc_cat_sub_id'=>$request->catsub_id])->orderBy('fcc_id', 'DESC')->get();
        $optionTag = ' <option value="">Select Child Category</option>';
        foreach($franchiseCategoryChildData as $franchiseCategoryChildRow)
        {
            $optionTag .= ' <option value="'.$franchiseCategoryChildRow['fcc_id'].'">'.$franchiseCategoryChildRow['fcc_name'].'</option>';
        }
        echo $optionTag;
    }

    public function franchiseStoreOldBK(Request $request){
        //dd($request->all());
        //DB::enableQueryLog();
        $franchiseCategoryData = FranchiseCategoryMain::join('franchise_category_sub', 'franchise_category_sub.fcs_cat_main_id', '=', 'franchise_category_main.fcm_id')
        ->join('franchise_category_child', 'franchise_category_child.fcc_cat_main_id', '=', 'franchise_category_main.fcm_id')
        ->where(['fcm_id' => $request->f_main_cat, 'fcs_id' => $request->f_sub_cat, 'fcc_id' => $request->f_child_cat])
        ->orderBy('fcs_id', 'DESC')
        ->first(['franchise_category_sub.fcs_name', 'franchise_category_main.fcm_name', 'franchise_category_child.fcc_name']);
        //dd(DB::getQueryLog());

        $companyLogoImageFile = $request->file('f_company_logo');
        $companyLogoImageFileName = $companyLogoImageFile->getClientOriginalName();
        $newCompanyLogoImageFileName = time().'.'.$companyLogoImageFileName;
        $companyLogoImageFile->move('custom-images/franchise-images/',$newCompanyLogoImageFileName);
        
        $companyImageFile = $request->file('f_company_image');
        $companyImageFileName = $companyImageFile->getClientOriginalName();
        $newCompanyImageFileName = time().'.'.$companyImageFileName;
        $companyImageFile->move('custom-images/franchise-images/',$newCompanyImageFileName);
  
  
        $franchiseLogoImageFile = $request->file('f_franchise_logo');
        $franchiseLogoImageFileName = $franchiseLogoImageFile->getClientOriginalName();
        $newFranchiseLogoImageFileName = time().'.'.$franchiseLogoImageFileName;
        $franchiseLogoImageFile->move('custom-images/franchise-images/',$newFranchiseLogoImageFileName);
        
        $franchiseImageFile = $request->file('f_franchise_image');
        $franchiseImageFileName = $franchiseImageFile->getClientOriginalName();
        $newFranchiseImageFileName = time().'.'.$franchiseImageFileName;
        $franchiseImageFile->move('custom-images/franchise-images/',$newFranchiseImageFileName);

        $franchiseBrochureFile = $request->file('f_franchise_brochure');
        $franchiseBrochureFileName = $franchiseBrochureFile->getClientOriginalName();
        $newFranchiseBrochureFileName = time().'.'.$franchiseBrochureFileName;
        $franchiseBrochureFile->move('custom-images/franchise-images/',$newFranchiseBrochureFileName);

        if(isset($request->f_begin_expanding_internationally_country) && !empty($request->f_begin_expanding_internationally_country) && $request->f_begin_expanding_internationally == 'YES'){
            $f_begin_expanding_internationally_country = implode(',', $request->f_begin_expanding_internationally_country);
        }else{
            $f_begin_expanding_internationally_country = '';
        }

        $franchiseInsertData = Franchise::create([
            'f_user_id' => Auth::user()->id,
            'f_status' => STATUS_INACTIVE,
            'f_main_cat' =>$franchiseCategoryData['fcm_name'],
            'f_sub_cat' => $franchiseCategoryData['fcs_name'],
            'f_child_cat' => $franchiseCategoryData['fcc_name'],

            'f_name' => $request->f_name,
            'f_email' => $request->f_email,
            'f_contact_no' => $request->f_contact_no,
            'f_whatsapp_no' => $request->f_whatsapp_no,
            'f_company_name' => $request->f_company_name,
            'f_company_designation' => $request->f_company_designation,

            'f_brand_name' => $request->f_brand_name,
            'f_owner_name' => $request->f_owner_name,
            'f_owner_contact_no' => $request->f_owner_contact_no,
            'f_owner_email' => $request->f_owner_email,
            'f_manager_name' => $request->f_manager_name,
            'f_manger_contact_no' => $request->f_manger_contact_no,
            'f_manager_email' => $request->f_manager_email,
            'f_company_address' => $request->f_company_address,

            'f_country' => $request->f_country,
            'f_state' => $request->f_state,
            'f_city' => $request->f_city,
            'f_pin_code' => $request->f_pin_code,

            'f_landline' => $request->f_landline,
            'f_business_website_url' => $request->f_business_website_url,
            'f_business_email' => $request->f_business_email,
            'f_business_alt_email' => $request->f_business_alt_email,
            'f_business_establishment_year' => $request->f_business_establishment_year,
            'f_year_commenced_business_operations' => $request->f_year_commenced_business_operations,
            'f_total_no_company_owned_outlets' => $request->f_total_no_company_owned_outlets,

            'f_business_desc' => $request->f_business_desc,
            'f_franchisee_name' => $request->f_franchisee_name,
            'f_year_commenced_franchising' => $request->f_year_commenced_franchising,

            'f_franchise_website_url' => $request->f_franchise_website_url,
            'f_total_no_franchise_outlets_opened' => $request->f_total_no_franchise_outlets_opened,
            'f_current_franchisee_outlets_located_country' => $request->f_current_franchisee_outlets_located_country,
            'f_current_franchisee_outlets_located_state' => $request->f_current_franchisee_outlets_located_state,
            'f_current_franchisee_outlets_located_city' => $request->f_current_franchisee_outlets_located_city,

            'f_marketing_materials_available' => $request->f_marketing_materials_available,
            'f_franchise_grant_unit_exclusive_territorial_rights' => $request->f_franchise_grant_unit_exclusive_territorial_rights,
            'f_performance_guarantees_unit_franchisees' => $request->f_performance_guarantees_unit_franchisees,
            'f_marketing_advertising_levies_payable_franchisor' => $request->f_marketing_advertising_levies_payable_franchisor,
            'f_amount_investment_franchisee' => $request->f_amount_investment_franchisee,

            'f_franchisee_brand_fee' => $request->f_franchisee_brand_fee,
            'f_multi_units_brand_fee' => $request->f_multi_units_brand_fee,
            'f_royalty_commission' => $request->f_royalty_commission,
            'f_return_investment_anticipated' => $request->f_return_investment_anticipated,

            'f_expected_payback_period_capital_franchised_unit_no' => $request->f_expected_payback_period_capital_franchised_unit_no,
            'f_expected_payback_period_capital_franchised_unit_month' => $request->f_expected_payback_period_capital_franchised_unit_month,
            'f_expected_payback_period_capital_franchised_unit_year' => $request->f_expected_payback_period_capital_franchised_unit_year,
            'f_further_investment_requirements' => $request->f_further_investment_requirements,
            'f_provide_aid_financing' => $request->f_provide_aid_financing,

            'f_begin_expanding_internationally' => $request->f_begin_expanding_internationally,
            'f_begin_expanding_internationally_country' => $f_begin_expanding_internationally_country,
            'f_franchisee_desc' => $request->f_franchisee_desc,
            'f_franchise_opportunity' => $request->f_franchise_opportunity,
            'f_preferred_location_franchise_outlet' => $request->f_preferred_location_franchise_outlet,

            'f_floor_area_requirements_franchisee' => $request->f_floor_area_requirements_franchisee,
            'f_franchisee_arrange_furnish_premises' => $request->f_franchisee_arrange_furnish_premises,
            'f_offer_site_selection_assistance' => $request->f_offer_site_selection_assistance,
            'f_franchise_operation_instructions_available' => $request->f_franchise_operation_instructions_available,
            'f_franchisee_training_conducted' => $request->f_franchisee_training_conducted,

            'f_field_assistance_available_franchises' => $request->f_field_assistance_available_franchises,
            'f_office_support_franchisee_opening_franchise' => $request->f_office_support_franchisee_opening_franchise,
            'f_it_systems_presently_included_franchise' => $request->f_it_systems_presently_included_franchise,
            'f_standard_franchise_agreement' => $request->f_standard_franchise_agreement,
            'f_franchise_contract_last' => $request->f_franchise_contract_last,
            'f_franchise_contract_last_value' => $request->f_franchise_contract_last_value,
            'f_franchise_contract_renewable' => $request->f_franchise_contract_renewable,
            
            'f_company_logo' => $newCompanyLogoImageFileName,
            'f_company_image' => $newCompanyImageFileName,
            'f_franchise_logo' => $newFranchiseLogoImageFileName,
            'f_franchise_image' => $newFranchiseImageFileName,
            'f_franchise_brochure' => $newFranchiseBrochureFileName,
            
            'f_corporate_video_url' => $request->f_corporate_video_url,
            'f_facebook_url' => $request->f_facebook_url,
            'f_twitter_url' => $request->f_twitter_url,
            'f_instagram_url' => $request->f_instagram_url,
            'f_youtube_url' => $request->f_youtube_url,
            'f_added_time' => CURRENT_DATE_TIME
        ]);
        if($franchiseInsertData){
            $franchiseLastInsertId = DB::getPdo()->lastInsertId();

            $country = $request->input('country');
            $state = $request->input('state');
            $city = $request->input('city');

            $data = [];
            for ($i = 0; $i < count($country); $i++) {
                $data[] = [
                    'fld_franchise_id' => $franchiseLastInsertId,
                    'fld_country' => $country[$i],
                    'fld_state' => $state[$i],
                    'fld_city' => $city[$i],
                    'fld_added_timestamp' => CURRENT_DATE_TIME
                ];
            }
            if($data){
                FranchiseLocationDetail::insert($data);
            }

            return redirect('user-admin/franchiseAdd')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('user-admin/franchiseAdd')->with('message',MSG_ADD_ERROR);
        }
    }

    

     public function franchiseUpdateOldBK(Request $request)
    {
        
        if(isset($request->f_main_cat) && isset($request->f_sub_cat) && isset($request->f_child_cat)){

        $franchiseCategoryData = FranchiseCategoryMain::join('franchise_category_sub', 'franchise_category_sub.fcs_cat_main_id', '=', 'franchise_category_main.fcm_id')
            ->join('franchise_category_child', 'franchise_category_child.fcc_cat_main_id', '=', 'franchise_category_main.fcm_id')
            ->where(['fcm_id' => $request->f_main_cat, 'fcs_id' => $request->f_sub_cat, 'fcc_id' => $request->f_child_cat])
            ->orderBy('fcs_id', 'DESC')
            ->first(['franchise_category_sub.fcs_name', 'franchise_category_main.fcm_name', 'franchise_category_child.fcc_name']);

            $catMainName = $franchiseCategoryData['fcm_name'];
            $catSubName = $franchiseCategoryData['fcs_name'];
            $catChildName = $franchiseCategoryData['fcc_name'];

        }else{
            $catMainName = $request->old_f_main_cat;
            $catSubName = $request->old_f_sub_cat;
            $catChildName = $request->old_f_child_cat;
        }
        //dd(DB::getQueryLog());

        if($request->file('f_company_logo')){
            $companyLogoImageFile = $request->file('f_company_logo');
            $companyLogoImageFileName = $companyLogoImageFile->getClientOriginalName();
            $newCompanyLogoImageFileName = time().'.'.$companyLogoImageFileName;
            $companyLogoImageFile->move('custom-images/franchise-images/',$newCompanyLogoImageFileName);
        }else{
            $newCompanyLogoImageFileName = $request->old_f_company_logo;
        }
        
        if($request->file('f_company_image')){
            $companyImageFile = $request->file('f_company_image');
            $companyImageFileName = $companyImageFile->getClientOriginalName();
            $newCompanyImageFileName = time().'.'.$companyImageFileName;
            $companyImageFile->move('custom-images/franchise-images/',$newCompanyImageFileName);
        }else{
            $newCompanyImageFileName = $request->old_f_company_image;
        }
        
        if($request->file('f_franchise_logo')){
            $franchiseLogoImageFile = $request->file('f_franchise_logo');
            $franchiseLogoImageFileName = $franchiseLogoImageFile->getClientOriginalName();
            $newFranchiseLogoImageFileName = time().'.'.$franchiseLogoImageFileName;
            $franchiseLogoImageFile->move('custom-images/franchise-images/',$newFranchiseLogoImageFileName);
        }else{
            $newFranchiseLogoImageFileName = $request->old_f_franchise_logo;
        }

        if($request->file('f_franchise_image')){
            $franchiseImageFile = $request->file('f_franchise_image');
            $franchiseImageFileName = $franchiseImageFile->getClientOriginalName();
            $newFranchiseImageFileName = time().'.'.$franchiseImageFileName;
            $franchiseImageFile->move('custom-images/franchise-images/',$newFranchiseImageFileName);
        }else{
            $newFranchiseImageFileName = $request->old_f_franchise_image;
        }

        if($request->file('f_franchise_brochure')){
            $franchiseBrochureFile = $request->file('f_franchise_brochure');
            $franchiseBrochureFileName = $franchiseBrochureFile->getClientOriginalName();
            $newFranchiseBrochureFileName = time().'.'.$franchiseBrochureFileName;
         $franchiseBrochureFile->move('custom-images/franchise-images/',$newFranchiseBrochureFileName);
        }else{
            $newFranchiseBrochureFileName = $request->old_f_franchise_brochure;
        }

        if(isset($request->f_begin_expanding_internationally_country) && $request->f_begin_expanding_internationally  == 'YES'){
            $f_begin_expanding_internationally_country = implode(',', $request->f_begin_expanding_internationally_country);
        }else{
            $f_begin_expanding_internationally_country = $request->old_f_begin_expanding_internationally_country;
        }
        
        if(isset($request->f_current_franchisee_outlets_located_country)){
            $f_current_franchisee_outlets_located_country = $request->f_current_franchisee_outlets_located_country;
        }else{
            $f_current_franchisee_outlets_located_country = $request->old_f_current_franchisee_outlets_located_country;
        }
        if(isset($request->f_current_franchisee_outlets_located_state)){
            $f_current_franchisee_outlets_located_state = $request->f_current_franchisee_outlets_located_state;
        }else{
            $f_current_franchisee_outlets_located_state = $request->old_f_current_franchisee_outlets_located_state;
        }
        if(isset($request->f_current_franchisee_outlets_located_city)){
            $f_current_franchisee_outlets_located_city = $request->f_current_franchisee_outlets_located_city;
        }else{
            $f_current_franchisee_outlets_located_city = $request->old_f_current_franchisee_outlets_located_city;
        }

        if(isset($request->f_franchise_contract_last) && $request->f_franchise_contract_last == 'YES'){
            $f_franchise_contract_last_value = '';
        }else{
            $f_franchise_contract_last_value = $request->f_franchise_contract_last_value;
        }

        $franchiseUpdateData =Franchise::where("f_id", $request->id)->update([
            'f_main_cat' =>$catMainName,
            'f_sub_cat' => $catSubName,
            'f_child_cat' => $catChildName,
    
            'f_name' => $request->f_name,
            'f_email' => $request->f_email,
            'f_contact_no' => $request->f_contact_no,
            'f_whatsapp_no' => $request->f_whatsapp_no,
            'f_company_name' => $request->f_company_name,
            'f_company_designation' => $request->f_company_designation,

            'f_brand_name' => $request->f_brand_name,
            'f_owner_name' => $request->f_owner_name,
            'f_owner_contact_no' => $request->f_owner_contact_no,
            'f_owner_email' => $request->f_owner_email,
            'f_manager_name' => $request->f_manager_name,
            'f_manger_contact_no' => $request->f_manger_contact_no,
            'f_manager_email' => $request->f_manager_email,
            'f_company_address' => $request->f_company_address,

            'f_country' => $request->f_country,
            'f_state' => $request->f_state,
            'f_city' => $request->f_city,
            'f_pin_code' => $request->f_pin_code,

            'f_landline' => $request->f_landline,
            'f_business_website_url' => $request->f_business_website_url,
            'f_business_email' => $request->f_business_email,
            'f_business_alt_email' => $request->f_business_alt_email,
            'f_business_establishment_year' => $request->f_business_establishment_year,
            'f_year_commenced_business_operations' => $request->f_year_commenced_business_operations,
            'f_total_no_company_owned_outlets' => $request->f_total_no_company_owned_outlets,

            'f_business_desc' => $request->f_business_desc,
            'f_franchisee_name' => $request->f_franchisee_name,
            'f_year_commenced_franchising' => $request->f_year_commenced_franchising,

            'f_franchise_website_url' => $request->f_franchise_website_url,
            'f_total_no_franchise_outlets_opened' => $request->f_total_no_franchise_outlets_opened,
            'f_current_franchisee_outlets_located_country' => $f_current_franchisee_outlets_located_country,
            'f_current_franchisee_outlets_located_state' => $f_current_franchisee_outlets_located_state,
            'f_current_franchisee_outlets_located_city' => $f_current_franchisee_outlets_located_city,

            'f_marketing_materials_available' => $request->f_marketing_materials_available,
            'f_franchise_grant_unit_exclusive_territorial_rights' => $request->f_franchise_grant_unit_exclusive_territorial_rights,
            'f_performance_guarantees_unit_franchisees' => $request->f_performance_guarantees_unit_franchisees,
            'f_marketing_advertising_levies_payable_franchisor' => $request->f_marketing_advertising_levies_payable_franchisor,
            'f_amount_investment_franchisee' => $request->f_amount_investment_franchisee,

            'f_franchisee_brand_fee' => $request->f_franchisee_brand_fee,
            'f_multi_units_brand_fee' => $request->f_multi_units_brand_fee,
            'f_royalty_commission' => $request->f_royalty_commission,
            'f_return_investment_anticipated' => $request->f_return_investment_anticipated,

            'f_expected_payback_period_capital_franchised_unit_no' => $request->f_expected_payback_period_capital_franchised_unit_no,
            'f_expected_payback_period_capital_franchised_unit_month' => $request->f_expected_payback_period_capital_franchised_unit_month,
            'f_expected_payback_period_capital_franchised_unit_year' => $request->f_expected_payback_period_capital_franchised_unit_year,
            'f_further_investment_requirements' => $request->f_further_investment_requirements,
            'f_provide_aid_financing' => $request->f_provide_aid_financing,

            'f_begin_expanding_internationally' => $request->f_begin_expanding_internationally,
            'f_begin_expanding_internationally_country' => $f_begin_expanding_internationally_country,
            'f_franchisee_desc' => $request->f_franchisee_desc,
            'f_franchise_opportunity' => $request->f_franchise_opportunity,
            'f_preferred_location_franchise_outlet' => $request->f_preferred_location_franchise_outlet,

            'f_floor_area_requirements_franchisee' => $request->f_floor_area_requirements_franchisee,
            'f_franchisee_arrange_furnish_premises' => $request->f_franchisee_arrange_furnish_premises,
            'f_offer_site_selection_assistance' => $request->f_offer_site_selection_assistance,
            'f_franchise_operation_instructions_available' => $request->f_franchise_operation_instructions_available,
            'f_franchisee_training_conducted' => $request->f_franchisee_training_conducted,

            'f_field_assistance_available_franchises' => $request->f_field_assistance_available_franchises,
            'f_office_support_franchisee_opening_franchise' => $request->f_office_support_franchisee_opening_franchise,
            'f_it_systems_presently_included_franchise' => $request->f_it_systems_presently_included_franchise,
            'f_standard_franchise_agreement' => $request->f_standard_franchise_agreement,
            'f_franchise_contract_last' => $request->f_franchise_contract_last,
            'f_franchise_contract_last_value' => $f_franchise_contract_last_value,
            'f_franchise_contract_renewable' => $request->f_franchise_contract_renewable,
            
            'f_company_logo' => $newCompanyLogoImageFileName,
            'f_company_image' => $newCompanyImageFileName,
            'f_franchise_logo' => $newFranchiseLogoImageFileName,
            'f_franchise_image' => $newFranchiseImageFileName,
            'f_franchise_brochure' => $newFranchiseBrochureFileName,
            
            'f_corporate_video_url' => $request->f_corporate_video_url,
            'f_facebook_url' => $request->f_facebook_url,
            'f_twitter_url' => $request->f_twitter_url,
            'f_instagram_url' => $request->f_instagram_url,
            'f_youtube_url' => $request->f_youtube_url,
            'f_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($franchiseUpdateData){

            $country = $request->input('country');
            $state = $request->input('state');
            $city = $request->input('city');
           
          
            if(array_filter($country)){
                $data = [];
                for ($i = 0; $i < count($country); $i++) {
                    $data[] = [
                    'fld_franchise_id' => $request->id,
                    'fld_country' => $country[$i],
                    'fld_state' => $state[$i],
                    'fld_city' => $city[$i],
                    'fld_added_timestamp' => CURRENT_DATE_TIME
                ];
                }
              
                if($data){
                    FranchiseLocationDetail::insert($data);
                }
            }

            return redirect(USER_ADMIN_URL.'franchiseEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect(USER_ADMIN_URL.'franchiseEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }
    

    public function franchiseUpdateOldOldBK(Request $request)
    {
        
        if(isset($request->f_main_cat) && isset($request->f_sub_cat) && isset($request->f_child_cat)){

            $franchiseCategoryData = FranchiseCategoryMain::join('franchise_category_sub', 'franchise_category_sub.fcs_cat_main_id', '=', 'franchise_category_main.fcm_id')
            ->join('franchise_category_child', 'franchise_category_child.fcc_cat_main_id', '=', 'franchise_category_main.fcm_id')
            ->where(['fcm_id' => $request->f_main_cat, 'fcs_id' => $request->f_sub_cat, 'fcc_id' => $request->f_child_cat])
            ->orderBy('fcs_id', 'DESC')
            ->first(['franchise_category_sub.fcs_name', 'franchise_category_main.fcm_name', 'franchise_category_child.fcc_name']);

            $catMainName = $franchiseCategoryData['fcm_name'];
            $catSubName = $franchiseCategoryData['fcs_name'];
            $catChildName = $franchiseCategoryData['fcc_name'];

        }else{
            $catMainName = $request->old_f_main_cat;
            $catSubName = $request->old_f_sub_cat;
            $catChildName = $request->old_f_child_cat;
        }
      
        $franchiseUpdateData =Franchise::where("f_id", $request->id)->update([
            'f_main_cat' =>$catMainName,
            'f_sub_cat' => $catSubName,
            'f_child_cat' => $catChildName,

            'f_name' => $request->f_name,
            'f_email' => $request->f_email,
            'f_contact_no' => $request->f_contact_no,
            'f_alt_contact' => $request->f_alt_contact,
            'f_type' => $request->f_type,
            'f_start_year' => $request->f_start_year,

            'f_country' => $request->f_country,
            'f_state' => $request->f_state,
            'f_city' => $request->f_city,
            'f_pin_code' => $request->f_pin_code,
            'f_headquarter' => $request->f_headquarter,
            'f_location' => $request->f_location,
            'f_space_req' => $request->f_space_req,
            'f_investment_range' => $request->f_investment_range,

            'f_website_url' => $request->f_website_url,
            'f_twitter_url' => $request->f_twitter_url,
            'f_facebook_url' => $request->f_facebook_url,
            'f_instagram_url' => $request->f_instagram_url,

            'f_north' => $request->f_north,
            'f_south' => $request->f_south,
            'f_east' => $request->f_east,
            'f_west' => $request->f_west,
            'f_center' => $request->f_center,
            'f_union_territories' => $request->f_union_territories,
            'f_desc' => $request->f_desc,

            'f_meta_title' => $request->f_meta_title,
            'f_meta_keyword' => $request->f_meta_keyword,
            'f_meta_description' => $request->f_meta_description,
            'f_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($franchiseUpdateData){
            return redirect(USER_ADMIN_URL.'franchiseEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect(USER_ADMIN_URL.'franchiseEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }

    public function franchiseImagesListViewOldBK(Request $request){
        if (!isset(Auth::user()->id)) {
            echo "<script>
                alert('Please login first');
                window.location.href = '../login';
            </script>";
        }

        $franchiseData = DB::table('franchise')
        ->select('f_id', 'f_user_id', 'f_name')
        ->where(['f_id' => $request->id])
        ->first();
      

        $getFranchiseImageData = FranchiseImages::where('fi_franchise_id',$request->id)->get();
      
        $mainCategoryData = FranchiseCategoryMain::where(['fcm_status'=>STATUS_ACTIVE])->orderBy('fcm_id', 'DESC')->get();
        return view('user_admin.franchiseImageList',['franchiseData' => $franchiseData ,'getFranchiseImageData'=>$getFranchiseImageData]);
    }

    public function franchiseImageStoreOldBK(Request $request){
        if ($request->hasfile('franchise_images')) {
            foreach ($request->file('franchise_images') as $file) {
                $filename = time() . '.' . $file->getClientOriginalName();
                $file->move('custom-images/franchise-images/', $filename);
                $file = new FranchiseImages();
                $file->fi_path = $filename;
                $file->fi_franchise_id = $request->fi_franchise_id;
                $file->fi_added_time = CURRENT_DATE_TIME;
                $file->save();
                $save = true;
            }
            if($save){
                return redirect('user-admin/franchiseImageList/'.$request->fi_franchise_id)->with('message',MSG_ADD_SUCCESS);
            }else{
                return redirect('user-admin/franchiseImageList/'.$request->fi_franchise_id)->with('message',MSG_ADD_ERROR);
            }

        }else{
            return redirect('user-admin/franchiseImageList/'.$request->fi_franchise_id)->with('message',MSG_ADD_ERROR);
        }
    }


    public function franchiseImageRemoveOldBK(Request $request)
    {
        
        $FranchiseImagesData = FranchiseImages::where(['fi_id'=>$request->id]);
        $FranchiseImagesData->delete();
        $imagePath = 'custom-images/franchise-images/'.$request->path;
        if(file_exists($imagePath)){
            unlink($imagePath);
        }
        return redirect('user-admin/franchiseImageList/'.$request->franchiseId)->with('msg', 'Record deleted successfully');
    }
    */
}
