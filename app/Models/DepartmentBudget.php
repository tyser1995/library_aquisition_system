<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentBudget extends Model
{
    use HasFactory;

    protected $table = "department_budgets";
    protected $fillable = ['created_by_users_id','department_name_id','no_of_students','amount','semester','school_year'];
}
