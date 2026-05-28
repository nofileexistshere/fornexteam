<?php

namespace Database\Seeders;

use App\Models\Cta;
use Illuminate\Database\Seeder;

class CtaSeeder extends Seeder
{
    public function run(): void
    {
        Cta::create([
            'title' => 'Get started with Nexteam today',
            'description' => 'Diskusikan kebutuhan bisnis Anda bersama kami. Kami bantu merancang solusi teknologi yang tepat, efisien, dan siap membantu bisnis Anda tumbuh.',
            'button_text' => "Let's connect",
            'button_link' => '/contact',
            'is_active' => true,
        ]);
    }
}
