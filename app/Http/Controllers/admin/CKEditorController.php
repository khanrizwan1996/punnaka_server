<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time().'_'.Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/ckeditor'), $filename);
            $url = asset('uploads/ckeditor/'.$filename);
            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => $url
            ]);
        }
        return response()->json(['uploaded' => 0, 'error' => ['message' => 'No file uploaded.']]);
    }
