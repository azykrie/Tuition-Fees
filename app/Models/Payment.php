<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'tuition_fee_id',
        'amount_paid',
        'payment_date',
        'status',
    ];
}
