<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name','phone','email','address','role','gender','gender','salary','join_date'
    ];
    
    public function employee_salaries()
    {
        return $this->hasMany(EmployeeSalary::class);
    }

   
}
