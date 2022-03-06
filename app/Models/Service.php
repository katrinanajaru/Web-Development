<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description'
    ] ;

    /**
     * Get all of the appointments for the Services
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    
}
