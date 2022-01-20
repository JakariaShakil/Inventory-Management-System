<?php

namespace App\Http\Controllers\Backend;

use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $data['allData'] = Unit::all();
        return view('backend.pages.unit.view-unit',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('backend.pages.unit.add-unit');
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

    ]);

    $data = new Unit();
    $data->name = $request->name;
    $data->created_by = Auth::user()->id;
    $data->save();

    return redirect()->route('units.view')->with('message','Data Added Successfully');
 
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
        $allUnitData = Unit::find($id);

        return view('backend.pages.unit.edit-unit',compact('allUnitData'));
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

            $data = Unit::find($id);
            $data->name = $request->name;
            $data->save();


            return redirect()->route('units.view')->with('info','Data Updated Successfully');
                
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $deleteUnit = Unit::find($id);
        
        $deleteUnit ->delete();

        return redirect()->route('units.view')->with('warning','Data deleted successfully');
    }
}
