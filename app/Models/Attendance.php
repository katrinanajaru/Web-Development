<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the employee that owns the Attendance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }
    public function getCreatedAtAttribute($date)
{
    return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
}

public function getUpdatedAtAttribute($date)
{
    return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
}
}
