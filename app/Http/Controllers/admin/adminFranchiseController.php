<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\FranchiseCategoryMain;
use App\Models\FranchiseCategorySub;
use Illuminate\Support\Facades\DB;
use App\Models\FranchiseCategoryChild;
use App\Models\FranchiseLocationDetail;
use App\Models\FranchiseImages;
use Illuminate\Http\Request;
use App\Models\User;

class adminFranchiseController extends Controller
{
    public function franchiseListView(){
        $franchiseDetail = Franchise::orderBy('f_id', 'DESC')
            ->get();
        return view('admin.franchiseList', ['franchiseDetail' => $franchiseDetail]);
    }
    public function franchiseAddView(){
         $userData = User::select('id', 'name')
            ->where(['status' => STATUS_ACTIVE])
            ->toBase()
            ->orderBy('id', 'DESC')
            ->get();
        $mainCategoryData = FranchiseCategoryMain::where(['fcm_status'=>STATUS_ACTIVE])->orderBy('fcm_id', 'DESC')->get();
        return view('admin.franchiseAdd',['mainCategoryData'=>$mainCategoryData, 'userData' => $userData]);
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
            'f_user_id' => $request->f_user_id,
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

            'f_meta_title' => $request->f_meta_title,
            'f_meta_keyword' => $request->f_meta_keyword,
            'f_meta_description' => $request->f_meta_description,
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

            // $msg = 'Your franchisee listing has been submitted successfully!\n\nWe’ve received your details and our review team will verify them soon. You’ll receive an update once it goes live on Punnaka.com.\n\nFor any assistance, WhatsApp us at +91-7875155538 Or email us at info@punnaka.com';
            // echo "<script>alert(\"$msg\")
            // window.location.href='/admin/franchiseAdd';
            // </script>";

            return redirect('/admin/franchiseAdd')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/admin/franchiseAdd')->with('message',MSG_ADD_ERROR);
        }
    }

    public function franchiseCategoryMainListView(){
        $franchiseCategoryMainList = FranchiseCategoryMain::orderBy('fcm_id', 'DESC')->get();
        return view('admin.franchiseCategoryMainList',['franchiseCategoryMainList'=>$franchiseCategoryMainList]);
    }

    public function franchiseCategoryMainStore(Request $request){
        $franchiseCategoryMainInsert = FranchiseCategoryMain::create([
            'fcm_name' => $request->cat_main_name,
            'fcm_status' => STATUS_INACTIVE,
            'fcm_added_time' => CURRENT_DATE_TIME
        ]);
        if($franchiseCategoryMainInsert){
            return redirect('admin/franchiseCategoryMainList')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('admin/franchiseCategoryMainList')->with('message',MSG_ADD_ERROR);
        }
    } 

    public function franchiseCategoryMainEditView(Request $request){
        $franchiseCategoryMainSingleData = FranchiseCategoryMain::where(['fcm_id'=>$request->id])->first();
        return view('admin.franchiseCategoryMainEdit',['franchiseCategoryMainSingleData'=>$franchiseCategoryMainSingleData]);
    }

     public function franchiseCategoryMainUpdate(Request $request){
        $businessListingCategoryMainUpdate =FranchiseCategoryMain::where(['fcm_id'=>$request->id])->update(
            [
                'fcm_name' => $request->fcm_name,
                'fcm_status' => $request->fcm_status,
                'fcm_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($businessListingCategoryMainUpdate)
        {
            return redirect('admin/franchiseCategoryMainEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/franchiseCategoryMainEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }

    
    public function franchiseCategorySubListView(){
        $franchiseListingMainData = FranchiseCategoryMain::where(['fcm_status' => STATUS_ACTIVE])->orderBy('fcm_id', 'DESC')->get();

        $franchiseListingSubData = FranchiseCategorySub::join('franchise_category_main','franchise_category_main.fcm_id', '=' , 'franchise_category_sub.fcs_cat_main_id')->orderBy('fcs_id', 'DESC')->get(['franchise_category_sub.fcs_id','franchise_category_sub.fcs_cat_main_id', 'franchise_category_sub.fcs_name', 'franchise_category_sub.fcs_status', 'franchise_category_sub.fcs_added_time', 'franchise_category_sub.fcs_changed_time','franchise_category_main.fcm_name']);

        return view('admin.franchiseCategorySubList',['franchiseListingSubData'=>$franchiseListingSubData, 'franchiseListingMainData' => $franchiseListingMainData]);
    }

    public function franchiseCategorySubStore(Request $request){
        $franchiseCategorySubInsert = FranchiseCategorySub::create([
            'fcs_cat_main_id' => $request->fcs_cat_main_id,
            'fcs_name' => $request->fcs_name,
            'fcs_status' => STATUS_INACTIVE,
            'fcs_added_time' => CURRENT_DATE_TIME
        ]);
        if($franchiseCategorySubInsert){
            return redirect('admin/franchiseCategorySubList')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('admin/franchiseCategorySubList')->with('message',MSG_ADD_ERROR);
        }
    }

    public function franchiseCategorySubEditView(Request $request){
        $franchiseListingMainData = FranchiseCategoryMain::where(['fcm_status' => STATUS_ACTIVE])->orderBy('fcm_id', 'DESC')->get();

        $franchiseListingSubSingleData = FranchiseCategorySub::where('fcs_id',$request->id)->first();
        return view('admin.franchiseCategorySubEdit',['franchiseListingSubSingleData'=>$franchiseListingSubSingleData, 'franchiseListingMainData' => $franchiseListingMainData]);
    }

     public function franchiseCategorySubUpdate(Request $request){
    
        $franchiseCategorySubUpdate =FranchiseCategorySub::where("fcs_id", $request->id)->update(
            [
                'fcs_cat_main_id' => $request->fcs_cat_main_id,
                'fcs_name' => $request->fcs_name,
                'fcs_status' => $request->fcs_status,
                'fcs_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($franchiseCategorySubUpdate){
            return redirect('admin/franchiseCategorySubEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/franchiseCategorySubEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }

    public function franchiseCategoryChildListView(){
        $franchiseListingMainData = FranchiseCategoryMain::where(['fcm_status' => STATUS_ACTIVE])->orderBy('fcm_id', 'DESC')->get();
        $franchiseListingChildData = DB::table('franchise_category_child')
        ->join('franchise_category_main', 'franchise_category_child.fcc_cat_main_id', '=', 'franchise_category_main.fcm_id')
        ->join('franchise_category_sub', 'franchise_category_child.fcc_cat_sub_id', '=', 'franchise_category_sub.fcs_id')
        ->select('franchise_category_child.*', 'franchise_category_sub.fcs_name', 'franchise_category_main.fcm_name')
        ->orderBy('franchise_category_child.fcc_id', 'DESC')
        ->get();

        return view('admin.franchiseCategoryChildList',['franchiseListingChildData'=>$franchiseListingChildData, 'franchiseListingMainData' => $franchiseListingMainData]);
    }

    public function franchiseCategoryChildStore(Request $request){
        $franchiseCategoryChildInsert = FranchiseCategoryChild::create([
            'fcc_cat_main_id' => $request->fcc_cat_main_id,
            'fcc_cat_sub_id' => $request->fcc_cat_sub_id,
            'fcc_name' => $request->fcc_name,
            'fcc_status' => STATUS_INACTIVE,
            'fcc_added_time' => CURRENT_DATE_TIME
        ]);
        if($franchiseCategoryChildInsert){
            return redirect('admin/franchiseCategoryChildList')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('admin/franchiseCategoryChildList')->with('message',MSG_ADD_ERROR);
        }
    }

    public function franchiseCategoryChildEditView(Request $request){
        $franchiseListingMainData = FranchiseCategoryMain::where(['fcm_status' => STATUS_ACTIVE])->orderBy('fcm_id', 'DESC')->get();
        $franchiseListingChildSingleData = DB::table('franchise_category_child')
        ->join('franchise_category_main', 'franchise_category_child.fcc_cat_main_id', '=', 'franchise_category_main.fcm_id')
        ->join('franchise_category_sub', 'franchise_category_child.fcc_cat_sub_id', '=', 'franchise_category_sub.fcs_id')
        ->select('franchise_category_child.*', 'franchise_category_sub.fcs_name', 'franchise_category_main.fcm_name')
        ->where('fcc_id',$request->id)
        ->first();

        return view('admin.franchiseCategoryChildEdit',['franchiseListingChildSingleData'=>$franchiseListingChildSingleData, 'franchiseListingMainData' => $franchiseListingMainData]);
    }

     public function franchiseCategoryChildUpdate(Request $request){

        if(isset($request->fcc_cat_main_id) && isset($request->fcc_cat_sub_id) && !empty($request->fcc_cat_main_id) && !empty($request->fcc_cat_sub_id)){
            $fcc_cat_main_id = $request->fcc_cat_main_id;
            $fcc_cat_sub_id = $request->fcc_cat_sub_id;
        }else{
            $fcc_cat_main_id = $request->old_fcc_cat_main_id;
            $fcc_cat_sub_id = $request->old_fcc_cat_sub_id;
        }

        $franchiseCategorySubUpdate =FranchiseCategoryChild::where("fcc_id", $request->id)->update([
            'fcc_cat_main_id' => $fcc_cat_main_id,
            'fcc_cat_sub_id' => $fcc_cat_sub_id,
            'fcc_name' => $request->fcc_name,
            'fcc_status' => $request->fcs_status,
            'fcc_changed_time' => CURRENT_DATE_TIME
        ]);
        if($franchiseCategorySubUpdate){
            return redirect('admin/franchiseCategoryChildEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/franchiseCategoryChildEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }

     public function franchiseEditView(Request $request){
        $getFranchiseData = Franchise::where('f_id',$request->id)->first();
        $mainCategoryData = FranchiseCategoryMain::where(['fcm_status'=>STATUS_ACTIVE])->orderBy('fcm_id', 'DESC')->get();
        $getFranchiseLocationDetail = FranchiseLocationDetail::where(['fld_franchise_id'=>$request->id])->orderBy('fld_id', 'ASC')->get();
        return view('admin.franchiseEdit',['getFranchiseData'=>$getFranchiseData,'mainCategoryData'=>$mainCategoryData, 'getFranchiseLocationDetail' => $getFranchiseLocationDetail]);
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
            'f_admin_comment' => $request->f_admin_comment,

            'f_meta_title' => $request->f_meta_title,
            'f_meta_keyword' => $request->f_meta_keyword,
            'f_meta_description' => $request->f_meta_description,


            'f_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($franchiseUpdateData){
            return redirect(ADMIN_URL.'franchiseEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect(ADMIN_URL.'franchiseEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }

    public function franchiseOtherDetailListView(Request $request){
        $franchiseData = DB::table('franchise')
        ->select('f_id', 'f_user_id', 'f_name')
        ->where(['f_id' => $request->id])
        ->first();      

        $getFranchiseImageData = FranchiseImages::where('fi_franchise_id',$request->id)->orderBy('fi_id', 'DESC')->get();
        $getFranchiseLocationDetail = FranchiseLocationDetail::where(['fld_franchise_id'=>$request->id])->orderBy('fld_id', 'DESC')->get();
        return view('admin.franchiseOtherDetailList',['franchiseData' => $franchiseData ,'getFranchiseImageData'=>$getFranchiseImageData,'getFranchiseLocationDetail' => $getFranchiseLocationDetail]);
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
                return redirect('admin/franchiseOtherDetailList/'.$request->fi_franchise_id)->with('message',MSG_ADD_SUCCESS);
            }else{
                return redirect('admin/franchiseOtherDetailList/'.$request->fi_franchise_id)->with('message',MSG_ADD_ERROR);
            }
        }else{
            return redirect('admin/franchiseOtherDetailList/'.$request->fi_franchise_id)->with('message',MSG_ADD_ERROR);
        }
    }

    public function franchiseImageRemove(Request $request){
        $FranchiseImagesData = FranchiseImages::where(['fi_id'=>$request->id]);
        $FranchiseImagesData->delete();
        $imagePath = 'custom-images/franchise-images/'.$request->path;
        if(file_exists($imagePath)){
            unlink($imagePath);
        }
        return redirect('admin/franchiseOtherDetailList/'.$request->franchiseId)->with('msg', 'Record deleted successfully');
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
                return redirect('admin/franchiseOtherDetailList/'.$request->fld_franchise_id)->with('message',MSG_ADD_SUCCESS);
            }else{
                return redirect('admin/franchiseOtherDetailList/'.$request->fld_franchise_id)->with('message',MSG_ADD_ERROR);
            }
         }else{
            return redirect('admin/franchiseOtherDetailList/'.$request->fld_franchise_id)->with('message',MSG_ADD_ERROR);
        }
    }

    public function franchiseLocationDetailRemove(Request $request){
        $FranchiseLocationDetailData = FranchiseLocationDetail::where(['fld_id'=>$request->id]);
        $FranchiseLocationDetailData->delete();
        if($FranchiseLocationDetailData){
            return redirect('admin/franchiseOtherDetailList/'.$request->franchiseId)->with('msg', 'Record deleted successfully');
        }else{
            return redirect('admin/franchiseOtherDetailList/'.$request->franchiseId)->with('msg', 'No Record deleted');
        }
    }

}
