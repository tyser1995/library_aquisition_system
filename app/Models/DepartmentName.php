<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentName extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $tables = 'department_names';
    protected $fillable = ['created_by_users_id','department_types_id','department_code','department_name'];
    // public function department_types()
    // {
    //     return $this->belongsTo('DepartmentType');
    // }
}
