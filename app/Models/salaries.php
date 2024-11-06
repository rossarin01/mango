<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salaries extends Model
{
    use HasFactory;
    protected $fillable = [
        'employees_id',
        'name',
        'department',
        'payment_method',
        'payment_type',
        'bank',
        'account_number',
    ];
}
