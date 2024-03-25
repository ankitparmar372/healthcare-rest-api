<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_date',
        'appointment_time_id',
        'status',
    ];

    protected $casts = [
        'appointment_time_id' => 'integer',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function appointmentTimeMaster()
    {
        return $this->belongsTo(AppointmentTimeMaster::class, 'appointment_time_id');
    }
}
