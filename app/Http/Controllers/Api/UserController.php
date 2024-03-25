<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Requests\Api\StoreUserRequest;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserController extends Controller
{
    public function registration(StoreUserRequest $request)
    {
        $request->merge(['password' => bcrypt($request->password)]);
        User::create($request->all());
        return response()->json(['message' => 'User registered successfully',"data" => []], 201);
    }

    public function login(LoginUserRequest $request)
    {
        if (Auth::attempt($request->only('email','password'))) {
            $user = Auth::user();
            $token = $user->createToken('',[])->plainTextToken;

            return response()->json(['message' => 'User login successfully',"data" => ['token' => $token]], 200);
        } else {
            return response()->json(['message' => 'The provided credentials are incorrect.',"data" => []], 422);
        }
    }

    public function doctorList(){
        $doctors = User::where('role','doctor')->get();
        return response()->json(['data' => $doctors], 200);
    }

    public function appointmentList(){
        $appointment = Appointment::where('patient_id',Auth::id())->orWhere('doctor_id',Auth::id())->get();
        return response()->json(['data' => $appointment], 200);
    }

}
