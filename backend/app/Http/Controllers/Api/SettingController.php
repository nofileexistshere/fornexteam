<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        
        return response()->json($settings);
    }
    
    public function show($key)
    {
        $setting = Setting::where('key', $key)->firstOrFail();
        
        return response()->json($setting);
    }
}
