<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\branch;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

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

    public function work_schedules()
    {
        return $this->hasMany(work_schedules::class, 'employee_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(branch::class, 'branch_id', 'id');
    }
}
