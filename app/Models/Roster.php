<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\branch;
use App\Models\Department;
use App\Models\CalculateSalary;

class Roster extends Model
{
    use HasFactory;

    protected $table = 'rosters';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->created_at = date("Y-m-d H:i:s");
            $model->updated_at = date("Y-m-d H:i:s");
            $model->created_by = auth()->check() ? auth()->user()->id : null;
            $model->updated_by = auth()->check() ? auth()->user()->id : null;
        });

        static::updating(function ($model) {
            $model->updated_at = date("Y-m-d H:i:s");
            $model->updated_by = auth()->check() ? auth()->user()->id : null;
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

    public function calculate_salary()
    {
        return $this->hasMany(CalculateSalary::class, 'roster_id', 'id');
    }
}
