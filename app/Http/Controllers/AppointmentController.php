<?php

namespace App\Http\Controllers;


use Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;
use Illuminate\Http\Request;
use App\Models\appointments;

class AppointmentController extends Controller
{
    //
     public function showall()
    {
        $users = appointments::all();
        if ($users == "") {
            return response()->json([
                'success' => true,
                'message' => 'Appointments Not Found Done.',
                // 'data' => $Items

            ], 404);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Appointments Fetch Successfully Done.',
                'data' => $users

            ], 200);
        }
    }

    public function addappointment(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'mobile_number' => 'required|string',
            'appointment_date_time' => 'required|string',
            'customer_id' => 'required|string',
            'hair_style' => 'required|string',
            'descsion' => 'required|string',
            'email' => 'required|string',
            'address' => 'required|string',
            'gender' => 'required|string',
            'package_id' => 'nullable|string',
            
            
            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
        }

        $pricing = new appointments();
        $pricing->first_name = $request->first_name;
        $pricing->last_name = $request->last_name;
        $pricing->mobile_number = $request->mobile_number;
        $pricing->appointment_date_time = $request->appointment_date_time;
        $pricing->customer_id = $request->customer_id;
        $pricing->hair_style = $request->hair_style;
        $pricing->descsion = $request->descsion;
        $pricing->email = $request->email;
        $pricing->address = $request->address;
        $pricing->gender = $request->gender;
         $pricing->package_id = $request->package_id;
        

        $pricing->save();



        return response()->json([
            'success' => true,
            'message' => 'appointments Added Successfully Done'
        ], 200);
    }


    public function AppointmentAccept(Request $request, $id)
    {

        $user =  appointments::find($id);

        $clients->descsion = "Accepted";
        
        $user->save();
    }


     public function AppointmentRejected(Request $request, $id)
    {

        $user =  appointments::find($id);

        $clients->descsion = "Rejected";
        
        $user->save();
    }



        public function show_single_appointment($id)
    {
        $pricing = appointments::where('id', $id)->get();

        if ($pricing->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment Details Not Found'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Appointment Details Found',
            'data' => $pricing
        ], 200);
    }



          public function all_accepted_appointment($id)
    {
        $pricing = appointments::where('descsion', 'Accepted')->get();

        if ($pricing->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment Details Not Found'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Appointment Details Found',
            'data' => $pricing
        ], 200);
    }


     public function all_rejected_appointment($id)
    {
        $pricing = appointments::where('descsion', 'Rejected')->get();

        if ($pricing->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment Details Not Found'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Appointment Details Found',
            'data' => $pricing
        ], 200);
    }



         public function destroy_appointments($id)
    {
        $delete_Pricing = appointments::find($id);

        $delete_Pricing->delete();

        return response()->json([
            'success' => true,
            'message' => 'Appointment Number->' . $id . '->Remove Successfully Done.'
        ], 200);
    }


     public function show_all_appointment_by_custid($id)
    {
        $pricing = appointments::where('customer_id', $id)->get();

        if ($pricing->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment Details  of this user not Found'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Appointment Details  Found this user',
            'data' => $pricing
        ], 200);
    }


}
