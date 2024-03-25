<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BookingAppointmentRequest;
use App\Http\Requests\Api\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function bookAppointment(BookingAppointmentRequest $request){
        $userId = Auth::id();

        //checking if user booking request with same user
        if($userId == $request->doctor_id){
            return response()->json(['message' => 'The selected doctor cannot be the same as the currently authenticated user.',"data" => []], 422);
        }

        //check user role is doctor
        $doctor = User::where('id',$request->doctor_id)->where('role','doctor')->first();
        if(is_null($doctor)){
            return response()->json(['message' => 'you choose invalid doctor id',"data" => []], 422);
        }

        //checking if appointment already exist
        $appointmentExist = Appointment::where('doctor_id',$request->doctor_id)->where('appointment_date',
        $request->appointment_date)->where('patient_id',Auth::id())->where('appointment_time_id',$request->slot_id)->first();
        if(!empty($appointmentExist)){
            return response()->json(['message' => 'you already book appointment',"data" => []], 422);
        }

        //checking if doctor is availble on given slot
        $appointmentExist = Appointment::where('doctor_id',Auth::id())->where('appointment_date',
        $request->appointment_date)->where('appointment_time_id',$request->slot_id)->first();
        if(!empty($appointmentExist)){
            return response()->json(['message' => 'Doctor have another appointment on same time',"data" => []], 422);
        }
        $request->merge(['patient_id' => $userId,'appointment_time_id' => $request->slot_id]);
        Appointment::create($request->all());
        return response()->json(['message' => 'appointment booked successfully','data' => []], 200);
    }

    public function updateAppointment(UpdateAppointmentRequest $request)
    {
        $appoinment = Appointment::where('patient_id',Auth::id())->orWhere('doctor_id',Auth::id())->where('id',$request->appointment_id)->first();
        if(!empty($appoinment)){
            $appoinment->status = $request->status;
            $appoinment->save();
        }else{
            return response()->json(['message' => 'Unaurtorized access',"data" => []], 403);
        }
        return response()->json(['data' => []], 200);
    }
}
