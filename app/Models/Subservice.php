<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subservice extends Model
{
    use HasFactory;

    protected $guarded = [] ;

    /**
     * Get all of the payments for the Subservice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'subservice_id', 'id');
    }
    /**
     * Get the service that owns the Subservice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(service::class, 'service_id', 'id');
    }
    /**
     * Get all of the comments for the Subservice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'subservice_id', 'local_key');
    }
}
