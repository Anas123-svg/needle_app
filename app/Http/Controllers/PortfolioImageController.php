<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortfolioImage;
use App\Models\SessionImage;
use Illuminate\Support\Facades\Log;


class PortfolioImageController extends Controller
{
    private function transformImage($image)
    {
        return [
            'id' => $image->id,
            'url' => $image->url,
            'picture_notes' => $image->picture_notes,
            'date' => $image->date,
            'rate' => $image->rate,
            'hours' => $image->hours,
            'taxes' => $image->taxes,
            'favourite' => $image->favourite,
            'category_name' => $image->category->name ?? null,
            'customer_name' => $image->customer->name ?? null,
            'customer_avatar' => $image->customer->customer_avatar ?? null,
        ];
    }

    public function index()
    {
        // Fetch portfolio images with customer and category data
        $portfolioImages = PortfolioImage::where('user_id', auth()->id())
            ->with(['customer:id,name,customer_avatar', 'category:id,name'])
            ->get()
            ->map(fn($image) => $this->transformImage($image));
    
        // Fetch session images with customer and tattoo session data
        $sessionImages = SessionImage::whereHas('tattooSession', function($query) {
            $query->where('user_id', auth()->id());
        })
        ->with([
            'tattooSession.customer:id,name,customer_avatar', // Ensure customer is eagerly loaded
            'tattooSession:id,session_type,timer,invoice,notes'
        ])
        ->get()
        ->map(function($sessionImage) {
            Log::info('Session Image Data', [
                'customer' => $sessionImage->tattooSession->customer,
                'customer_name' => $sessionImage->tattooSession->customer->name ?? 'null',
                'customer_avatar' => $sessionImage->tattooSession->customer->customer_avatar ?? 'null',
            ]);
        
            return [
                'id' => $sessionImage->id,
                'url' => $sessionImage->url,
                'customer_name' => $sessionImage->tattooSession->customer->name ?? null,
                'customer_avatar' => $sessionImage->tattooSession->customer->customer_avatar ?? null,
                'session_type' => $sessionImage->tattooSession->session_type ?? null,
                'tattoo_timer' => $sessionImage->tattooSession->timer ?? null,
                'tattoo_invoice' => $sessionImage->tattooSession->invoice ?? null,
                'tattoo_notes' => $sessionImage->tattooSession->notes ?? null,
            ];
        });
    
        return response()->json([
            'portfolio_images' => $portfolioImages,
            //'session_images' => $sessionImages,
        ]);
    }
            public function store(Request $request)
    {
        try {
            Log::info('Starting the portfolio image store process.');

            $validated = $request->validate([
                'portfolio_image_category_id' => 'required|exists:portfolio_image_categories,id',
                'customer_id' => 'required|exists:customers,id',
                'url' => 'required|string|max:255',
                'picture_notes' => 'nullable|string|max:255',
                'date' => 'nullable|date',
                'rate' => 'nullable|numeric|min:0',
                'hours' => 'nullable|numeric|min:0',
                'taxes' => 'nullable|numeric|min:0',
                'favourite' => 'sometimes|boolean',
            ]);
            
            Log::info('Validation passed.', $validated);

            // Create the portfolio image
        $data = array_merge($validated, [
            'user_id' => auth()->id(),
            'rate' => $validated['rate'] ?? 0.00,
            'hours' => $validated['hours'] ?? 0,
            'taxes' => $validated['taxes'] ?? 0,
            'picture_notes' => $validated['picture_notes'] ?? 'Default Notes',
        ]);
        
                $image = PortfolioImage::create($data);


            Log::info('Portfolio image created successfully.', ['image_id' => $image->id]);

            $image->load(['customer:id,name,customer_avatar', 'category:id,name']);
            Log::info('Related models loaded successfully.');

            return response()->json($this->transformImage($image), 201);

        } catch (\Exception $e) {
            Log::error('Error occurred while storing portfolio image.', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json(['error' => 'Failed to store portfolio image. Please try again later.'], 500);
        }
    }

    public function show($id)
    {
        $image = PortfolioImage::where('user_id', auth()->id())
            ->with(['customer:id,name,customer_avatar', 'category:id,name'])
            ->findOrFail($id);

        return response()->json($this->transformImage($image));
    }

    public function update(Request $request, $id)
    {
        $image = PortfolioImage::where('user_id', auth()->id())->findOrFail($id);

        $validated = $request->validate([
            'portfolio_image_category_id' => 'sometimes|exists:portfolio_image_categories,id',
            'customer_id' => 'sometimes|exists:customers,id',
            'url' => 'sometimes|string|max:255',
            'picture_notes' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'rate' => 'nullable|numeric|min:0',
            'hours' => 'nullable|numeric|min:0',
            'taxes' => 'nullable|numeric|min:0',
            'favourite' => 'sometimes|boolean',
        ]);

        $image->update($validated);
        $image->load(['customer:id,name,customer_avatar', 'category:id,name']);

        return response()->json($this->transformImage($image));
    }

    public function destroy($id)
    {
        $image = PortfolioImage::where('user_id', auth()->id())->findOrFail($id);
        $image->delete();

        return response()->json(['message' => 'Portfolio image deleted successfully.']);
    }

    public function getFavourites()
{
    $images = PortfolioImage::where('user_id', auth()->id())
        ->where('favourite', true)
        ->with(['customer:id,name,customer_avatar', 'category:id,name'])
        ->get()
        ->map(fn($image) => $this->transformImage($image));

    return response()->json($images);
}

public function getByCategory($categoryId)
{
    $images = PortfolioImage::where('user_id', auth()->id())
        ->where('portfolio_image_category_id', $categoryId)
        ->with(['customer:id,name,customer_avatar', 'category:id,name'])
        ->get()
        ->map(fn($image) => $this->transformImage($image));

    return response()->json($images);
}

}
