<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Facades\Hash;
class AdminProfileController extends Controller
{
    public function AdminProfile(){
        $uerid = Auth::guard('admin')->id(); 
        $adminData=Admin::find($uerid);
        return view('admin.profile.profile_view',compact('adminData'));
    }
    public function AdminProfileEdit(){
        $uerid = Auth::guard('admin')->id(); 
        $editData=Admin::find($uerid);
        return view('admin.profile.profile_edit',compact('editData'));
    }
    public function AdminProfileStore(Request $request){
        $data=(object)[];
        $uerid = Auth::guard('admin')->id();
        $data=Admin::find($uerid);
        $data->name=$request->name;
        $data->email=$request->email;
        if($request->file('profile_photo_path')){
            $file=$request->file('profile_photo_path');
            @unlink(public_path('uploads/admin_images/'.$data->profile_photo_path));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin_images'),$filename);
            $data->profile_photo_path=$filename;
        }
        $data->save();

        $msg=__('Admin profile save successfully');

        $notification=array(
            'message'=> $msg,
            'alert-type'=>'success'
        );
        return redirect()->route('admin.profile')->with($notification);
    }
    public function AdminChangePassword(){
        return view('admin.profile.change_password');
    }
    public function UpdateChangePassword(Request $request){
        $data=(object)[];
        $validateData=$request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        $uerid = Auth::guard('admin')->id();
        $hashedPassword = Admin::find($uerid)->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
            $admin=Admin::find($uerid);
            $admin->password=Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }else{
            $msg=__('Admin password not match with current password');
            $notification=array(
                'message'=>$msg,
                'alert-type'=>'error'
            );
            return redirect()->route('admin.change.password')->with($notification);
            //return redirect()->back()->with($notification);
            //return Redirect::back()->with($notification);
        }

    }
}
