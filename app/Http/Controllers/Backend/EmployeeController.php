<?php

namespace App\Http\Controllers\Backend;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use File;

class EmployeeController extends Controller
{
    
public function view()
{
    $data['allData'] = Employee::all();
    return view('backend.pages.employee.view-employee',$data);
}


public function add()
{
    return view('backend.pages.employee.add-employee');
}


public function store(Request $request)
{
    $this->validate($request,[

                
        'role' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',       
        'name' => 'required',       
        'email' => 'required|email',       
        'phone' => 'required',       
        'address' => 'required',       
        'gender' => 'required',       
        'join_date' => 'required',       
        'salary' => 'required',       

]);

        $data = new Employee();

        if(!is_null($request->image))
        {
            if( File::exists('Backend/img/employee/' . $data->image) ){
                File::delete('Backend/img/employee/' . $data->image);
            }
        $image = $request->file('image') ;
        $img = rand() . '.' .$image->getClientOriginalExtension();
        $location = public_path('Backend/img/employee/' . $img);
        Image::make($image)->save($location);
        $data->image = $img;
        }
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->gender = $request->gender;
        $data->join_date = $request->join_date;
        $data->salary = $request->salary;
        $data->save();

        return redirect()->route('employees.view')->with('message','Data Added Successfully');

}


public function show($id)
{
    //
}


public function edit($id)
{
    $allEmployeeData = Employee::find($id);

    return view('backend.pages.employee.edit-employee',compact('allEmployeeData'));
}


public function update(Request $request, $id)
{

    $this->validate($request, [

            
        'role' => 'required', 
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',        
        'name' => 'required',       
        'email' => 'required|email',       
        'phone' => 'required',       
        'address' => 'required',       
        'gender' => 'required',       
        'join_date' => 'required',       
        'salary' => 'required',       

    ]);
            $data = Employee::find($id);

            if(!is_null($request->image))
            {
                if( File::exists('Backend/img/employee/' . $data->image) ){
                    File::delete('Backend/img/employee/' . $data->image);
                }
            $image = $request->file('image') ;
            $img = rand() . '.' .$image->getClientOriginalExtension();
            $location = public_path('Backend/img/employee/' . $img);
            Image::make($image)->save($location);
            $data->image = $img;
            }
            $data->role = $request->role;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->gender = $request->gender;
            $data->join_date = $request->join_date;
            $data->salary = $request->salary;
            $data->save();

        return redirect()->route('employees.view')->with('info','Data Updated Successfully');
            
    
}


public function delete($id)
{
    $deleteEmployee = Employee::find($id);
    
    $deleteEmployee ->delete();

    return redirect()->route('employees.view')->with('warning','Data deleted successfully');
}
}
