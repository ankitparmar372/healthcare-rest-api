<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentTimeMaster extends Model
{
    protected $table = 'appointment_time_master';

    protected $fillable = [
        'time_slot',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
