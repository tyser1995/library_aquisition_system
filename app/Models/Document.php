<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
   //protected $fillable = ['created_by_user_id','name','caption','file', 'tag_name'];
   public $timestamp = false;
    
   use HasFactory;
   use SoftDeletes;
}
