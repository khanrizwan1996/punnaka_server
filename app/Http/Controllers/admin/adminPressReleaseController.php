<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PressRelease;
use App\Models\CategoryMain;
use App\Models\PressReleaseImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class adminPressReleaseController extends Controller
{
    public function pressReleaseListView(){
        $PressReleaseArray = PressRelease::select('pr_id', 'pr_status', 'pr_main_cat', 'pr_sub_cat', 'pr_title', 'pr_publisher', 'pr_author', 'pr_added_time', 'pr_changed_time')->orderBy('pr_id', 'DESC')->get();
        return view('admin.pressReleaseList', compact('PressReleaseArray'));
    }

    public function pressReleaseAddView(){
        $blogCategoryMainData = CategoryMain::where(['cat_main_type' => TYPE_BLOG, 'cat_main_status' => STATUS_ACTIVE])
            ->toBase()
            ->orderBy('cat_main_id', 'DESC')
            ->get();
        return view('admin.pressReleaseAdd', ['blogCategoryMainData' => $blogCategoryMainData]);
    }

    public function pressReleaseStore(Request $request){

        $newFileName ='';
        $newFileAttachmentName ='';

        if($request->hasfile('pr_logo')) {
            $file = $request->file('pr_logo');
            $filename = $file->getClientOriginalName();
            $newFileName = uniqid() . '-' . time() . '-' . $filename;
            $file->move('custom-images/press-release', $newFileName);
        }

        if ($request->hasfile('pr_attachment')) {
            $fileAttachment = $request->file('pr_attachment');
            $fileAttachmentName = $fileAttachment->getClientOriginalName();
            $newFileAttachmentName = uniqid() . '-' . time() . '-' . $fileAttachmentName;
            $fileAttachment->move('custom-images/press-release', $newFileAttachmentName);
        }

        $blogCategoryData = CategoryMain::select('category_sub.cat_sub_id', 'category_sub.cat_sub_main_id', 'category_sub.cat_sub_name', 'category_main.cat_main_name')
            ->join('category_sub', 'category_sub.cat_sub_main_id', '=', 'category_main.cat_main_id')
            ->where('category_main.cat_main_type', TYPE_BLOG)
            ->where('category_main.cat_main_id', $request->pr_main_cat)
            ->where('category_sub.cat_sub_id', $request->pr_sub_cat)
            ->orderBy('category_sub.cat_sub_id', 'DESC')
            ->first();

        $pressReleaseData = PressRelease::create([
            'pr_main_cat' => $blogCategoryData['cat_main_name'],
            'pr_sub_cat' => $blogCategoryData['cat_sub_name'],

            'pr_title' => $request->pr_title,
            'pr_title1' => $request->pr_title1,
            'pr_country' => $request->pr_country,
            'pr_state' => $request->pr_state,
            'pr_city' => $request->pr_city,

            'pr_content_location' => $request->pr_content_location,
            'pr_publisher' => $request->pr_publisher,
            'pr_author' => $request->pr_author,
            'pr_publish_date_time' => $request->pr_publish_date_time,
            'pr_modified_date_time' => $request->pr_modified_date_time,

            'pr_video_embedded' => $request->pr_video_embedded,
            'pr_meta_title' => $request->pr_meta_title,
            'pr_meta_keyword' => $request->pr_meta_keyword,
            'pr_meta_desc' => $request->pr_meta_desc,
            'pr_admin_comment' => $request->pr_admin_comment,

            'pr_desc' => $request->pr_desc,
            'pr_logo' => $newFileName,
            'pr_attachment' => $newFileAttachmentName,

            'pr_status' => STATUS_ACTIVE,
            'pr_added_time' => CURRENT_DATE_TIME,
        ]);
        if ($pressReleaseData) {
            $pressReleaseLastInsertId = DB::getPdo()->lastInsertId();
            
            if($request->hasfile('pri_path')){
                foreach ($request->file('pri_path') as $file) {
                    $filename = uniqid() . '-' . time() . '-' . $file->getClientOriginalName();
                    $file->move('custom-images/press-release-multiple-images/', $filename);
                    $file = new PressReleaseImages();
                    $file->pri_path = $filename;
                    $file->pri_press_release_id = $pressReleaseLastInsertId;
                    $file->pri_added_time = CURRENT_DATE_TIME;
                    $file->save();
                }
            }
            return redirect('/admin/pressReleaseAdd')->with('message', MSG_ADD_SUCCESS);
        } else {
            return redirect('/admin/pressReleaseAdd')->with('message', MSG_ADD_ERROR);
        }
    }

    public function pressReleaseEditView(Request $request){

        $blogCategoryMainData = CategoryMain::where(['cat_main_type' => TYPE_BLOG, 'cat_main_status' => STATUS_ACTIVE])
            ->toBase()
            ->orderBy('cat_main_id', 'DESC')
            ->get();

        $pressReleaseData = PressRelease::where('pr_id', $request->id)->toBase()->first();

        $pressReleaseImagesData = PressReleaseImages::where('pri_press_release_id', $request->id)->toBase()->orderBy('pri_id', 'DESC')->get();

        return view('admin.pressReleaseEdit', ['blogCategoryMainData' => $blogCategoryMainData, 'pressReleaseData' => $pressReleaseData, 'pressReleaseImagesData' => $pressReleaseImagesData]);
    }

    public function pressReleaseUpdate(Request $request){

        if (isset($request->pr_main_cat) && isset($request->pr_sub_cat)) {
            $blogCategoryData = CategoryMain::select('category_sub.cat_sub_id', 'category_sub.cat_sub_main_id', 'category_sub.cat_sub_name', 'category_main.cat_main_name')
                ->join('category_sub', 'category_sub.cat_sub_main_id', '=', 'category_main.cat_main_id')
                ->where('category_main.cat_main_type', TYPE_BLOG)
                ->where('category_main.cat_main_id', $request->pr_main_cat)
                ->where('category_sub.cat_sub_id', $request->pr_sub_cat)
                ->orderBy('category_sub.cat_sub_id', 'DESC')
                ->first();
            $catMainName = $blogCategoryData['cat_main_name'];
            $catSubName = $blogCategoryData['cat_sub_name'];
        } else {
            $catMainName = $request->old_pr_main_cat;
            $catSubName = $request->old_pr_sub_cat;
        }

        if ($request->hasfile('pr_logo')) {
            $file = $request->file('pr_logo');
            $filename = $file->getClientOriginalName();
            $newFileName = uniqid() . '-' . time() . '-' . $filename;
            $file->move('custom-images/press-release', $newFileName);
            if(isset($request->old_pr_logo)){
                unlink('custom-images/press-release/' . $request->old_pr_logo);
            }
        } else {
            $newFileName = $request->old_pr_logo;
        }

        if ($request->hasfile('pr_attachment')) {
            $fileAttachment = $request->file('pr_attachment');
            $fileAttachmentName = $fileAttachment->getClientOriginalName();
            $newFileAttachmentName = uniqid() . '-' . time() . '-' . $fileAttachmentName;
            $fileAttachment->move('custom-images/press-release', $newFileAttachmentName);
            if (isset($request->old_pr_attachment)) {
                unlink('custom-images/press-release/' . $request->old_pr_attachment);
            }
        } else {
            $newFileAttachmentName = $request->old_pr_attachment;
        }

        $PressReleaseUpdateData = PressRelease::where('pr_id', $request->pr_id)->update([
            'pr_main_cat' => $catMainName,
            'pr_sub_cat' => $catSubName,
            'pr_title' => $request->pr_title,
            'pr_title1' => $request->pr_title1,
            'pr_country' => $request->pr_country,
            'pr_state' => $request->pr_state,
            'pr_city' => $request->pr_city,

            'pr_content_location' => $request->pr_content_location,
            'pr_publisher' => $request->pr_publisher,
            'pr_author' => $request->pr_author,
            'pr_publish_date_time' => $request->pr_publish_date_time,
            'pr_modified_date_time' => $request->pr_modified_date_time,

            'pr_video_embedded' => $request->pr_video_embedded,
            'pr_meta_title' => $request->pr_meta_title,
            'pr_meta_keyword' => $request->pr_meta_keyword,
            'pr_meta_desc' => $request->pr_meta_desc,
            'pr_admin_comment' => $request->pr_admin_comment,

            'pr_desc' => $request->pr_desc,
            'pr_logo' => $newFileName,
            'pr_attachment' => $newFileAttachmentName,

            'pr_status' => $request->pr_status,
            'pr_changed_time' => CURRENT_DATE_TIME,
        ]);
        if ($PressReleaseUpdateData) {
            return redirect('admin/pressReleaseEdit/'.$request->pr_id)->with('message', MSG_UPDATE_SUCCESS);
        } else {
            return redirect('admin/pressReleaseEdit/'. $request->pr_id)->with('message', MSG_UPDATE_ERROR);
        }
    }
    public function pressReleaseImages(Request $request)
    {
        if ($request->hasfile('pri_path')) {
            foreach ($request->file('pri_path') as $file) {
                $filename = uniqid() . '-' . time() . '-' . $file->getClientOriginalName();
                $file->move('custom-images/press-release-multiple-images/', $filename);
                $file = new PressReleaseImages();
                $file->pri_path = $filename;
                $file->pri_press_release_id = $request->pr_id;
                $file->pri_added_time = CURRENT_DATE_TIME;
                $file->save();
            }
            return redirect('admin/pressReleaseEdit/'.$request->pr_id)->with('message', MSG_IMAGES_ADD);
        } else {
            return redirect('admin/pressReleaseEdit/'.$request->pr_id)->with('message', MSG_IMAGES_ERROR);
        }
    }

    public function pressReleaseImagesDelete(Request $request){

        $imagesArray = PressReleaseImages::where('pri_id', $request->id);
        $imagesArray->delete();
        $imagePath = 'custom-images/press-release-multiple-images/'.$request->path;

        if(file_exists($imagePath)){
            unlink($imagePath);
        }
        if($imagesArray){
            return redirect('/admin/pressReleaseEdit/'.$request->press_release_id)->with('message', MSG_DELETE_SUCCESS);
        }else{
            return redirect('/admin/pressReleaseEdit/'.$request->press_release_id)->with('message', MSG_DELETE_ERROR);
        }
    }

}
