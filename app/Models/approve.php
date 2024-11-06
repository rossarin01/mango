<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class approve extends Model
{
    use HasFactory;
    protected $fillable = [
        'employees_id',
        'date',
        'fingerprint_check_in',
        'fingerprint_check_in(edit)',
        'fingerprint_check_out',
        'fingerprint_check_out(edit)',
        'fingerprint_break_start_time',
        'fingerprint_break_start_time(edit)',
        'fingerprint_break_end_time',
        'fingerprint_break_end_time(edit)',
    ];
}
