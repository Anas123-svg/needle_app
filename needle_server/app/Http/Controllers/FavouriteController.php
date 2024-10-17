<?php

// app/Http/Controllers/FavouriteController.php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    // Create or update favourite
    public function store(Request $request)
    
    {
        $request->validate([
            'image' => 'required|string', // Validate single image URL
        ]);

        // Get artist_id from the authenticated user
        $artist_id = Auth::user()->id;

        $favourite = Favourite::create([
            'artist_id' => $artist_id,
            'image' => $request->image // Save single image URL
        ]);


        return response()->json([
            'message' => 'Favourite updated successfully',
            'favourite' => $favourite
        ], 201);
    }

    // Retrieve favourite
    public function show()
    {
        $artist_id = Auth::user()->id;

        $favourite = Favourite::where('artist_id', $artist_id)->get();

        if (!$favourite) {
            return response()->json(['message' => 'No favourite found'], 404);
        }

        return response()->json($favourite, 200);
    }

    // Delete favourite
    public function destroy()
    {
        $artist_id = Auth::user()->id;
        $favourite = Favourite::where('artist_id', $artist_id)->first();

        if (!$favourite) {
            return response()->json(['message' => 'No favourite found'], 404);
        }

        $favourite->delete();

        return response()->json(['message' => 'Favourite deleted successfully'], 200);
    }
}
