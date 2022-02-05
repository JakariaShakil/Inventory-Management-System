<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $data['allData'] = Brand::orderBy('id','desc')->get();
        return view('backend.pages.brand.view-brand',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('backend.pages.brand.add-brand');
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
           
            'name' => 'required|unique:brands,name',
                

    ]);
    $data = new Brand();
    $data->name = $request->name;
    $data->created_by = Auth::user()->id;
    $data->save();


    return redirect()->route('brands.view')->with('message','Data Added Successfully');
    
        
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
        $allBrandData =Brand::find($id);

        return view('backend.pages.brand.edit-brand',compact('allBrandData'));
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
           
            'name' => 'required|unique:brands,name',
                

    ]);

            $data =Brand::find($id);
            $data->name = $request->name;
            $data->save();

            return redirect()->route('brands.view')->with('info','Data Updated Successfully');
                
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $deleteCategory = Brand::find($id);

         $deleteCategory ->delete();

        return redirect()->route('brands.view')->with('warning','Data deleted successfully');
    }
}
