<?php

namespace App\Http\Controllers;

use App\Models\BookAppointment;
use Illuminate\Http\Request;
use App\Mail\BookAppointmentMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Customer;

use Carbon\Carbon;
class BookAppointmentController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
    
        if (!$user_id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $bookAppointments = BookAppointment::where('user_id', $user_id)
            ->with('customer') // Still eager loading the customer relationship
            ->get()
            ->map(function ($appointment) {
                // Extract customer details and map them to the desired fields
                return [
                    'id' => $appointment->id,
                    'user_id' => $appointment->user_id,
                    'customer_id' => $appointment->customer_id,
                    'customerName' => $appointment->customer->name,
                    'customerEmail' => $appointment->customer->email,
                    'customer_avatar'=>$appointment->customer_avatar,
                    'calendar_date' => $appointment->calendar_date,
                    'created_at' => $appointment->created_at,
                    'updated_at' => $appointment->updated_at,
                ];
            });
    
        return response()->json($bookAppointments);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'calendar_date' => 'required|string', 
        ]);
    
        $appointment = BookAppointment::create([
            'user_id' => auth()->id(),
            'customer_id' => $validated['customer_id'],
            'calendar_date' => $validated['calendar_date'],
        ]);
        try {
            $date = Carbon::parse($validated['calendar_date'])->startOfDay(); // Ensures only the date part is used
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid date format'], 422);
        }
    
        $customer = Customer::find($validated['customer_id']);

        $day = $date->day;           
        $month = $date->monthName;   
        $year = $date->year;         

    
        if ($customer && !empty($customer->email)) {
            Mail::to($customer->email)->send(new BookAppointmentMail($day, $month, $year));
        }
    
        return response()->json($appointment, 201);
    }




        public function show($id)
    {
        $appointment = BookAppointment::with(['user', 'customer'])->findOrFail($id);
        return response()->json($appointment);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'customer_id' => 'sometimes|exists:customers,id',
            'calendar_date' => 'sometimes|string',
        ]);

        $appointment = BookAppointment::findOrFail($id);
        $appointment->update($request->all());

        return response()->json($appointment);
    }

    public function destroy($id)
    {
        BookAppointment::findOrFail($id)->delete();
        return response()->json(['message' => 'Appointment deleted successfully']);
    }
}
