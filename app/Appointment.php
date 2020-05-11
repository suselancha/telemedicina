<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
    protected $fillable = [
        'description',
        'doctor_id',
        'patient_id',
        'specialty_id',
        'scheduled_date',
        'scheduled_time',
        'type',
        'medio',
        'cuotas',
        'id_emisor',
        'monto'
    ];

    //N $appointment->specialty 1
    //Muchas citas relacionan con una especialidad
    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    //N $appointment->doctor 1
    //Muchas citas relacionan con una medico
    //Por el nombre "doctor" Laravel relaciona con "doctor_id"
    public function doctor()
    {
        return $this->belongsTo(User::class);
    }

    //N $appointment->paciente 1
    //Muchas citas relacionan con una medico
    //Por el nombre "patient" Laravel relaciona con "patiend_id"
    public function patient()
    {
        return $this->belongsTo(User::class);
    }

    // 1 (hasOne) - 1/0 (bolongsTo)
    // $appointment->cancelacion->justificacion
    public function cancelacion()
    {
        return $this->hasOne(CitaCancelada::class);
    }

    //ACCESOR
    public function getScheduledTime12Attribute()
    {
        return (new Carbon($this->scheduled_time))
                ->format('g:i A');
    }
}
