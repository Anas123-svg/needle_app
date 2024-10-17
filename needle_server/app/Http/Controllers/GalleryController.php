<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\TattooSession;

class GalleryController extends Controller
{
    public function createGallery(Request $request)
    {
        Log::info('Creating a new gallery.', [
            'request_data' => $request->all(),
        ]);

        $artist = Auth::guard('artist')->user();

        if (!$artist) {
            Log::warning('Unauthorized user attempted to create a gallery.', [
                'request_data' => $request->all(),
            ]);
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'cover_image' => 'nullable|string|url',
            'gallery_name' => 'required|string',
        ]);

        $gallery = Gallery::create([
            'artist_id' => $artist->id,
            'gallery_name' => $request->input('gallery_name'),
            'cover_image' => $request->input('cover_image'),
        ]);

        Log::info('Gallery created successfully.', [
            'gallery_id' => $gallery->id,
            'artist_id' => $artist->id,
        ]);

        return response()->json($gallery, 201);
    }

    public function uploadImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|string|url', // Expecting an image URL
            'timer' => 'nullable|integer',
            'hourly rate' => 'nullable|numeric',
            'cost' => 'nullable|numeric',
        ]);

        $gallery = Gallery::findOrFail($id);

        $galleryImage = GalleryImage::create([
            'gallery_id' => $gallery->id,
            'image_url' => $request->input('image'),
            'timer' => $request->input('timer', null),
            'hourly rate' => $request->input('hourly', null),
            'cost' => $request->input('cost', null),
        ]);

        Log::info('Image uploaded successfully.', [
            'gallery_id' => $gallery->id,
            'image_url' => $galleryImage->image_url,
        ]);

        // Get all images for this gallery
        $images = GalleryImage::where('gallery_id', $gallery->id)->get();

        return response()->json(['message' => 'Image uploaded successfully', 'images' => $images]);
    }

    public function deleteGallery($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();

        Log::info('Gallery deleted successfully.', [
            'gallery_id' => $id,
        ]);

        return response()->json(['message' => 'Gallery deleted successfully']);
    }

    public function deleteImage($id, $imageId)
    {
        $image = GalleryImage::where('gallery_id', $id)->findOrFail($imageId);
        $image->delete();

        Log::info('Image deleted successfully.', [
            'gallery_id' => $id,
            'image_id' => $imageId,
        ]);

        // Get all remaining images for this gallery
        $remainingImages = GalleryImage::where('gallery_id', $id)->get();

        return response()->json(['message' => 'Image deleted successfully', 'images' => $remainingImages]);
    }

    public function getAllGalleries()
    {
        $galleries = Gallery::with('images')->get();

        Log::info('Fetched all galleries.');

        return response()->json($galleries);
    }

    public function getGalleryImages($galleryId)
    {
        // Fetch the gallery and its images
        $gallery = Gallery::find($galleryId);
    
        if (!$gallery) {
            return response()->json(['message' => 'Gallery not found'], 404);
        }
    
        // Get all images associated with the gallery
        $images = GalleryImage::where('gallery_id', $galleryId)->get();
    
        // Return the gallery name along with the images
        return response()->json([
            'gallery_name' => $gallery->gallery_name,
            'images' => $images,
        ]);
    }

    public function getArtistImages()
    {
        // Get the authenticated artist
        $artist = Auth::guard('artist')->user();

        if (!$artist) {
            Log::warning('Unauthorized user attempted to get artist images.');
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $artistId = $artist->id;

        // Get tattoo session images and other details for the artist
        $tattooSessions = TattooSession::where('artist_id', $artistId)->get([ 'end_session_image', 'timer', 'session_cost']);
        
        $tattooImages = [];

        foreach ($tattooSessions as $session) {
            // Decode the images if stored as a JSON array
            $sessionImages = json_decode($session->images, true) ?? [];
            foreach ($sessionImages as $image) {
                $tattooImages[] = [
                    'image_url' => $image,
                    'timer' => $session->timer,
                    'session_cost' => $session->session_cost,
                ];
            }

            // Add the end_session_image if it exists
            if (!empty($session->end_session_image)) {
                $tattooImages[] = [
                    'image_url' => $session->end_session_image,
                    'timer' => $session->timer,
                    'cost' => $session->session_cost,
                ];
            }
        }

        // Get all gallery images for the artist and their details
        $galleryImages = GalleryImage::whereHas('gallery', function ($query) use ($artistId) {
            $query->where('artist_id', $artistId);
        })->get(['image_url', 'timer', 'hourly rate', 'cost']);

        $formattedGalleryImages = $galleryImages->map(function ($image) {
            return [
                'image_url' => $image->image_url,
                'timer' => $image->timer,
                'hourly_rate' => $image->{'hourly rate'},
                'cost' => $image->cost,
            ];
        });

        Log::info('Fetched all images and details for the artist.', ['artist_id' => $artistId]);

        return response()->json([
            'tattoo_images' => $tattooImages,
            'gallery_images' => $formattedGalleryImages,
        ]);
    }


}
