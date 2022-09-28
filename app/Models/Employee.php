<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'employees';
    protected $fillable = ['users_id','department_names_id','created_by_users_id','emp_idnum','emp_lastname','emp_firstname','emp_middlename','emp_sex'];
    
}
