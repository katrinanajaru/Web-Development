<?php

namespace App\Models;

use App\Models\User;
use App\Models\Services;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [] ;

    /**
     * Get the service that owns the Appointment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subservice(): BelongsTo
    {
        return $this->belongsTo(Subservice::class,'subservice_id','id');
    }
    /**
     * Get the employee_assigned that owns the Appointment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee_assigned(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }
    /**
     * Get the user that owns the Appointment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
