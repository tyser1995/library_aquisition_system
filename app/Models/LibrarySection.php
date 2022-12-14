<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibrarySection extends Model
{
    use HasFactory;

    protected $table = 'library_sections';
    protected $fillable = ['created_by_users_id','section_name','section_code'];
}
