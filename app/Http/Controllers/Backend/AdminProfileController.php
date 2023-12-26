<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use Hash;
use Auth;

class AdminProfileController extends Controller
{
    public function adminProfile(){
        $adminData = Admin::find(1);
        return view("admin.admin_profile_view", compact('adminData'));
    }

    public function adminProfileEdit(){
        $adminData = Admin::find(1);
        return view("admin.admin_profile_edit", compact('adminData'));
    }

    public function adminProfileUpdate(Request $request){
        $adminData = Admin::find(1);
        $adminData->name = $request->name;
        $adminData->email = $request->email;
        if($request->hasFile('profile_photo_path')){
            @unlink(public_path('/upload/admin_images/'. $adminData->profile_photo_path));
            $file = $request->file('profile_photo_path');
            $fileName = date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/admin_images'), $fileName);
            $adminData->profile_photo_path = $fileName;
        }
        $adminData->save();
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->route('admin.profile')->with($notification);
    }

    public function adminProfileChangePass(){
        $adminData = Admin::find(1);
        return view('admin.admin_profile_changePass', compact('adminData'));
    }

    public function adminProfileUpdatePass(Request $request){
        $request->validate([
            'oldPassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        $adminData = Admin::find(1);
        $hashedPass = $adminData->password;
        if(Hash::check($request->oldPassword,$hashedPass)){
            $adminData->password = Hash::make($request->password);
            $adminData->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }else{
            return redirect()->back();
        }
    }
}
