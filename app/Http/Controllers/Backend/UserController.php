<?php

namespace App\Http\Controllers\Backend;

use Image;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $data['allData'] = User::all();
        return view('backend.pages.user.view-user',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('backend.pages.user.add-user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'user_type' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',      
            'password_confirmation' => 'required|min:6',      

    ]);
        $data = new User();
        $data->user_type = $request->user_type;
      
        if($request->image)
        {
          $image = $request->file('image') ;
          $img = rand() . '.' .$image->getClientOriginalExtension();
          $location = public_path('Backend/img/user/' . $img);
          Image::make($image)->save($location);
          $data->image = $img;
        }

        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect()->route('users.view')->with('message','Data Added Successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allUserData = User::find($id);

        return view('backend.pages.user.edit-user',compact('allUserData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'user_type' => 'required',
            'name' => 'required',
            'email' => 'required|email',      

    ]);
        
        
        $data = User::find($id);
        $data->user_type = $request->user_type;
      
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

        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect()->route('users.view')->with('info','Data Updated Successfully');
        

        //     if(!is_null($request->image))
        // {
        //     if( File::exists('Backend/img/user/' . $data->image) ){
        //         File::delete('Backend/img/user/' . $data->image);
        //     }
        //     $image = $request->file('image') ;
        //     $img = rand() . '.' .$image->getClientOriginalExtension();
        //     $location = public_path('Backend/img/user/' . $img);
        //     Image::make($image)->save($location);
        //     $data->image = $img;

        // }
       
            
        //     $data->update([

        //         'user_type' => $request->input('user_type'),
        //         'name' => $request->input('name'),
        //         'email' => $request->input('email'),
        //         'image' =>$img,
                
                
        //     ]);

            //return redirect()->route('users.view')->with('info','Data Updated Successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $deleteUser = User::find($id);
        
        if(!is_null($deleteUser))
        {
            if( File::exists('Backend/img/user/' . $deleteUser->image) ){
                File::delete('Backend/img/user/' . $deleteUser->image);
            }

            $deleteUser->delete();
        }
       
        return redirect()->route('users.view')->with('warning','Data deleted successfully');
    }
}
