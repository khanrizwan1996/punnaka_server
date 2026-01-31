<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mall;
use App\Models\Brands;
use App\Models\BrandImages;
use Illuminate\Support\Facades\DB;

class adminBrandsController extends Controller
{
    public function brandAddView(){
        $allActiveMallData = Mall::where(['mall_status' => STATUS_ACTIVE])->OrderBy('mall_id','DESC')->get(); 
        return view('admin.brandAdd',['allActiveMallData' => $allActiveMallData]);
    }

    public function brandListView(){
        $brandDataArray = Brands::join('mall','mall.mall_id', '=' , 'brands.brand_mall_id')->OrderBy('brands.brand_id','DESC')->get([
            'mall.mall_id','mall.mall_name','brands.brand_id','brands.brand_mall_id','brands.brand_name','brands.brand_contact_no','brands.brand_email','brands.brand_city','brands.brand_status','brands.brand_added_time'
                ]);
        return view('admin.brandList',['brandDataArray' => $brandDataArray]);   
    }
    public function brandStore(Request $request)
    {
        if($request->hasfile('brand_logo'))
        {
            $file = $request->file('brand_logo');
            $filename = $file->getClientOriginalName();
            $newFileName = time().'.'.$filename;
            $file->move('custom-images/brand',$newFileName);
        }
        $brandInsertData = Brands::create([
            'brand_mall_id' => $request->brand_mall_id,
            'brand_name' => $request->brand_name,
            'brand_contact_no' => $request->brand_contact_no,
            'brand_email' => $request->brand_email,
            'brand_main_cat' => $request->brand_main_cat,
            'brand_sub_cat' => $request->brand_sub_cat,
            'brand_prodct_services' => $request->brand_prodct_services,
            'brand_store_type' => $request->brand_store_type,
            'brand_floor' => $request->brand_floor,
            'brand_area' => $request->brand_area,
            'brand_location' => $request->brand_location,
            'brand_city' => $request->brand_city,
            'brand_store_timings' => $request->brand_store_timings,
            'brand_store_weekend_timings' => $request->brand_store_weekend_timings,
            'brand_store_weekday_timings' => $request->brand_store_weekday_timings,
            'brand_logo' => $newFileName,
            'brand_desc' => $request->brand_desc,
            'brand_meta_title' => $request->brand_meta_title,
            'brand_meta_keyword' => $request->brand_meta_keyword,
            'brand_meta_description' => $request->brand_meta_description,
            'brand_status' => STATUS_INACTIVE,
            'brand_added_time' => CURRENT_DATE_TIME
        ]);
        $brandLastInsertId = DB::getPdo()->lastInsertId();
            if($brandInsertData)
            {
                if ($request->hasfile('brand_img_path')) {
                    foreach ($request->file('brand_img_path') as $file) {
                        $filename = time() . '.' . $file->getClientOriginalName();
                        $file->move('custom-images/brand-multiple-images/', $filename);
                        $file = new BrandImages();
                        $file->brand_img_path = $filename;
                        $file->brand_img_mall_id = $brandLastInsertId;
                        $file->brand_img_status = STATUS_ACTIVE;
                        $file->brand_img_added_time = CURRENT_DATE_TIME;
                        $file->save();
                    }
                } 
            return redirect('/admin/brandAdd')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/admin/brandAdd')->with('message',MSG_ADD_ERROR);
        }
    }

    public function brandEditView(Request $request){
        $allActiveMallData = Mall::where(['mall_status' => STATUS_ACTIVE])->OrderBy('mall_id','DESC')->get(); 
        $brandSingleData = Brands::where('brand_id',$request->id)->first();
        $singlebrandImagesData = BrandImages::where('brand_img_brand_id',$request->id)->get();

        return view('admin.brandEdit',['allActiveMallData' => $allActiveMallData,'brandSingleData' => $brandSingleData, 'singlebrandImagesData' => $singlebrandImagesData]);
    }

    public function brandUpdate(Request $request)
    {
        if($request->hasfile('brand_logo'))
        {
            $imageFile = $request->file('brand_logo');
            $ImageFileName = $imageFile->getClientOriginalName();
            $newImage = time().'.'.$ImageFileName;
            $imageFile->move('custom-images/brand/',$newImage);
            if(isset($request->old_brand_logo)){
                unlink('custom-images/brand/'.$request->old_brand_logo);
            }
        }else{
            $newImage = $request->old_brand_logo;
        }

        $brandUpdateData =Brands::where("brand_id", $request->id)->update(
            [
                'brand_mall_id' => $request->brand_mall_id,
                'brand_name' => $request->brand_name,
                'brand_contact_no' => $request->brand_contact_no,
                'brand_email' => $request->brand_email,
                'brand_main_cat' => $request->brand_main_cat,
                'brand_sub_cat' => $request->brand_sub_cat,
                'brand_prodct_services' => $request->brand_prodct_services,
                'brand_store_type' => $request->brand_store_type,
                'brand_floor' => $request->brand_floor,
                'brand_area' => $request->brand_area,
                'brand_location' => $request->brand_location,
                'brand_city' => $request->brand_city,
                'brand_store_timings' => $request->brand_store_timings,
                'brand_store_weekend_timings' => $request->brand_store_weekend_timings,
                'brand_store_weekday_timings' => $request->brand_store_weekday_timings,
                'brand_logo' => $newImage,
                'brand_desc' => $request->brand_desc,
                'brand_meta_title' => $request->brand_meta_title,
                'brand_meta_keyword' => $request->brand_meta_keyword,
                'brand_meta_description' => $request->brand_meta_description,
                'brand_status' => $request->brand_status,
                'brand_changed_time' => CURRENT_DATE_TIME
            ]
        );
        if($brandUpdateData)
        {
            return redirect('admin/brandEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/brandEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }

    public function brandImagesStore(Request $request)
    {
        if ($request->hasfile('brand_img_path')) {
            foreach ($request->file('brand_img_path') as $file) {
                $filename = time() . '.' . $file->getClientOriginalName();
                $file->move('custom-images/brand-multiple-images/', $filename);
                $file = new BrandImages();
                $file->brand_img_path = $filename;
                $file->brand_img_brand_id = $request->id;
                $file->brand_img_status = STATUS_ACTIVE;
                $file->brand_img_added_time = CURRENT_DATE_TIME;
                $file->save();
            }
            return redirect('admin/brandEdit/'.$request->id)->with('message',MSG_IMAGES_ADD);
        }
        else{
            return redirect('admin/brandEdit/'.$request->id)->with('message',MSG_IMAGES_ERROR);
        }
    }

    public function brandImagesDelete(Request $request)
    {
        $brandImagesArray = BrandImages::where(['brand_img_id'=>$request->id]);
        $brandImagesArray->delete();
        $imagePath = 'custom-images/brand-multiple-images/'.$request->path;
        if(file_exists($imagePath)){
            unlink($imagePath);
        }
        if($brandImagesArray)
        {
            return redirect('/admin/brandEdit/'.$request->mall_id)->with('message', MSG_DELETE_SUCCESS);
        }else{
            return redirect('/admin/brandEdit/'.$request->mall_id)->with('message', MSG_DELETE_ERROR);
        }
    }

}
