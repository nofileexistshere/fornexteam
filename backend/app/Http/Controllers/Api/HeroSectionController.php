<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\JsonResponse;

class HeroSectionController extends Controller
{
    /**
     * Get the active hero section
     */
    public function index(): JsonResponse
    {
        $heroSection = HeroSection::active()->first();

        if (!$heroSection) {
            return response()->json([
                'success' => false,
                'message' => 'No active hero section found',
                'data' => null,
            ], 404);
        }

        // Add full URL for images (null if no image uploaded)
        $heroSection->image_light_url = $heroSection->image_light 
            ? url('storage/' . $heroSection->image_light) 
            : null;
            
        $heroSection->image_dark_url = $heroSection->image_dark 
            ? url('storage/' . $heroSection->image_dark) 
            : null;

        return response()->json([
            'success' => true,
            'data' => $heroSection,
        ]);
    }
}
