<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'description',
        'doctor_id',
        'patient_id',
        'specialty_id',
        'scheduled_date',
        'scheduled_time',
        'type'
    ];
}
