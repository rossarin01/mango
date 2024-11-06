<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\work_schedules;
use App\Models\branch;
use App\Models\Department;



class employees extends Authenticatable
{
    use HasFactory;

    protected $table = 'employees';

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

        static::deleting(function ($model) {
            if($model->image){
                if (Storage::disk('public')->exists($model->getRawOriginal('image'))) {
                    Storage::disk('public')->delete($model->getRawOriginal('image'));
                }
            }
        });
    }

    public function getbranch()
    {
        return $this->hasOne(branch::class, 'id', 'branch');
    }

    public function getdepartment()
    {
        return $this->hasOne(Department::class, 'id', 'department');
    }


    public function work_schedules()
    {
        return $this->hasMany(work_schedules::class, 'employee_id', 'id');
    }


    public function getImageAttribute($str)
    {
        if ($str && Storage::disk('public')->exists($str)) {
            return asset('storage/' . $str);
        }
        return null;
    }
}
