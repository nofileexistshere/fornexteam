<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json($testimonials);
    }
}
