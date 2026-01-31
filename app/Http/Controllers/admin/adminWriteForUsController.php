<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WriteForUs;
use Illuminate\Support\Facades\DB;

class adminWriteForUsController extends Controller
{
    public function writeForUsListView()
    {
        $writeForUsListArray = WriteForUs::orderBy('wfu_id', 'DESC')->get();
        return view('admin.writeForUsList',['writeForUsListArray'=>$writeForUsListArray]);
    }

    public function writeForUsDelete(Request $request) {

        $writeForUsDeleteArray = WriteForUs::where(['wfu_id'=>$request->id]);
        $writeForUsDeleteArray->delete();
        return redirect('/admin/writeForUsList')->with('msg', 'Record deleted successfully');
      }
}
