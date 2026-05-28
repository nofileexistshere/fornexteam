<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSection;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroSection::create([
            'badge_text' => '#nexteam',
            'heading' => 'Innovate. Excellent!. Succeed!.',
            'description' => 'Penyedia layanan teknologi di bidang Computers, Internet, dan Website yang mudah diakses.',
            'image_light' => null, // Will use default /hero/hero-putih.png
            'image_dark' => null, // Will use default /hero/hero-hitam.png
            'primary_button_text' => 'View Projects',
            'primary_button_url' => '/project',
            'secondary_button_text' => 'Watch Video',
            'secondary_button_url' => null,
            'show_secondary_button' => true,
            'is_active' => true,
        ]);
    }
}
