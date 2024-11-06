<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\employees;

class RosterDetail extends Model
{
    use HasFactory;

    protected $table = 'roster_details';

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

    public function employee()
    {
        return $this->belongsTo(employees::class, 'employee_id', 'id');
    }
}
