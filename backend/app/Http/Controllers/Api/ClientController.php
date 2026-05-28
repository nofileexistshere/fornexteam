<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::where('is_active', true)
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($client) {
                return [
                    'id' => $client->id,
                    'name' => $client->name,
                    'website' => $client->website,
                    'logo' => $client->logo,
                    'logo_url' => $client->logo ? url('storage/' . $client->logo) : null,
                    'description' => $client->description,
                    'order' => $client->order,
                ];
            });
            
        return response()->json($clients);
    }
}
