<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return response()->json($media);
    }

    public function show($slug)
    {
        $media = Media::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Increment views
        $media->increment('views');

        return response()->json($media);
    }
}
