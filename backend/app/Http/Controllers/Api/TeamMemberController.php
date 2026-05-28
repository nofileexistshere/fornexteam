<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $team = TeamMember::where('is_active', true)
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($member) {
                return [
                    'id' => $member->id,
                    'name' => $member->name,
                    'position' => $member->position,
                    'bio' => $member->bio,
                    'photo' => $member->photo,
                    'photo_url' => $member->photo ? url('storage/' . $member->photo) : null,
                    'linkedin' => $member->linkedin,
                    'instagram' => $member->instagram,
                    'order' => $member->order,
                ];
            });
            
        return response()->json($team);
    }
}
