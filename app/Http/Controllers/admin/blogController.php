<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class blogController extends Controller
{
    public function index()
    {
        $blogData = Blog::orderBy('blog_id', 'DESC')->get();
        return view('admin.blogList',['BlogAllData'=>$blogData]);
    }

    public function blogAddView(){
        return view('admin.blogAdd');
    }

    public function blogStore(Request $request)
    {
        //dd($request->all());
        if($request->hasfile('blog_image'))
        {
            $file = $request->file('blog_image');
            $filename = $file->getClientOriginalName();
            $newFileName = time().'.'.$filename;
            $file->move('custom-images/blogs',$newFileName);
        }
        $blogData = Blog::create([
            'blog_title' => $request->blog_title,
            'blog_detail' => $request->blog_detail,
            'blog_image' => $newFileName,
            'blog_meta_title' => $request->blog_meta_title,
            'blog_meta_keword' => $request->blog_meta_keword,
            'blog_meta_description' => $request->blog_meta_description,
            'blog_admin_comment' => $request->blog_admin_comment,
            'blog_added_timestamp' => CURRENT_DATE_TIME
        ]);
        if($blogData)
        {
            return redirect('/admin/blogAdd')->with('message',MSG_ADD_SUCCESS);
        }else{
            return redirect('/admin/blogAdd')->with('message',MSG_ADD_ERROR);
        }
    }

    public function blogEditView(Request $request)
    {
        $blogData = blog::where('blog_id',$request->id)->first();
        return view('admin.blogEdit',['blogData'=>$blogData]);

        /*DB::enableQueryLog();
        $blogData = blog::where('b_id',$request->id)->first();
        dd(DB::getQueryLog()); */

    }

    public function blogUpdate(Request $request)
    {
        //dd();
        if($request->hasfile('blog_image'))
        {
            $file = $request->file('blog_image');
            $filename = $file->getClientOriginalName();
            $newFileName = time().'.'.$filename;
            $file->move('custom-images/blogs',$newFileName);
            unlink('custom-images/blogs/'.$request->old_blog_image);
        }else{
            $newFileName = $request->old_blog_image;
        }

        $blogUpdate =Blog::where("blog_id", $request->id)->update(
            [
                'blog_title' => $request->blog_title,
                'blog_detail' => $request->blog_detail,
                'blog_image' => $newFileName,
                'blog_meta_title' => $request->blog_meta_title,
                'blog_meta_keword' => $request->blog_meta_keword,
                'blog_meta_description' => $request->blog_meta_description,
                'blog_admin_comment' => $request->blog_admin_comment,
                'blog_status' => $request->blog_status,
                'blog_changed_timestamp' => CURRENT_DATE_TIME
            ]
        );
        if($blogUpdate)
        {
            return redirect('admin/blogEdit/'.$request->id)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/blogEdit/'.$request->id)->with('message',MSG_UPDATE_ERROR);
        }
    }

}
