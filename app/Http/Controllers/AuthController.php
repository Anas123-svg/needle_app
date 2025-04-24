<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tax;
use App\Models\Rate;
use App\Models\PortfolioImageCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private function createResponseWithTaxes($user, $token)
    {
        $taxes = $user->taxes; 
        return response()->json([
            'token' => $token,
            'user' => $user,
        //    'taxes' => $taxes
        ]);
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'artist_name' => 'required|string|max:255',
                'artist_email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'studio_name' => 'nullable|string|max:255',
                'studio_address' => 'nullable|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'instagram' => 'nullable|string|max:255',
                'invoice_note' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:255',
                'is_premium_user' => 'nullable|boolean',
                'free_trial' => 'nullable|boolean',
                'profile_image'=>'nullable|string',
                'tax1' => 'nullable|numeric',
                'tax2' => 'nullable|numeric',
                'tax3' => 'nullable|numeric',
                'tax4' => 'nullable|numeric',
                'no_of_valid_taxes' => 'nullable|integer',
                'is_tax1_valid' => 'nullable|boolean',
                'is_tax2_valid' => 'nullable|boolean',
                'is_tax3_valid' => 'nullable|boolean',
                'is_tax4_valid' => 'nullable|boolean',
                'rates' => 'nullable|array',
                'rates.*.rate' => 'required_with:rates|numeric',
                'rates.*.session_type' => 'required_with:rates|string',             
            ]);
            
                    $validTaxCount = 0;
        $validTaxes = [
            'tax1' => $request->is_tax1_valid,
            'tax2' => $request->is_tax2_valid,
            'tax3' => $request->is_tax3_valid,
            'tax4' => $request->is_tax4_valid,
        ];

        // Check which taxes are valid and count them
        foreach ($validTaxes as $tax => $isValid) {
            if ($isValid) {
                $validTaxCount++;
            }
        }

    
            $user = User::create([
                'artist_name' => $request->artist_name,
                'artist_email' => $request->artist_email,
                'password' => Hash::make($request->password),
                'studio_name' => $request->studio_name,
                'studio_address' => $request->studio_address,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'invoice_note' => $request->invoice_note,
                'phone' => $request->phone,
                'is_premium_user' => $request->is_premium_user,
                'free_trial' => $request->free_trial,
                'profile_image'=>$request->profile_image
            ]);
           $taxData = [
            'user_id' => $user->id,
            'tax1' => $request->tax1,
            'tax2' => $request->tax2,
            'tax3' => $request->tax3,
            'tax4' => $request->tax4,
            'is_tax1_valid' => $request->is_tax1_valid,
            'is_tax2_valid' => $request->is_tax2_valid,
            'is_tax3_valid' => $request->is_tax3_valid,
            'is_tax4_valid' => $request->is_tax4_valid,
            'no_of_valid_taxes' => $validTaxCount,
            ];

        
        Tax::create($taxData);
        
        PortfolioImageCategory::create([
            'user_id' => $user->id,
            'name' => 'tattoo',  // Default category name
        ]);


            
            
            
            
            if ($request->has('rates')) {
                foreach ($request->rates as $rateData) {
                    $rateData['user_id'] = $user->id;
                    Rate::create($rateData);
                }
            }
    
            $user->load(['taxes', 'rates']);
        
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return $this->createResponseWithTaxes($user, $token);
    
        } catch (\Exception $e) {
            \Log::error('Error during registration: ' . $e->getMessage());
            return response()->json(['error' => 'Registration failed. Please try again.'], 500);
        }
    }
        
    public function login(Request $request)
    {
        $request->validate([
            'artist_email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('artist_email', $request->artist_email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'artist_email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->load(['taxes', 'rates']);


        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->createResponseWithTaxes($user, $token);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
