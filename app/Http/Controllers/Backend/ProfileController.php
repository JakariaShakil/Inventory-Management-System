<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Image;
use File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend/pages/user/view-profile',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile($id)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend/pages/user/edit-profile',compact('user'));
    }

  
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',   
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
               

    ]);
        
        
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;
      
        if(!is_null($request->image))
        {
            if( File::exists('Backend/img/user/' . $data->image) ){
                File::delete('Backend/img/user/' . $data->image);
            }
          $image = $request->file('image') ;
          $img = rand() . '.' .$image->getClientOriginalExtension();
          $location = public_path('Backend/img/user/' . $img);
          Image::make($image)->save($location);
          $data->image = $img;
        }

        
        $data->save();

        return redirect()->route('profile.view')->with('info','Data Updated Successfully');
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewPassword()
    {
        return view('backend.pages.user.view_password');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            
            'current_password' => 'required',      
            'password' => 'required|confirmed',      
    ]);
    
    $hashedPassword = Auth::user()->password;
    if(Hash::check($request->current_password,$hashedPassword)){
        $user = User::find(Auth::id());  
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::logout();
        return redirect()->route('login');  

    }else{

        return redirect()->back();
    }



    }
}
