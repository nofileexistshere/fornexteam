<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cta;
use Illuminate\Http\Request;

class CtaController extends Controller
{
    public function index()
    {
        $cta = Cta::where('is_active', true)
            ->latest()
            ->first();

        if (!$cta) {
            return response()->json(null, 204);
        }

        return response()->json($cta);
    }
}
