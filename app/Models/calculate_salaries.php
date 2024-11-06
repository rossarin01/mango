<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calculate_salaries extends Model
{
    use HasFactory;
    protected $fillable = [
        'employees_id',
        'name',
        'department',
        'total_hours',
        'hourly_rate',
        'tax',
        'gross_salary',
        'net_salary',
    ];

    
    public function calculateSalaries()
    {
        $this->gross_salary = $this->total_hours * $this->hourly_rate;
        $this->net_salary = $this->gross_salary - ($this->gross_salary * ($this->tax / 100));
        $this->save();
    }
}
