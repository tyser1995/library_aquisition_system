<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseRequestApproverUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'purchase_request_approver_users';
}
