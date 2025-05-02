<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{


    public function index()
    {
        $user_id = auth()->id();
    
        // Get current day of the week (e.g., "Monday", "Tuesday", etc.)
        $currentDay = now()->format('l');  // 'l' will return the full textual representation of the day
    
        $customers = Customer::with('images')
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($customer) use ($currentDay) {
                // Check if the current day is in the customer's availability
                $customer->customerAvailable = $this->isAvailableToday($customer->availability, $currentDay);
    
                // Calculate payment details
                $sessions = $customer->tattooSessions;
                $totalPaid = $sessions->where('session_type', 'paid')->sum('invoice');
                $pendingPayments = $sessions->where('session_type', 'pending')->sum('invoice');
                $unpaidSessionsCount = $sessions->where('session_type', 'unpaid')->sum('invoice');
                
                $customer->payment_details = [
                    'total_paid' => $totalPaid,
                    'pending_payments' => $pendingPayments,
                    'unpaid_sessions_payments' => $unpaidSessionsCount,
                ];
    
                return $customer;
            });
    
        return response()->json($customers);
    }
    
    // Helper function to check if the current day is in the availability string
    private function isAvailableToday($availability, $currentDay)
    {
        // Split availability days and check if the current day is in the list
        $availabilityDays = explode(', ', $availability);  // Example: "EVERY MONDAY, EVERY TUESDAY"
        foreach ($availabilityDays as $day) {
            if (stripos($day, $currentDay) !== false) { // case-insensitive comparison
                return true;
            }
        }
    
        return false;
    }
    

public function store(Request $request)
{
    Log::info('Store method started', ['request_data' => $request->all()]);
    
    // Validate input data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:customers',
        'phone_number' => 'required|string|max:20',
        'availability' => 'required|string|max:255',
        'customer_avatar' => 'nullable|string',
        'notes' => 'nullable|string',
        'session_type' => 'nullable|string',
        'break_time' => 'nullable|string',
    ]);

    // Handle session_type logic
$sessionType = $request->input('session_type');

// Extract numbers and decimals using regex
preg_match('/\|\s*(\d+(\.\d+)?)/', $sessionType, $matches);

if ($matches) {
    // If a number is found, use that
    $sessionType = $matches[1];
} else {
    // If no number is found, set it to 0.00
    $sessionType = '0.00';
}

    $notes = $request->input('notes');
    if (empty($notes)) {
        $notes = 'Default notes';
    }

    // Create customer with the adjusted session_type and notes
    $customer = Customer::create(array_merge(
        $request->all(),
        ['user_id' => auth()->id(), 'session_type' => $sessionType, 'notes' => $notes]
    ));

    // Handle images if they exist in the request
    if ($request->has('images')) {
        foreach ($request->images as $image) {
            CustomerImage::create([
                'customer_id' => $customer->id,
                'image_url' => $image,
            ]);
        }
    }

    return response()->json($customer->load('images'), 201);
}


    public function show($id)
    {
        // Retrieve a specific customer by ID for the authenticated user
        $customer = Customer::with('images')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return response()->json($customer);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:customers,email,' . $id,
            'phone_number' => 'sometimes|string|max:20',
            'availability' => 'sometimes|string|max:255',
            'customer_avatar' => 'sometimes|string',

            'notes' => 'sometimes|string',
            'session_type' => 'sometimes|string',
            'break_time' => 'sometimes|string',
        ]);

        // Update customer details
        $customer->update($request->all());

        // Update images if provided
        if ($request->has('images')) {
            $customer->images()->delete();
            foreach ($request->images as $image) {
                CustomerImage::create([
                    'customer_id' => $customer->id,
                    'image_url' => $image,
                ]);
            }
        }

        return response()->json($customer->load('images'));
    }

    public function destroy($id)
    {
        $customer = Customer::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully.']);
    }
}
