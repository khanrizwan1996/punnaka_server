<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\websiteContent;
class adminWebsiteContentController extends Controller{
    
    public function websiteContentEditView(){
        $getWebsiteContentData = websiteContent::OrderBy('wc_id','DESC')->first(); 
        return view('admin.websiteContentEdit',['getWebsiteContentData' => $getWebsiteContentData]);
    }
    public function websiteContentUpdate(Request $request){

        if($request->hasfile('wc_header_logo')){
            $headerLogoFile = $request->file('wc_header_logo');
            $headerLogoFileName = $headerLogoFile->getClientOriginalName();
            $headerLogo = time().'.'.$headerLogoFileName;
            $headerLogoFile->move('custom-images/',$headerLogo);

            if(isset($request->old_wc_header_logo) && file_exists(public_path('custom-images'.$request->old_wc_header_logo))){
                unlink('custom-images/'.$request->old_wc_header_logo);
            }
        }else{
            $headerLogo = $request->old_wc_header_logo;
        }

        if($request->hasfile('wc_footer_logo')){
            $footerLogoFile = $request->file('wc_footer_logo');
            $footerLogoFileName = $footerLogoFile->getClientOriginalName();
            $footerLogo = time().'.'.$footerLogoFileName;
            $footerLogoFile->move('custom-images/',$footerLogo);
            if(isset($request->old_wc_footer_logo) && file_exists(public_path('custom-images'.$request->old_wc_footer_logo))){
                unlink('custom-images/'.$request->old_wc_footer_logo);
            }
        }else{
            $footerLogo = $request->old_wc_footer_logo;
        }

        $websiteContentUpdateDate =websiteContent::where("wc_id", 1)->update([
            'wc_header_logo' => $headerLogo,
            'wc_footer_logo' => $footerLogo,
            'wc_footer_content' => $request->wc_footer_content,
            'wc_contact_no' => $request->wc_contact_no,
            'wc_email_address' => $request->wc_email_address,
            'wc_address' => $request->wc_address,
            'wc_fb_link' => $request->wc_fb_link,
            'wc_insta_link' => $request->wc_insta_link,
            'wc_pinterest_link' => $request->wc_pinterest_link,
            'wc_quora_link' => $request->wc_quora_link,
            'wc_whatsapp_link' => $request->wc_whatsapp_link,
            'wc_update_time' => CURRENT_DATE_TIME
            ]
        );
        if($websiteContentUpdateDate){
            return redirect('admin/websiteContentEdit')->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/websiteContentEdit')->with('message',MSG_UPDATE_ERROR);
        }
    }

     public function websiteContentTCAndPPView(){
        $getWebsiteContentData = websiteContent::OrderBy('wc_id','DESC')->first(); 
        return view('admin.tcPolicyEdit',['getWebsiteContentData' => $getWebsiteContentData]);
    }

    public function websiteContentTCAndPPUpdate(Request $request){

        $type = $request->type;
        if($type == 'tc'){
            $columnName = 'wc_term_condition';
            $value = $request->wc_term_condition;
        }else if($type == 'pp'){
            $columnName = 'wc_privacy_policy';
            $value = $request->wc_privacy_policy;
        }

        $policyData =websiteContent::where("wc_id", 1)->update([
            $columnName => $value,
            'wc_update_time' => CURRENT_DATE_TIME
            ]
        );
        if($policyData){
            return redirect('admin/policyEdit/'.$type)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/policyEdit/'.$type)->with('message',MSG_UPDATE_ERROR);
        }
    }

}
