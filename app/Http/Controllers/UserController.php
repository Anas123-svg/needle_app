<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\TattooSession;
use App\Models\Customer;


class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show(Request $request)
    {
        $user = $request->user();
        $user->load('taxes')
             ->loadCount([
                 'tattooSessions', 
                 'portfolioImages as portfolio_count', 
                 'customers',
             ]);

             // Get the total revenue for today, this week, this month, and this year
             $today = now()->startOfDay();
             $thisWeek = now()->startOfWeek();
             $thisMonth = now()->startOfMonth();
             $thisYear = now()->startOfYear();

             if (!$user->is_email_verified) {
                return response()->json(['error' => 'Email is not verified'], 403);
            }
         
             $todaysRevenue = $user->tattooSessions()
                                   ->where('session_type', 'paid')
                                   ->whereDate('created_at', $today)
                                   ->sum('invoice');
         
             $weeksRevenue = $user->tattooSessions()
                                  ->where('session_type', 'paid')
                                  ->whereBetween('created_at', [$thisWeek, now()])
                                  ->sum('invoice');
         
             $monthsRevenue = $user->tattooSessions()
                                   ->where('session_type', 'paid')
                                   ->whereBetween('created_at', [$thisMonth, now()])
                                   ->sum('invoice');
         
             $yearsRevenue = $user->tattooSessions()
                                  ->where('session_type', 'paid')
                                  ->whereBetween('created_at', [$thisYear, now()])
                                  ->sum('invoice');

        return response()->json([
            'user' => $user,
            'total_sessions' => $user->tattoo_sessions_count,
            'total_portfolios' => $user->portfolio_count,
            'total_customers' => $user->customers_count,
            'revenue' => [
                'today' => $todaysRevenue,
                'this_week' => $weeksRevenue,
                'this_month' => $monthsRevenue,
                'this_year' => $yearsRevenue,
            ],
    
        ]);
    }
    
    public function update(Request $request)
    {
        $user = $request->user();
    
        $data = $request->validate([
            'artist_name' => 'sometimes|required',
            'artist_email' => 'sometimes|required|email|unique:users,artist_email,' . $user->id,
            'studio_name' => 'sometimes|string|max:255',
            'studio_address' => 'sometimes|string|max:255',
            'facebook' => 'sometimes|string|max:255',
            'instagram' => 'sometimes|string|max:255',
            'invoice_note' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:255',
            'is_premium_user' => 'sometimes|boolean',
            'free_trial' => 'sometimes|boolean',
            'currency' => 'sometimes|string|max:255',
            'profile_image' => 'sometimes|string',
            'password' => 'sometimes|string|min:8|confirmed',
            'weekly_summary_email' => 'sometimes|string',
            'weekly_summary' => 'sometimes|boolean',
            'BookingRemainderToClients' => 'sometimes|boolean'
        ]);
    
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }
    
        $user->update($data);
    
        $taxData = $request->validate([
            'tax1' => 'sometimes|numeric',
            'tax2' => 'sometimes|numeric',
            'tax3' => 'sometimes|numeric',
            'tax4' => 'sometimes|numeric',
            'no_of_valid_taxes' => 'sometimes|integer',
            'is_tax1_valid' => 'sometimes|boolean',
            'is_tax2_valid' => 'sometimes|boolean',
            'is_tax3_valid' => 'sometimes|boolean',
            'is_tax4_valid' => 'sometimes|boolean'
        ]);
    
        $user->taxes()->updateOrCreate(['user_id' => $user->id], $taxData);
    
        $user->load('taxes');
    
        return response()->json($user);
    }
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }


    public function updatePassword(Request $request)
{
    $user = $request->user();
    $data = $request->validate([
        'old_password' => 'required|string',
        'new_password' => 'required|string|min:8|confirmed',
    ]);
    if (!\Hash::check($data['old_password'], $user->password)) {
        return response()->json(['error' => 'The old password is incorrect'], 403);
    }

    $user->password = bcrypt($data['new_password']);
    $user->save();

    return response()->json(['message' => 'Password updated successfully']);
}




