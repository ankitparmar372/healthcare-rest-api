<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentTimeMasterTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_time_master', function (Blueprint $table) {
            $table->id();
            $table->string('time_slot'); // start time and end time
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointment_time_master');
    }
}