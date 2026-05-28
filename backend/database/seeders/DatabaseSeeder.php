<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BlogPost;
use App\Models\Project;
use App\Models\Service;
use App\Models\Template;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\Client;
use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call dedicated seeders
        $this->call([
            ServiceSeeder::class,
            PageSeeder::class,
            BlogPostSeeder::class,
            MediaSeeder::class,
        ]);

        // Sample Projects
        Project::create([
            'name' => 'E-Commerce Platform',
            'slug' => 'ecommerce-platform',
            'description' => 'Platform e-commerce modern dengan fitur lengkap',
            'content' => '<p>Kami mengembangkan platform e-commerce yang powerful...</p>',
            'client_name' => 'PT. Digital Indonesia',
            'category' => 'Web Development',
            'technologies' => ['Laravel', 'Vue.js', 'TailwindCSS'],
            'is_featured' => true,
            'is_published' => true,
            'order' => 1,
        ]);

        // Sample Services
        Service::create([
            'name' => 'Web Development',
            'slug' => 'web-development',
            'short_description' => 'Layanan pengembangan website profesional',
            'description' => '<p>Kami menyediakan layanan pengembangan website yang komprehensif...</p>',
            'features' => ['Responsive Design', 'SEO Optimized', 'Fast Loading'],
            'is_featured' => true,
            'is_active' => true,
            'order' => 1,
        ]);

        // Sample Team Members
        TeamMember::create([
            'name' => 'John Doe',
            'position' => 'CEO & Founder',
            'bio' => 'Passionate about technology and innovation.',
            'email' => 'john@nexteam.com',
            'social_links' => [
                'linkedin' => 'https://linkedin.com/in/johndoe',
                'github' => 'https://github.com/johndoe',
            ],
            'is_active' => true,
            'order' => 1,
        ]);

        // Sample Testimonials
        Testimonial::create([
            'name' => 'Jane Smith',
            'company' => 'Tech Corp',
            'position' => 'CEO',
            'content' => 'Working with Nexteam has been an amazing experience. Highly recommended!',
            'rating' => 5,
            'is_featured' => true,
            'is_active' => true,
            'order' => 1,
        ]);

        // Sample Clients
        Client::create([
            'name' => 'Tech Company',
            'website' => 'https://techcompany.com',
            'description' => 'Leading technology company',
            'is_active' => true,
            'order' => 1,
        ]);

        // Sample FAQs
        Faq::create([
            'question' => 'Berapa lama waktu pengembangan website?',
            'answer' => 'Waktu pengembangan bervariasi tergantung kompleksitas, biasanya 2-8 minggu.',
            'category' => 'General',
            'is_active' => true,
            'order' => 1,
        ]);

        // Sample Settings
        Setting::create([
            'key' => 'site_name',
            'value' => 'Nexteam',
            'type' => 'text',
            'group' => 'general',
            'description' => 'Website name',
        ]);

        Setting::create([
            'key' => 'contact_email',
            'value' => 'info@nexteam.com',
            'type' => 'email',
            'group' => 'contact',
            'description' => 'Contact email address',
        ]);
    }
}
