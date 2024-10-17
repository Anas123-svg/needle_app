<?php

namespace App\Http\Controllers;

use App\Models\TattooSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class TattooSessionController extends Controller
{
   
    public function store(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'client_name' => 'required|string',
                'client_email' => 'required|email',
                'client_phone' => 'required|string',
                'session_type' => 'required|string',
                'actual_rate' => 'required|numeric',
                'session_cost' => 'nullable|numeric',
                'taxes' => 'required|numeric',
                'total_rate' => 'required|numeric',
                'end_session_image' => 'nullable|string',
                'end_session_note' => 'nullable|string',
                'images.*' => 'nullable|string',
            ]);
    
            // Retrieve artist ID
            $artist_id = Auth::user()->id;
    
            // Create a new tattoo session
            $session = new TattooSession([
                'artist_id' => $artist_id,
                'client_name' => $request->client_name,
                'client_email' => $request->client_email,
                'client_phone' => $request->client_phone,
                'session_type' => $request->session_type,
                'session_cost' => $request->session_cost,
                'timer' => $request->timer,
                'actual_rate' => $request->actual_rate,
                'taxes' => $request->taxes,
                'total_rate' => $request->total_rate,
                'end_session_note' => $request->end_session_note,
                'end_session_image' => $request->end_session_image, // Save URL directly
            ]);
    
            // Handle image URLs as array
            if ($request->images) {
                $session->images = json_encode($request->images); // Store as JSON string
            }
    
            // Save session
            $session->save();
    
            // Return the newly created session with images array
            return response()->json([
                'message' => 'Tattoo session created successfully',
                'session' => $session
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create tattoo session', 'error' => $e->getMessage()], 500);
        }
    }
    
    
    

    public function index()
    {
        $artist_id = Auth::user()->id; 
        $sessions = TattooSession::where('artist_id', $artist_id)->get();

        foreach ($sessions as $session) {
            if ($session->end_session_image) {
                $session->end_session_image = Storage::url($session->end_session_image);
            }

            if ($session->images) {
                $sessionImages = json_decode($session->images, true);
                $session->images = array_map(function ($image) {
                    return Storage::url($image);
                }, $sessionImages);
            }
        }

        return response()->json($sessions);
    }

    public function show($id)
    {
        $session = TattooSession::findOrFail($id);

        if ($session->end_session_image) {
            $session->end_session_image = Storage::url($session->end_session_image);
        }

        if ($session->images) {
            $sessionImages = json_decode($session->images, true);
            $session->images = array_map(function ($image) {
                return Storage::url($image);
            }, $sessionImages);
        }

        return response()->json($session);
    }

    public function update(Request $request, $id)
    {
        $session = TattooSession::findOrFail($id);
    
        $request->validate([
            'client_name' => 'sometimes|string',
            'client_email' => 'sometimes|email',
            'client_phone' => 'sometimes|string',
            'session_type' => 'sometimes|string',
            'actual_rate' => 'sometimes|numeric',
            'taxes' => 'sometimes|numeric',
            'timer' => 'sometimes|date_format:H:i:s',
            'total_rate' => 'sometimes|numeric',
            'end_session_image' => 'sometimes|string', 
            'images.*' => 'sometimes|string', 
        ]);
    
        $session->update($request->except(['end_session_image', 'images']));
    
        if ($request->filled('end_session_image')) {
            $session->end_session_image = $request->input('end_session_image');
        }
    
        if ($request->filled('images')) {
            $urlImages = $request->input('images');
    
            $existingImages = $session->images ? json_decode($session->images, true) : [];
            $session->images = json_encode(array_merge($existingImages, $urlImages));
        }
    
        $session->save();
    
        return response()->json([
            'message' => 'Tattoo session updated successfully',
            'session' => $session
        ], 201);
    }
    
    public function destroy($id)
    {
        $session = TattooSession::findOrFail($id);
        $session->delete();

        return response()->json(['message' => 'Tattoo session deleted successfully']);
    }
}
