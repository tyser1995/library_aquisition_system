<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessionBook extends Model
{
    use HasFactory;
    protected $table = "acquisition_books";
    protected $fillable = ['date_received' ,
    'accession_no' ,
    'author',
    'title',
    'edition' ,
    'volumne',
    'pages',
    'dealers',
    'price',
    'publisher',
    'publication',
    'copyright_date',
    'isbn',
    'recommended_by',
    'department_name',
    'section_name',
    'acct_name',
    'acct_no',
    'actual_price',
    'less_percentage',
    'price_discounted',
    'discount',
    'dr_no',
    'receipt_no',
    'status'];
}
