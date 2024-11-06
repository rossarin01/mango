<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    use HasFactory;
    protected $fillable = [
        'employees_id',
        'name',
        'department',
        'week',
        'start_date',
        'last_date',
        'payment_date',
        'total_amount',
        'payment_receipt',
    ];
}
