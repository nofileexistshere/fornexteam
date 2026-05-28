<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\License;

class LicenseController extends Controller
{
    public function index()
    {
        $license = License::where('is_active', true)->first();

        if (!$license) {
            return response()->json(['message' => 'License not found'], 404);
        }

        return response()->json($license);
    }
}
