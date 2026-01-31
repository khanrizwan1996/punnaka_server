<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class loginController extends Controller
{
    public function adminLoginView()
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request){

        $request->validate([
            'admin_email' => 'required',
            'admin_password' => 'required',
        ]);

        $adminDetails = Admin:: where([
            ['admin_email',$request->admin_email],
            ['admin_password',$request->admin_password],
        ])->first();
            print_r($adminDetails);
        

        if($adminDetails){
            session(['adminId' => $adminDetails['admin_id']]);
            session(['adminName' => $adminDetails['admin_name']]);
            session(['adminEmail' => $adminDetails['admin_email']]);
            session(['adminPassword' => $adminDetails['admin_password']]);
            session(['adminContactNo' => $adminDetails['admin_contact_no']]);
           return redirect('admin/dashboard');
        }else{
            return redirect('admin/login')->with('error','Invalid Credentials');
        }
    }
    public function adminLogout(){
        Session::flush();
        return redirect('admin/login');
    }
}
