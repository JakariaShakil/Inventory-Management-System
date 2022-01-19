<?php

namespace App\Http\Controllers\Backend;

use Image;
use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $data['allData'] = Customer::orderBy('id','desc')->get();
        return view('backend.pages.customer.view-customer',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('backend.pages.customer.add-customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    $data = new Customer();
    $data->name = $request->name;
    $data->email = $request->email;
    $data->mobile = $request->mobile;    
    $data->address = $request->address;
    $data->created_by = Auth::user()->id;
    $data->save();


    return redirect()->route('customers.view')->with('message','Data Added Successfully');
    
        
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
        $allCustomerData = Customer::find($id);

        return view('backend.pages.customer.edit-customer',compact('allCustomerData'));
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
           
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            
                

    ]);

            $data = Customer::find($id);
            $data->name = $request->name;
        
            $data->mobile = $request->mobile;   
            $data->email = $request->email;  
            $data->address = $request->address;
            $data->save();


            return redirect()->route('customers.view')->with('info','Data Updated Successfully');
                
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $deleteCustomer = Customer::find($id);

         $deleteCustomer ->delete();
        
       
        return redirect()->route('customers.view')->with('warning','Data deleted successfully');
    }
}
