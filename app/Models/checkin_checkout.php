<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\branch;
use App\Models\Department;
use App\Models\employees;

class checkin_checkout extends Model
{
    use HasFactory;

    protected $table = 'checkin_checkouts';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->created_at = date("Y-m-d H:i:s");
            $model->updated_at = date("Y-m-d H:i:s");
        });

        static::updating(function ($model) {
            $model->updated_at = date("Y-m-d H:i:s");
        });
    }

    public function branch()
    {
        return $this->hasOne(branch::class, 'id', 'branch_id');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function employee()
    {
        return $this->belongsTo(employees::class, 'employee_id', 'id');
    }


}
