<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\JsonResponse;

class ContactInfoController extends Controller
{
    public function index(): JsonResponse
    {
        $contactInfo = ContactInfo::where('is_active', true)
            ->latest()
            ->first();

        if (!$contactInfo) {
            return response()->json(null, 204);
        }

        return response()->json($contactInfo);
    }
}
