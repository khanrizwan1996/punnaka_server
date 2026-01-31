<?php

namespace App\Http\Controllers\user_admin;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class userAuthController extends Controller
{
    public function registerView(){
        return view('user_admin.register');
    }
    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }

    public function googleHandel(){
        try{
            $googleUser = Socialite::driver('google')->stateless()->user();
            $checkUser = User::where('email',$googleUser->email)->first();
            if(!$checkUser){
                $user = User::create([
                'name'=> $googleUser->name,
                'email'=>$googleUser->email,
                'password' => md5(12345)
                ]);
                Auth::login($user);
            }else{
                Auth::login($checkUser);
            }
            return redirect('user-admin/dashboard');
        }catch (Exception $e){
            dd($e->getMessage());
        }
        
    }

    public function facebookRedirect(){
        return Socialite::driver('facebook')->redirect();
    }


    public function loginWithFacebook(){
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            $existingUser = User::where('facebook_id', $facebookUser->id)->orWhere('email', $facebookUser->email)->first();
            
           //echo "\n ID__ ".$facebookUser->id;
            //dd($existingUser);
            if($existingUser){
                if($existingUser->facebook_id !== $facebookUser->id) {
                    $existingUser->facebook_id = $facebookUser->id;
                    $existingUser->save();
                }
                Auth::login($existingUser);
            }else{
                $user = User::create([
                'name'=> $facebookUser->name,
                'email'=>$facebookUser->email,
                'facebook_id' => $facebookUser->id,
                'password' => md5(12345)
                ]);
                Auth::login($user);
            }
            return redirect('user-admin/dashboard');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function register(Request $request)
    {
        //dd($request->all());
        $userCount = User::where('email',$request->user_email);
        if($userCount->count() == 0){
            $user = User::create([
                'name'=> $request->user_name,
                'email'=>$request->user_email,
                //'contact_no'=>$request->user_contact_no,
                'password' => md5($request->user_password),
                // 'business_name' => $request->business_name,
                'created_at' => CURRENT_DATE_TIME
                //'country' => $request->user_country,
                //'city' => $request->user_city,
                //'pin_code' => $request->user_pincode,
                //'address' => $request->user_address,
            ]);
            Auth::login($user);
            return redirect('user-admin/dashboard');
        }else{
            return redirect('user-admin/register')->with('message',MSG_ALREADY_REGISTER);
        }
    }

    public function loginView()
    {
        return view('user_admin.login');
    }

    public function login(Request $request){

        $request->validate([
            'user_email' => 'required',
            'user_password' => 'required',
        ]);

        $user = User:: where([
            ['email',$request->user_email],
            ['password',md5($request->user_password)],
        ])->first();
        if($user){
            Auth::login($user);
            return redirect('user-admin/dashboard');
        }else{
        return redirect('user-admin/login')->with('message',MSG_INVALID_CREDENTIALS);
        }
    }
    public function userLogout(){
        Auth::logout();
        return redirect('/');
    }

    public function profileEditView(){
        return view('user_admin.profileEdit');
    }

    public function passwordUpdate(Request $request)
    {
        $passwordUpdate =User::where("id", $request->user_id)->update([
            'password' => md5($request->password),
            'updated_at' => CURRENT_DATE_TIME
        ]);
        if($passwordUpdate){
            return redirect('user-admin/profileEdit')->with('message',MSG_PASSWORD_UPDATE_SUCCESS);
        }else{
            return redirect('user-admin/profileEdit')->with('message',MSG_PASSWORD_UPDATE_ERROR);
        }
    }
    public function profileUpdate(Request $request)
    {
        $passwordUpdate =User::where("id", $request->user_id)->update([
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'business_name' => $request->business_name,
            'country' => $request->country,
            'city' => $request->city,
            'pin_code' => $request->pin_code,
            'address' => $request->address,
            'updated_at' => CURRENT_DATE_TIME
        ]);
        if($passwordUpdate){
            return redirect('user-admin/profileEdit')->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('user-admin/profileEdit')->with('message',MSG_UPDATE_ERROR);
        }
    }
}
