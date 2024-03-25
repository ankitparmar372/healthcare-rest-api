<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentTimeMasterSeeder extends Seeder
{
    public function run()
    {
        //DB::table('appointment_time_master')->truncate();
        $startTime = strtotime('09:30');
        $endTime = strtotime('18:30');
        $interval = 60*30; // 30 mintues slot

        $timeSlots = [];

        while ($startTime <= $endTime) {
            $timeSlot = [
                'time_slot' => date('H:i', $startTime) . ' - ' . date('H:i', $startTime + $interval)
            ];
            $timeSlots[] = $timeSlot;
            $startTime += $interval;
        }

        DB::table('appointment_time_master')->insert($timeSlots);
    }
}
