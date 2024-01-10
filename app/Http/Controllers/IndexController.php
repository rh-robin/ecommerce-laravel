<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index(){
        return view("frontend.index");
    }

    public function userLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfile(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile',compact('user'));
    }


    /* user profile update */
    public function userProfileStore(Request $request){
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->hasFile('profile_photo_path')){
            @unlink(public_path('/upload/user_images/'. $user->profile_photo_path));
            $file = $request->file('profile_photo_path');
            $fileName = date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'), $fileName);
            $user->profile_photo_path = $fileName;
        }
        $user->save();
        $notification = array(
            'message' => 'User profile Updated Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->route('dashboard')->with($notification);
    } /* // end userProfileStore */


    public function userChangePassword(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_change_password',compact('user'));
    }


    public function userUpdatePassword(Request $request){
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        //dd("ook");
        $user = User::find(Auth::user()->id);
        $hashedPass = $user->password;
        if(Hash::check($request->oldpassword,$hashedPass)){
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        }else{
            return redirect()->back();
        }
    }
}
