<?php

namespace App\Http\Controllers\Backend;

use App\Employee;
use App\EmployeeAttendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeAttendanceController extends Controller
{
    public function AttendanceView(){
        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('date','desc')->get();
    	// $data['allData'] = EmployeeAttendance::orderBy('id','DESC')->get();
    	return view('backend.pages.employee.attendance.employee_attendance_view',$data);
    }


    public function AttendanceAdd(){
    	$data['employees'] = Employee::all();
    	return view('backend.pages.employee.attendance.employee_attendance_add',$data);

    }


    public function AttendanceStore(Request $request){

    	EmployeeAttendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();
    	$countemployee = count($request->employee_id);
    	for ($i=0; $i <$countemployee ; $i++) { 
    		$attend_status = 'attend_status'.$i;
    		$attend = new EmployeeAttendance();
    		$attend->date = date('Y-m-d',strtotime($request->date));
    		$attend->employee_id = $request->employee_id[$i];
    		$attend->attend_status = $request->$attend_status;
    		$attend->save();
    	} 

    	return redirect()->route('employee.attendance.view')->with('message','Attendence taken Successfull');

    } // end Method



    public function AttendanceEdit($date){
    	$data['editData'] = EmployeeAttendance::where('date',$date)->get();
    	return view('backend.pages.employee.attendance.employee_attendance_edit',$data);
    }

	public function AttendanceUpdate(Request $request){

    	EmployeeAttendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();
    	$countemployee = count($request->employee_id);
    	for ($i=0; $i <$countemployee ; $i++) { 
    		$attend_status = 'attend_status'.$i;
    		$attend = new EmployeeAttendance();
    		$attend->date = date('Y-m-d',strtotime($request->date));
    		$attend->employee_id = $request->employee_id[$i];
    		$attend->attend_status = $request->$attend_status;
    		$attend->save();
    	} 

    	return redirect()->route('employee.attendance.view')->with('message','Attendence taken Successfull');

    } // end Method


    public function AttendanceDetails($date){
		// $employee = Employee::all();
    	$details = EmployeeAttendance::where('date',$date)->get();
    	return view('backend.pages.employee.attendance.employee_attendance_details',compact('details'));

    }
}
