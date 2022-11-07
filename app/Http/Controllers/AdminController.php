<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }

    public function Profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.admin_profile', compact('adminData'));
        

    }

    public function EditProfile(){
        $id = Auth::user()->id;
        $editData = User::find($id);


        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function StoreProfile(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;
        $data->profile_image = $request->profile_image;

        if($request->file('profile_image')){
            $file = $request->file('profile_image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_image'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);



    }


    public function ChangePassword(){
        // $id = Auth::user()->id;
        // $editData = User::find($id);

        return view('admin.admin_change_password');
    }

    public function UpdatePassword(Request $request){
        // $validateData = $request->validate([
        //     'oldpassword' => 'required',
        //     'password' => 'required|confirmed',
        // ]);

        // $hashedPassword = Auth::user()->password;
        // if(Hash::check($request->oldpassword, $hashedPassword)){
        //     $user = User::find(Auth::id());
        //     $user->password = Hash::make($request->password);
        //     $user->save();

        //     Auth::logout();

        //     return redirect()->route('login')->with('successMsg', 'Password Changed Successfully');
        // }else{
        //     return redirect()->back()->with('errorMsg', 'Current Password Not Matched');
        // }
    }

}
