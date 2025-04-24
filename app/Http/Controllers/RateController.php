<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;

class RateController extends Controller
{
    public function index(Request $request)
    {
        return Rate::where('user_id', $request->user()->id)->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rate' => 'required|numeric',
            'session_type' => 'required|string'
        ]);

        $session = Rate::create([
            'user_id' => $request->user()->id,
            'rate' => $validated['rate'],
            'session_type' => $validated['session_type'],
        ]);

        return response()->json($session, 201);
    }

    public function show(Request $request, $id)
    {
        $session = Rate::where('user_id', $request->user()->id)->findOrFail($id);
        return response()->json($session);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'rate' => 'numeric',
            'session_type' => 'string'
        ]);

        $session = Rate::where('user_id', $request->user()->id)->findOrFail($id);
        $session->update($validated);

        return response()->json($session);
    }

    public function destroy(Request $request, $id)
    {
        $session = Rate::where('user_id', $request->user()->id)->findOrFail($id);
        $session->delete();

        return response()->json(['message' => 'Session deleted successfully']);
    }
}
