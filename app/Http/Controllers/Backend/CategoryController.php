<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $data['allData'] = Category::orderBy('id','desc')->get();
        return view('backend.pages.category.view-category',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('backend.pages.category.add-category');
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
           
            'name' => 'required|unique:categories,name',
                

    ]);

    $data = new Category();
    $data->name = $request->name;
    $data->created_by = Auth::user()->id;
    $data->save();


    return redirect()->route('categories.view')->with('message','Data Added Successfully');
    
        
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
        $allCategoryData = Category::find($id);

        return view('backend.pages.category.edit-category',compact('allCategoryData'));
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
                

    ]);

            $data = Category::find($id);
            $data->name = $request->name;
            $data->save();

            return redirect()->route('categories.view')->with('info','Data Updated Successfully');
                
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $deleteCategory = Category::find($id);

         $deleteCategory ->delete();

        return redirect()->route('categories.view')->with('warning','Data deleted successfully');
    }
}