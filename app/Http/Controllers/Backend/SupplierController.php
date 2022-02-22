<?php

namespace App\Http\Controllers\Backend;

use App\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\File;

class SupplierController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $data['allData'] = Supplier::all();
        return view('backend.pages.supplier.view-supplier',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('backend.pages.supplier.add-supplier');
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
            
            
            'name' => 'required',
            'mobile' => 'required|numeric|unique:suppliers,mobile',
            'type' => 'required',
            'address' => 'required',
            'city' => 'required',
            'account_number' => 'numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
                 

    ]);

    $data = new Supplier();
    $data->type = $request->type;
    $data->name = $request->name;
    
    if($request->image)
    {
      $image = $request->file('image') ;
      $img = rand() . '.' .$image->getClientOriginalExtension();
      $location = public_path('Backend/img/supplier/' . $img);
      Image::make($image)->save($location);
      $data->image = $img;
    }

    $data->email = $request->email;
    $data->mobile = $request->mobile;    
    $data->address = $request->address;
    $data->city = $request->city;
    $data->account_number = $request->account_number;
    $data->created_by = Auth::user()->id;
    $data->save();


    return redirect()->route('suppliers.view')->with('message','Data Added Successfully');
 


       
        
        
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
        $allSupplierData = Supplier::find($id);

        return view('backend.pages.supplier.edit-supplier',compact('allSupplierData'));
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
            'mobile' => 'required|numeric',
            'type' => 'required',
            'address' => 'required',
            'city' => 'required',
            'account_number' => 'numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                

    ]);
            $data = Supplier::find($id);
            $data->type = $request->type;
            $data->name = $request->name;
        
            if(!is_null($request->image))
            {
                if( File::exists('Backend/img/supplier/' . $data->image) ){
                    File::delete('Backend/img/supplier/' . $data->image);
                }
            $image = $request->file('image') ;
            $img = rand() . '.' .$image->getClientOriginalExtension();
            $location = public_path('Backend/img/supplier/' . $img);
            Image::make($image)->save($location);
            $data->image = $img;
            }

                
            $data->email = $request->email;
            $data->mobile = $request->mobile;    
            $data->address = $request->address;
            $data->city = $request->city;
            $data->account_number = $request->account_number;
            $data->save();


            return redirect()->route('suppliers.view')->with('info','Data Updated Successfully');
                
     
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $deleteSupplier = Supplier::find($id);
        
        if(!is_null($deleteSupplier ))
        {
            if( File::exists('Backend/img/supplier/' .$deleteSupplier ->image) ){
                File::delete('Backend/img/supplier/' .$deleteSupplier ->image);
            }

            $deleteSupplier ->delete();
        }
       
        return redirect()->route('suppliers.view')->with('warning','Data deleted successfully');
    }
}
