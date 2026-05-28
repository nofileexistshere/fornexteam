<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FooterSection;
use App\Models\SocialLink;
use Illuminate\Http\JsonResponse;

class FooterController extends Controller
{
    /**
     * Get all footer content (sections, links, and social links)
     */
    public function index(): JsonResponse
    {
        $sections = FooterSection::with(['links' => function ($query) {
            $query->active()->orderBy('order');
        }])
        ->active()
        ->orderBy('order')
        ->get();

        $socialLinks = SocialLink::active()
            ->orderBy('order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'sections' => $sections,
                'social_links' => $socialLinks,
            ],
        ]);
    }
}
