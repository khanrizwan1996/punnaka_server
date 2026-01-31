<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class adminBannerController extends Controller
{
    public function HomebannerData(){
        $HomebannerData = Banner::where('banner_status',STATUS_ACTIVE)->orderBy('banner_id', 'DESC')->get();
        return $HomebannerData;
    }
    
    public function bannerListView(){
        $bannerData = Banner::orderBy('banner_id', 'DESC')->get();
        return view('admin.bannerList',['bannerData'=>$bannerData]);
    }

    public function bannerStore(Request $request)
    {
        $bannerImageFile = $request->file('banner_image');
        $bannerImageFileName = $bannerImageFile->getClientOriginalName();
        $newBannerImage = time().'.'.$bannerImageFileName;
        $bannerImageFile->move('custom-images/banner/',$newBannerImage);

        $bannerInsertData = Banner::create([
            'banner_title' => $request->banner_title,
            'banner_short_desc' => $request->banner_short_desc,
            'banner_image' => $newBannerImage,
            'banner_status' => STATUS_ACTIVE,
            'banner_added_time' => CURRENT_DATE_TIME
        ]);
        if($bannerInsertData)
        {
            return redirect('/admin/bannerList')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/admin/bannerList')->with('message',MSG_ADD_ERROR);
        }
    }

    public function bannerEditView(Request $request){
        $bannerSingleData = Banner::where('banner_id',$request->id)->first();
        return view('admin.bannerEdit',['bannerSingleData'=>$bannerSingleData]);
    }

    public function bannerUpdate(Request $request)
    {
        if($request->hasfile('banner_image'))
        {
            $bannerImageFile = $request->file('banner_image');
            $bannerImageFileName = $bannerImageFile->getClientOriginalName();
            $newBannerImage = time().'.'.$bannerImageFileName;
            $bannerImageFile->move('custom-images/banner/',$newBannerImage);
            unlink('custom-images/banner/'.$request->old_banner_image);
        }else{
            $newBannerImage = $request->old_banner_image;
        }

        $bannerUpdateData =Banner::where("banner_id", $request->id)->update(
            [
                'banner_title' => $request->banner_title,
                'banner_short_desc' => $request->banner_short_desc,
                'banner_image' => $newBannerImage,
                'banner_status' => $request->banner_status,
                'banner_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($bannerUpdateData)
        {
            return redirect('admin/bannerEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/bannerEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    } 

}
