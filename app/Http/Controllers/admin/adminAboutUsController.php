<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
class adminAboutUsController extends Controller
{
    public function aboutUsView()
    {
        $aboutUsData = AboutUs::where('about_us_id',1)->first();
        //dd($aboutUsData);
        return view('admin.aboutUsEdit',['aboutUsData'=>$aboutUsData]);
    }

    public function aboutUsUpdate(Request $request){
        if($request->hasfile('about_us_image'))
        {
            $file = $request->file('about_us_image');
            $filename = $file->getClientOriginalName();
            $newFileName = time().'.'.$filename;
            $file->move('custom-images',$newFileName);
            if(isset($request->old_about_us_image)){
                unlink('custom-images/'.$request->old_about_us_image);
            }
        }else{
            $newFileName = $request->old_about_us_image;
        }

        $aboutUsUpdate =AboutUs::where("about_us_id",1)->update(
            [
                'about_us_title' => $request->about_us_title,
                'about_us_desc' => $request->about_us_desc,
                'about_us_image' => $newFileName,
                'about_us_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($aboutUsUpdate)
        {
            
            return redirect('admin/aboutUsEdit')->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/aboutUsEdit')->with('message',MSG_UPDATE_ERROR);
        }
    }

}