public function getEarningsData()
{
    $user = Auth::user();
    $userId = $user->id;
    $today = strtoupper(Carbon::now()->format('l')); // Example: "MONDAY"

    // Get today's earnings
    $todayEarnings = TattooSession::where('user_id', $userId)
        ->whereDate('created_at', Carbon::today())
        ->sum('invoice');

    // Get last week's earnings
    $lastWeekEarnings = TattooSession::where('user_id', $userId)
        ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
        ->sum('invoice');

    // Get last month's earnings
    $lastMonthEarnings = TattooSession::where('user_id', $userId)
        ->whereDate('created_at', '>=', Carbon::now()->subMonth())
        ->sum('invoice');

    // Get last year's earnings
    $lastYearEarnings = TattooSession::where('user_id', $userId)
        ->whereYear('created_at', Carbon::now()->subYear()->year)
        ->sum('invoice');

    // Get earnings for last 30 days
    $last30Days = TattooSession::where('user_id', $userId)
        ->whereDate('created_at', '>=', Carbon::now()->subDays(30))
        ->pluck('invoice')
        ->toArray();
    $last30Days = array_map('intval', $last30Days); // Convert to integers

    // Get earnings for last 7 days
    $last7Days = TattooSession::where('user_id', $userId)
        ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
        ->pluck('invoice')
        ->toArray();
    $last7Days = array_map('intval', $last7Days); // Convert to integers

    // Get monthly earnings in the current year as an array
    $monthlyEarnings = [];
    for ($month = 1; $month <= 12; $month++) {
        $monthlyEarnings[$month] = TattooSession::where('user_id', $userId)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', $month)
            ->sum('invoice');
    }
    $monthlyEarnings = array_map('intval', array_values($monthlyEarnings)); // Convert to integers

    // Get yearly earnings as an array
    $years = TattooSession::where('user_id', $userId)
        ->selectRaw('YEAR(created_at) as year, SUM(invoice) as total')
        ->groupBy('year')
        ->orderBy('year', 'ASC')
        ->pluck('total')
        ->toArray();
    $years = array_map('intval', $years); // Convert to integers

    // Get lifetime earnings
    $lifetimeEarnings = TattooSession::where('user_id', $userId)->sum('invoice');

    // Get total number of customers
    $totalCustomers = Customer::where('user_id', $userId)->count();

    // Get number of available customers (Checking if availability contains "EVERY TODAY")
    $availableCustomers = Customer::where('user_id', $userId)
        ->where('availability', 'LIKE', "%EVERY $today%")
        ->count();

    // Weekly average hours
    $weeklySessions = TattooSession::where('user_id', $userId)
        ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
        ->pluck('timer');

    $totalWeeklyHours = 0;
    foreach ($weeklySessions as $time) {
        list($hours, $minutes, $seconds) = explode(':', $time);
        $totalWeeklyHours += $hours + ($minutes / 60) + ($seconds / 3600);
    }

    $weeklyAvgHours = round($totalWeeklyHours / 7, 2);

    // Weekly average earnings
    $weeklyEarnings = array_sum($last7Days);
    $weeklyAvgEarnings = round($weeklyEarnings / 7, 2);

    // Lifetime earnings per month with total hours calculation
    $lifetimeMonthlyEarnings = [];
    $lifetimeMonthlyHours = [];
    for ($month = 1; $month <= 12; $month++) {
        $totalEarnings = TattooSession::where('user_id', $userId)
            ->whereMonth('created_at', $month)
            ->sum('invoice');

        $monthlySessions = TattooSession::where('user_id', $userId)
            ->whereMonth('created_at', $month)
            ->pluck('timer');

        $totalHours = 0;
        foreach ($monthlySessions as $time) {
            list($hours, $minutes, $seconds) = explode(':', $time);
            $totalHours += $hours + ($minutes / 60) + ($seconds / 3600);
        }

        // Store values with month names
        $monthName = strtolower(Carbon::create()->month($month)->format('F'));
        $lifetimeMonthlyEarnings["lifetime_{$monthName}_earnings"] = (int)$totalEarnings; // Convert to integer
        $lifetimeMonthlyHours["lifetime_{$monthName}_hours"] = round($totalHours, 2);
    }

    $taxes = Tax::where('user_id', $userId)->first();
    $quarterlyTaxes = [];
    if ($taxes) {
        $validTaxes = [
            $taxes->is_tax1_valid ? $taxes->tax1 : 0,
            $taxes->is_tax2_valid ? $taxes->tax2 : 0,
            $taxes->is_tax3_valid ? $taxes->tax3 : 0,
            $taxes->is_tax4_valid ? $taxes->tax4 : 0,
        ];

        for ($q = 1; $q <= 4; $q++) {
            $startMonth = ($q - 1) * 3 + 1;
            $endMonth = $q * 3;

            $totalQuarterEarnings = TattooSession::where('user_id', $userId)
                ->whereBetween('created_at', [
                    Carbon::now()->startOfYear()->month($startMonth),
                    Carbon::now()->startOfYear()->month($endMonth)
                ])
                ->sum('invoice');

            $quarterlyTaxes["Q$q"] = array_sum($validTaxes) * $totalQuarterEarnings / 100;
        }
    }

    return response()->json([
        'earnings' => [
            'D' => $last30Days, // Already converted to integers
            'W' => $last7Days, // Already converted to integers
            'M' => $monthlyEarnings, // Already converted to integers
            'Y' => $years, // Already converted to integers
            'lifetime' => (int)$lifetimeEarnings, // Convert to integer
        ],
        'today' => (int)$todayEarnings, // Convert to integer
        'last_week' => (int)$lastWeekEarnings, // Convert to integer
        'last_month' => (int)$lastMonthEarnings, // Convert to integer
        'last_year' => (int)$lastYearEarnings, // Convert to integer
        'total_customers' => $totalCustomers,
        'available_customers' => $availableCustomers,
        'weekly_average_hours' => $weeklyAvgHours,
        'weekly_average_earnings' => $weeklyAvgEarnings,
        'taxes' => $quarterlyTaxes,
        'lifetime_monthly_earnings' => $lifetimeMonthlyEarnings, // Already converted to integers
        'lifetime_monthly_hours' => $lifetimeMonthlyHours,
    ]);
}
}
