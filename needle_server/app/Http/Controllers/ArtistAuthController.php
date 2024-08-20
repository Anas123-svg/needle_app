<?php
namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ArtistAuthController extends Controller
{
    // Register a new artist
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'nickname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:artists',
            'studio_name' => 'required|string|max:255',
            'studio_address' => 'required|string|max:255',
            'studio_phone_number' => 'required|string|max:20',
            'time_zone' => 'required|string|max:100',
            'password' => 'required|string|min:8|confirmed',
            'tax_number_1' => 'nullable|string|max:255',
            'tax_number_2' => 'nullable|string|max:255',
            'webpage' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook_page' => 'nullable|string|max:255',
            'profile_image' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $artist = Artist::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'birthdate' => $request->birthdate,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'studio_name' => $request->studio_name,
            'studio_address' => $request->studio_address,
            'studio_phone_number' => $request->studio_phone_number,
            'time_zone' => $request->time_zone,
            'tax_number_1' => $request->tax_number_1,
            'tax_number_2' => $request->tax_number_2,
            'password' => Hash::make($request->password),
            'webpage' => $request->webpage,
            'instagram' => $request->instagram,
            'facebook_page' => $request->facebook_page,
            'profile_image' => $request->profile_image,
        ]);

        $token = $artist->createToken('ArtistToken')->plainTextToken;

        return response()->json(['message' => 'Artist registered successfully', 'artist' => $artist, 'token' => $token], 201);
    }

    // Login for artist
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('artist')->attempt($credentials)) {
            $artist = Auth::guard('artist')->user();
            $token = $artist->createToken('ArtistToken')->plainTextToken;
            return response()->json(['token' => $token, 'artist' => $artist], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Get or update artist details
    public function updateDetails(Request $request)
    {
        $artist = Auth::guard('artist')->user();

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'surname' => 'sometimes|string|max:255',
            'birthdate' => 'sometimes|date',
            'nickname' => 'sometimes|string|max:255',
            'studio_name' => 'sometimes|string|max:255',
            'studio_address' => 'sometimes|string|max:255',
            'studio_phone_number' => 'sometimes|string|max:20',
            'time_zone' => 'sometimes|string|max:100',
            'tax_number_1' => 'sometimes|string|max:255',
            'tax_number_2' => 'sometimes|string|max:255',
            'webpage' => 'sometimes|string|max:255',
            'instagram' => 'sometimes|string|max:255',
            'facebook_page' => 'sometimes|string|max:255',
            'profile_image' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $artist->update($request->only([
            'name', 'surname', 'birthdate', 'nickname', 'studio_name',
            'studio_address', 'studio_phone_number', 'time_zone', 'tax_number_1',
            'tax_number_2', 'webpage', 'instagram', 'facebook_page', 'profile_image'
        ]));

        return response()->json(['message' => 'Artist details updated successfully', 'artist' => $artist], 200);
    }

    // Delete artist profile image
    public function deleteProfileImage()
    {
        $artist = Auth::guard('artist')->user();

        if ($artist->profile_image) {
            $artist->update(['profile_image' => null]);
            return response()->json(['message' => 'Profile image deleted successfully'], 200);
        }

        return response()->json(['error' => 'No profile image found'], 404);
    }
}
