<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class adminUserController extends Controller
{
    public function UserListView(){
        $userList = User::orderBy('id', 'DESC')->get();
        return view('admin.userList',['userList'=>$userList]);
    }
    
    public function userEditView(Request $request){
        $userData = User::where('id',$request->id)->first();
        return view('admin.userEdit',['userData'=>$userData]);
    }

    public function getUserDetailById($id){
        $userDetail = User::where(['id' => $id])->first();
        return $userDetail;
    }


      public function userStore(Request $request){
        $userCount = User::where('email',$request->user_email);
        if($userCount->count() == 0){
            User::create([
                'name'=> $request->user_name,
                'email'=>$request->user_email,
                'password' => md5($request->user_password),
                'created_at' => CURRENT_DATE_TIME
              ]);
            return redirect('admin/userList');
        }else{
            return redirect('admin/userList')->with('message',MSG_ALREADY_REGISTER);
        }
    }

    public function userUpdate(Request $request){
        $userUpdateData =User::where("id", $request->userId)->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'updated_at' => CURRENT_DATE_TIME
            ]
        );
        if($userUpdateData){
            return redirect('admin/userEdit/'.$request->userId)->with('message',MSG_UPDATE_SUCCESS);
        }else{
            return redirect('admin/userEdit/'.$request->userId)->with('message',MSG_UPDATE_ERROR);
        }
    }

}
