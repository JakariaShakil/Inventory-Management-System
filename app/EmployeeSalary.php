<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    protected $fillable = [
        'employee_id','previous_salary','present_salary','increment_salary','effected_date'
    ];
    // public function employee()
    // {
    //     return $this->belongsTo(Employee::class);
    // }
   
}
