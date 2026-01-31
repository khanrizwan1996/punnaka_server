<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurServices;
class adminOurServicesController extends Controller
{
    public function ourServicesListView()
    {
        $ourServicesListArray = OurServices::orderBy('se_id', 'DESC')->get();
        return view('admin.ourServicesList',['ourServicesListArray'=>$ourServicesListArray]);
    }

    public function OurServiceDelete(Request $request) {

        $ourServiceDeleteArray = OurServices::where(['se_id'=>$request->id]);
        $ourServiceDeleteArray->delete();
        return redirect('/admin/ourServicesList')->with('msg', 'Record deleted successfully');
      }
}
