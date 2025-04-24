<?php

namespace App\Http\Controllers;

use App\Models\TattooSession;
use App\Models\SessionImage;
use App\Models\PortfolioImage;
use App\Models\PortfolioImageCategory;
use App\Models\User;
use App\Models\Tax;
use Illuminate\Http\Request;

class TattooSessionController extends Controller
{
    public function index()
    {
        return TattooSession::with('images')->where('user_id', auth()->id())->get();
    }

public function store(Request $request)
{
    $data = $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'session_type' => 'nullable|in:paid,unpaid,pending',
        'timer' => 'required|string',
        'invoice' => 'required|numeric',
        'notes' => 'nullable|string',
    ]);
    
    $data['user_id'] = auth()->id();
    $data['notes'] = $data['notes'] ?? 'default';

    $session = TattooSession::create($data);

    // Fetch or create PortfolioImageCategory
    $category = PortfolioImageCategory::firstOrCreate([
        'user_id' => $data['user_id'],
        'name' => 'session_images',
    ]);

    // Fetch user taxes
    $userTaxes = Tax::where('user_id', $data['user_id'])->first();
    $totalTaxPercentage = 0;

    if ($userTaxes) {
        $validTaxes = ['tax1', 'tax2', 'tax3', 'tax4'];
        foreach ($validTaxes as $tax) {
            $isValidTax = "is_{$tax}_valid";
            if ($userTaxes->$isValidTax) {
                $totalTaxPercentage += $userTaxes->$tax;
            }
        }
    }
    
    // Calculate final invoice after tax deduction
    $invoiceAfterTax = $data['invoice'] - ($data['invoice'] * ($totalTaxPercentage / 100));
    
    // Convert timer (HH:MM) to decimal hours
    [$hours, $minutes] = explode(':', $data['timer']);
    $decimalHours = $hours + ($minutes / 60);

    if ($request->has('images')) {
        foreach ($request->images as $imageUrl) {
            // Store image in PortfolioImage
            PortfolioImage::create([
                'user_id' => $data['user_id'],
                'portfolio_image_category_id' => $category->id,
                'customer_id' => $data['customer_id'],
                'url' => $imageUrl,
                'picture_notes' => $data['notes'],
                'date' => now(),
                'rate' => $invoiceAfterTax,
                'hours' => $decimalHours,
                'taxes' => $totalTaxPercentage,
                'favourite' => false,
            ]);
        }
    }
    
    $session->load('images');
    return response()->json($session, 201);
}

    public function show($id)
    {
        $session = TattooSession::with(['images', 'customer'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);
    
        return response()->json($session);
    }
    

    public function update(Request $request, $id)
    {
        $session = TattooSession::where('user_id', auth()->id())->findOrFail($id);

        $data = $request->validate([
            'session_type' => 'in:paid,unpaid,pending',
            'timer' => 'string',
            'notes' => 'string|nullable',
            'invoice' => 'numeric',
        ]);

        $session->update($data);

        if ($request->has('images')) {
            $session->images()->delete();
            foreach ($request->images as $imageUrl) {
                $session->images()->create(['url' => $imageUrl]);
            }
        }

        $session->load('images');

        return response()->json($session);
    }

    public function destroy($id)
    {
        $session = TattooSession::where('user_id', auth()->id())->findOrFail($id);
        $session->delete();

        return response()->json(null, 204);
    }
}
