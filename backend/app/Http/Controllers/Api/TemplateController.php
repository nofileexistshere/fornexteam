<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::where('is_published', true)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json($templates);
    }

    public function show($slug)
    {
        $template = Template::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
        
        return response()->json($template);
    }
}
