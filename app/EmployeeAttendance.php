<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
