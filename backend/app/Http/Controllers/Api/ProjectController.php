<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('is_published', true)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json($projects);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
        
        return response()->json($project);
    }
    
    public function featured()
    {
        $projects = Project::where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->get();
            
        return response()->json($projects);
    }
}
