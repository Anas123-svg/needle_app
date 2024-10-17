<?php
namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\PasswordResetCodeMail;

class ArtistAuthController extends Controller
{
    use \Illuminate\Foundation\Validation\ValidatesRequests;

    public function register(Request $request)
    {
        $request->validate([
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
            'tax_rate_1' => 'nullable|string|max:255',
            'tax_rate_2' => 'nullable|string|max:255',
            'other_rate' => 'nullable|string|max:255',
            'taxable' => 'nullable|boolean', 
            'webpage' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook_page' => 'nullable|string|max:255',
            'profile_image' => 'nullable|string|max:255',
        ]);

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
            'tax_rate_1' => $request->tax_rate_1,
            'tax_rate_2' => $request->tax_rate_2,
            'other_rate' => $request->other_rate,
            'taxable' => $request->taxable,
            'password' => Hash::make($request->password),
            'webpage' => $request->webpage,
            'instagram' => $request->instagram,
            'facebook_page' => $request->facebook_page,
            'profile_image' => $request->profile_image,
        ]);

        $token = $artist->createToken('ArtistToken')->plainTextToken;

        return response()->json(['message' => 'Artist registered successfully', 'artist' => $artist, 'token' => $token], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $artist = Artist::where('email', $request->email)->first();

        if (!$artist || !Hash::check($request->password, $artist->password)) {
            return response()->json(['error' => 'incorrect password or email'], 401);
        }

       // $artist = Auth::user();
        $token = $artist->createToken('ArtistToken')->plainTextToken;

        return response()->json(['token' => $token, 'artist' => $artist], 200);
    }


    public function updateDetails(Request $request)
    {
        $artist = Auth::guard('artist')->user();

        $request->validate([
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
            'tax_rate_1' => 'sometimes|string|max:255',
            'tax_rate_2' => 'sometimes|string|max:255',
            'other_rate' => 'sometimes|string|max:255',
            'taxable' => 'sometimes|boolean', 
            'webpage' => 'sometimes|string|max:255',
            'instagram' => 'sometimes|string|max:255',
            'facebook_page' => 'sometimes|string|max:255',
            'profile_image' => 'sometimes|string|max:255',
        ]);

        $artist->update($request->only([
            'name', 'surname', 'birthdate', 'nickname', 'studio_name',
            'studio_address', 'studio_phone_number', 'time_zone', 
            'tax_number_1', 'tax_number_2', 'webpage', 'instagram', 
            'facebook_page', 'profile_image', 'tax_rate_1', 'tax_rate_2', 
            'other_rate', 'taxable'
        ]));

        return response()->json(['message' => 'Artist details updated successfully', 'artist' => $artist], 200);
    }

    public function deleteProfileImage()
    {
        $artist = Auth::guard('artist')->user();

        if ($artist->profile_image) {
            $artist->update(['profile_image' => null]);
            return response()->json(['message' => 'Profile image deleted successfully'], 200);
        }

        return response()->json(['error' => 'No profile image found'], 404);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = Artist::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $code = rand(100000, 999999);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $code, 'created_at' => now()]
        );

        // Queue the email sending
        Mail::to($request->email)->send(new PasswordResetCodeMail($code));

        return response()->json(['message' => 'Verification code sent'], 200);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset) {
            return response()->json(['error' => 'Invalid or expired reset code'], 400);
        }

        $user = Artist::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->forceFill(['password' => Hash::make($request->password)])->save();
        DB::table('password_resets')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Password reset successfully'], 200);
    }

    public function getArtistDetails()
    {
        $artist = Auth::guard('artist')->user();

        if (!$artist) {
            return response()->json(['error' => 'Artist not found'], 404);
        }

        return response()->json(['artist' => $artist], 200);
    }
}
