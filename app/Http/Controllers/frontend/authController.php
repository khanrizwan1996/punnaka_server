<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\frontend\blogsCategoryController;

class authController extends Controller
{

    public function businessListingHeaderMenu()
    {
        $businessListingHeaderMenu = (new businessListingController)->businessListingHeaderMenu();    
        return $businessListingHeaderMenu;
    }
    
    public function blogCategoryHeaderMenu()
    {
        $blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();        
        return $blogCategoryHeaderMenu;
    }

    public function mallCityHeaderMenu()
    {
        $mallCityHeaderMenu = (new mallController)->MallCityHeaderMenu();
        return $mallCityHeaderMenu;
    }

    public function couponHeaderMenu()
    {
        $couponHeaderMenu = (new couponController)->couponHeaderMenu();
        return $couponHeaderMenu;
    }

    public function offerHeaderMenu()
    {
        $offerHeaderMenu = (new offersController)->offerHeaderMenu();
        return $offerHeaderMenu;
    }    

    public function register_view()
    {
        //$blogCategoryHeaderMenu = (new blogsCategoryController)->blogCategoryHeaderMenu();
        return view('frontend.register',['blogCategoryHeaderMenu'=>$this->blogCategoryHeaderMenu(),'businessListingHeaderMenu'=> $this->businessListingHeaderMenu(),'mallCityHeaderMenu'=>$this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu()]);
    }

    public function register(RegisterFormRequest $request)
    {
        //dd($request->all());
        $userCount = User::where('email',$request->user_email);
        if($userCount->count() == 0){
            $request->validate([
                'user_name' =>'required',
                //'user_email' => 'required',
                'user_contact_no' => 'required',
                'user_password' => 'required',
                'user_country' => 'required',
                'user_city' => 'required',
                //'user_pincode' => 'required',
                'user_address' => 'required',
            ]);
            $user = User::create([
                'name'=> $request->user_name,
                'email'=>$request->user_email,
                'contact_no'=>$request->user_contact_no,
                'password' => md5($request->user_password),
                'country' => $request->user_country,
                'city' => $request->user_city,
                'pin_code' => $request->user_pincode,
                'address' => $request->user_address,
            ]);
            Auth::login($user);
            return redirect('/');
        }else{
            return redirect('register')->with('message','User Already Register With Us');
        }
    }

    public function login_view()
    {
        return view('frontend.login',['blogCategoryHeaderMenu'=>$this->blogCategoryHeaderMenu(),'businessListingHeaderMenu'=> $this->businessListingHeaderMenu(),'mallCityHeaderMenu'=>$this->mallCityHeaderMenu(),'couponHeaderMenu'=> $this->couponHeaderMenu(), 'offerHeaderMenu'=> $this->offerHeaderMenu()]);
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
            return redirect('/');
        }else{
            return redirect('login')->with('message','Login Failed');
        }
    }
    public function userLogout(){
        Auth::logout();
        return redirect('/');
    }
}
