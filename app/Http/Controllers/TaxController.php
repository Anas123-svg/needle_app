<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaxController extends Controller
{
    public function index()
    {
        $taxes = Auth::user()->taxes;
        return response()->json($taxes);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tax1' => 'nullable|numeric',
            'tax2' => 'nullable|numeric',
            'tax3' => 'nullable|numeric',
            'tax4' => 'nullable|numeric',
            'no_of_valid_taxes' => 'nullable|integer',
            'is_tax1_valid' => 'nullable|boolean',
            'is_tax2_valid' => 'nullable|boolean',
            'is_tax3_valid' => 'nullable|boolean',
            'is_tax4_valid' => 'nullable|boolean',
        ]);

        $data['user_id'] = Auth::id();

        $tax = Tax::create($data);
        return response()->json($tax, 201);
    }

    public function show(Request $request)
    {
        $tax = Auth::user()->taxes()->findOrFail($request->tax_id);
        return response()->json($tax);
    }

    public function update(Request $request)
    {
        $tax = Auth::user()->taxes()->findOrFail($request->tax_id);

        $data = $request->validate([
            'tax1' => 'sometimes|numeric',
            'tax2' => 'sometimes|numeric',
            'tax3' => 'sometimes|numeric',
            'tax4' => 'sometimes|numeric',
            'no_of_valid_taxes' => 'sometimes|integer',
            'is_tax1_valid' => 'sometimes|boolean',
            'is_tax2_valid' => 'sometimes|boolean',
            'is_tax3_valid' => 'sometimes|boolean',
            'is_tax4_valid' => 'sometimes|boolean',

        ]);

        $tax->update($data);
        return response()->json($tax);
    }

    public function destroy(Request $request)
    {
        $tax = Auth::user()->taxes()->findOrFail($request->tax_id);
        $tax->delete();
        return response()->json(['message' => 'Tax record deleted successfully']);
    }
}
