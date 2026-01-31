<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mall;
use App\Models\MallImages;
class adminMallController extends Controller
{
    public function mallAddView(){
        return view('admin.mallAdd');
    }

    public function mallList(){
        $mallDataArray = Mall::orderBy('mall_id','DESC')->get();
        return view('admin.mallList',['mallDataArray' => $mallDataArray]);   
    }
    public function mallStore(Request $request)
    {
        if($request->hasfile('mall_logo'))
        {
            $file = $request->file('mall_logo');
            $filename = $file->getClientOriginalName();
            $newFileName = time().'.'.$filename;
            $file->move('custom-images/mall',$newFileName);
        }
        $mallData = Mall::create([
            'mall_name' => $request->mall_name,
            'mall_contact_no' => $request->mall_contact_no,
            'mall_email' => $request->mall_email,
            'mall_desc' => $request->mall_desc,
            'mall_location' => $request->mall_location,
            'mall_city' => $request->mall_city,
            'mall_opening_date' => $request->mall_opening_date,
            'mall_timing' => $request->mall_timing,
            'mall_store_timing' => $request->mall_store_timing,
            'mall_website_link' => $request->mall_website_link,
            'mall_meta_title' => $request->mall_meta_title,
            'mall_meta_keyword' => $request->mall_meta_keyword,
            'mall_meta_description' => $request->mall_meta_description,
            'mall_logo' => $newFileName,
            'mall_added_time' => CURRENT_DATE_TIME
        ]);
        $mallLastInsertId = DB::getPdo()->lastInsertId();
            if($mallData)
            {
                if ($request->hasfile('mall_img_path')) {
                    foreach ($request->file('mall_img_path') as $file) {
                        $filename = time() . '.' . $file->getClientOriginalName();
                        $file->move('custom-images/mall-multiple-images/', $filename);
                        $file = new MallImages();
                        $file->mall_img_path = $filename;
                        $file->mall_img_mall_id = $mallLastInsertId;
                        $file->mall_img_status = STATUS_ACTIVE;
                        $file->mall_img_added_time = CURRENT_DATE_TIME;
                        $file->save();
                    }
                }

                
            return redirect('/admin/mallAdd')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/admin/mallAdd')->with('message',MSG_ADD_ERROR);
        }
    }

    public function mallEditView(Request $request)
    {
        $mallSingleData = Mall::where('mall_id',$request->id)->first();
        $singleMallImagesData = MallImages::where('mall_img_mall_id',$request->id)->get();
        return view('admin.mallEdit',['mallSingleData' => $mallSingleData, 'singleMallImagesData' => $singleMallImagesData]);
    }

    public function mallUpdate(Request $request)
    {
        if($request->hasfile('mall_logo'))
        {
            $imageFile = $request->file('mall_logo');
            $ImageFileName = $imageFile->getClientOriginalName();
            $newImage = time().'.'.$ImageFileName;
            $imageFile->move('custom-images/mall/',$newImage);
            if(isset($request->old_mall_logo)){
                unlink('custom-images/mall/'.$request->old_mall_logo);
            }
        }else{
            $newImage = $request->old_mall_logo;
        }

        $mallUpdateData =Mall::where("mall_id", $request->id)->update(
            [
                'mall_name' => $request->mall_name,
                'mall_contact_no' => $request->mall_contact_no,
                'mall_email' => $request->mall_email,
                'mall_desc' => $request->mall_desc,
                'mall_location' => $request->mall_location,
                'mall_city' => $request->mall_city,
                'mall_opening_date' => $request->mall_opening_date,
                'mall_timing' => $request->mall_timing,
                'mall_store_timing' => $request->mall_store_timing,
                'mall_website_link' => $request->mall_website_link,
                'mall_logo' => $newImage,
                'mall_meta_title' => $request->mall_meta_title,
                'mall_meta_keyword' => $request->mall_meta_keyword,
                'mall_meta_description' => $request->mall_meta_description,
                'mall_status' => $request->mall_status,
                'mall_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($mallUpdateData)
        {
            return redirect('admin/mallEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/mallEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }
    public function mallImagesStore(Request $request)
    {
        if ($request->hasfile('mall_img_path')) {
            foreach ($request->file('mall_img_path') as $file) {
                $filename = time() . '.' . $file->getClientOriginalName();
                $file->move('custom-images/mall-multiple-images/', $filename);
                $file = new MallImages();
                $file->mall_img_path = $filename;
                $file->mall_img_mall_id = $request->id;
                $file->mall_img_status = STATUS_ACTIVE;
                $file->mall_img_added_time = CURRENT_DATE_TIME;
                $file->save();
            }
            return redirect('admin/mallEdit/'.$request->id)->with('message',MSG_IMAGES_ADD);
        }
        else{
            return redirect('admin/mallEdit/'.$request->id)->with('message',MSG_IMAGES_ERROR);
        }
    }

    public function mallImagesDelete(Request $request)
    {
        $mallImagesArray = MallImages::where(['mall_img_id'=>$request->id]);
        $mallImagesArray->delete();
        $imagePath = 'custom-images/mall-multiple-images/'.$request->path;
        if(file_exists($imagePath)){
            unlink($imagePath);
        }
        if($mallImagesArray)
        {
            return redirect('/admin/mallEdit/'.$request->mall_id)->with('message', MSG_DELETE_SUCCESS);
        }else{
            return redirect('/admin/mallEdit/'.$request->mall_id)->with('message', MSG_DELETE_ERROR);
        }
    }

    public function getmallBrands(Request $request){
        $mallBrandsData = Brands::where(['brand_status'=>STATUS_ACTIVE,'brand_mall_id'=>$request->mall_id])->orderBy('brand_id', 'DESC')->get();
        $optionTag = ' <option value="">Select Brands</option>';
        foreach($mallBrandsData as $mallBrandsRow){
            $optionTag .= ' <option value="'.$mallBrandsRow['brand_mall_id'].'">'.$mallBrandsRow['brand_name'].'</option>';
        }
        echo $optionTag;
    }

}
