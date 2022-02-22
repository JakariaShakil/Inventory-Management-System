<?php

namespace App\Http\Controllers\Backend;

use App\Employee;
use File;
use App\EmployeeSalary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class EmployeeSalaryController extends Controller
{
    public function SalaryView(){
		$allEmployeeData = Employee::all();
    	$allSalaryData = EmployeeSalary::all();
    	return view('backend.pages.employee.salary.view-employee-salary',compact('allSalaryData','allEmployeeData'));
    }


    public function SalaryIncrement($id){
        
    	$editData = Employee::find($id);
    	return view('backend.pages.employee.salary.increment-employee-salary',compact('editData'));

    }

    public function SalaryStore(Request $request, $id){

    	$employee = Employee::find($id);
    	$previous_salary = $employee->salary;
    	$present_salary = (float)$previous_salary+(float)$request->increment_salary; 
    	$employee->salary = $present_salary;
    	$employee->save();

    	$salaryData = new EmployeeSalary();
    	$salaryData->employee_id = $id;
    	$salaryData->previous_salary = $previous_salary;
    	$salaryData->increment_salary = $request->increment_salary;
    	$salaryData->present_salary = $present_salary;
    	$salaryData->effected_date = $request->effected_date;
    	$salaryData->save();

    	

    	return redirect()->route('employees.salary.view')->with('message','salary incremented successfull');

    }


    public function SalaryDetails($id){
    	$data['details'] = Employee::find($id);
    	$data['employeeSalary'] = EmployeeSalary::where('employee_id',$data['details']->id)->get();
    	return view('backend.pages.employee.salary.details-employee-salary',$data);

    }


}
