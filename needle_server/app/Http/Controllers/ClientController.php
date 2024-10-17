<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $artist = Auth::guard('artist')->user();

        $clients = $artist->clients;

        return response()->json($clients, 200);
    }

    public function store(Request $request)
    {
        $artist = Auth::guard('artist')->user();

        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_mail' => 'required|email|unique:clients,client_mail',
            'client_phone' => 'required|string|max:20',
            'client_nickname' => 'nullable|string|max:255',
            'availability' => 'required|string',
        ]);

        $client = $artist->clients()->create([
            'client_name' => $request->client_name,
            'client_mail' => $request->client_mail,
            'client_phone' => $request->client_phone,
            'client_nickname' => $request->client_nickname,
            'availability' => $request->availability,
        ]);

        return response()->json(['message' => 'Client created successfully', 'client' => $client], 201);
    }

    public function show($id)
    {
        $artist = Auth::guard('artist')->user();

        $client = $artist->clients()->find($id);

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        return response()->json($client, 200);
    }

    public function update(Request $request, $id)
    {
        $artist = Auth::guard('artist')->user();

        $client = $artist->clients()->find($id);

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        $request->validate([
            'client_name' => 'sometimes|required|string|max:255',
            'client_mail' => 'sometimes|required|email|unique:clients,client_mail,' . $client->id,
            'client_phone' => 'sometimes|required|string|max:20',
            'client_nickname' => 'nullable|string|max:255',
            'availability' => 'sometimes|required|string',
        ]);

        $client->update($request->all());

        return response()->json(['message' => 'Client updated successfully', 'client' => $client], 200);
    }

    public function destroy($id)
    {
        $artist = Auth::guard('artist')->user();

        $client = $artist->clients()->find($id);

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        $client->delete();

        return response()->json(['message' => 'Client deleted successfully'], 200);
    }
}
