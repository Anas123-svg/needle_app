<?php
namespace App\Http\Controllers;

use App\Models\Earning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EarningController extends Controller
{
    public function getEarnings(Request $request)
    {
        $artistId = Auth::guard('artist')->id();

        $earnings = Earning::where('artist_id', $artistId)
                           ->orderBy('date', 'desc')
                           ->get();

        return response()->json($earnings);
    }

    public function getEarningsByTimeFrame(Request $request, $timeframe)
    {
        $artistId = Auth::guard('artist')->id();
        $now = Carbon::now();

        switch ($timeframe) {
            case 'last-month':
                $startDate = $now->subMonth()->startOfMonth();
                $endDate = $now->endOfMonth();
                break;

            case 'last-week':
                $startDate = $now->subWeek()->startOfWeek();
                $endDate = $now->endOfWeek();
                break;

            case 'last-3-days':
                $startDate = $now->subDays(3);
                $endDate = $now;
                break;

            case 'in-year':
                $startDate = $now->startOfYear();
                $endDate = $now->endOfYear();
                break;

            default: // 'total' for total earnings
                $earnings = Earning::where('artist_id', $artistId)
                                   ->orderBy('date', 'desc')
                                   ->get();

                return response()->json([
                    'timeframe' => 'total',
                    'earnings' => $earnings,
                    'total_amount' => $earnings->sum('amount')
                ]);
        }

        $earnings = Earning::where('artist_id', $artistId)
                           ->whereBetween('date', [$startDate, $endDate])
                           ->orderBy('date', 'desc')
                           ->get();

        return response()->json([
            'timeframe' => $timeframe,
            'earnings' => $earnings,
            'total_amount' => $earnings->sum('amount')
        ]);
    }

    public function postEarning(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $artistId = Auth::guard('artist')->id();

        $earning = Earning::create([
            'artist_id' => $artistId,
            'amount' => $request->amount,
            'date' => $request->date,
        ]);

        return response()->json(['message' => 'Earning added successfully', 'earning' => $earning], 201);
    }

    public function updateEarning(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'sometimes|numeric',
            'date' => 'sometimes|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $artistId = Auth::guard('artist')->id();
        $earning = Earning::where('id', $id)->where('artist_id', $artistId)->first();

        if (!$earning) {
            return response()->json(['error' => 'Earning not found'], 404);
        }

        $earning->update($request->only(['amount', 'date']));

        return response()->json(['message' => 'Earning updated successfully', 'earning' => $earning], 200);
    }

    public function deleteEarning($id)
    {
        $artistId = Auth::guard('artist')->id();
        $earning = Earning::where('id', $id)->where('artist_id', $artistId)->first();

        if (!$earning) {
            return response()->json(['error' => 'Earning not found'], 404);
        }

        $earning->delete();

        return response()->json(['message' => 'Earning deleted successfully'], 200);
    }
}
