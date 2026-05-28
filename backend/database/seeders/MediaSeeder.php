<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $mediaItems = [
            [
                'title' => 'Team Kick-off Meeting Q1 2026',
                'slug' => 'team-kickoff-meeting-q1-2026',
                'description' => 'Kick-off meeting awal tahun untuk merencanakan roadmap dan strategi project Q1 2026. Sesi brainstorming yang produktif dengan seluruh tim.',
                'image' => null,
                'category' => 'Team Event',
                'tags' => ['Meeting', 'Team', 'Planning', '2026'],
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'views' => 89,
            ],
            [
                'title' => 'Launching E-Commerce Platform - Client ABC',
                'slug' => 'launching-ecommerce-platform-client-abc',
                'description' => 'Momen launching e-commerce platform untuk klien ABC setelah 3 bulan development. Platform dengan fitur payment gateway, inventory management, dan analytics dashboard.',
                'image' => null,
                'category' => 'Project',
                'tags' => ['E-Commerce', 'Launch', 'Web Development', 'Success'],
                'is_published' => true,
                'published_at' => now()->subDays(7),
                'views' => 156,
            ],
            [
                'title' => 'Workshop: Modern Web Architecture dengan Microservices',
                'slug' => 'workshop-modern-web-architecture-microservices',
                'description' => 'Internal workshop tentang microservices architecture, containerization, dan best practices dalam membangun scalable web applications.',
                'image' => null,
                'category' => 'Workshop',
                'tags' => ['Workshop', 'Learning', 'Microservices', 'Architecture'],
                'is_published' => true,
                'published_at' => now()->subDays(14),
                'views' => 203,
            ],
            [
                'title' => 'Office Setup - New Workspace 2026',
                'slug' => 'office-setup-new-workspace-2026',
                'description' => 'Setup workspace baru dengan desain modern dan minimalis. Ruang yang nyaman untuk produktivitas maksimal tim development.',
                'image' => null,
                'category' => 'Office',
                'tags' => ['Office', 'Workspace', 'Setup', 'Interior'],
                'is_published' => true,
                'published_at' => now()->subDays(21),
                'views' => 178,
            ],
            [
                'title' => 'Client Presentation - Infrastructure Upgrade Proposal',
                'slug' => 'client-presentation-infrastructure-upgrade',
                'description' => 'Presentasi proposal upgrade infrastruktur IT klien dari on-premise ke hybrid cloud architecture untuk improve reliability dan scalability.',
                'image' => null,
                'category' => 'Client Meeting',
                'tags' => ['Presentation', 'Infrastructure', 'Cloud', 'Proposal'],
                'is_published' => true,
                'published_at' => now()->subDays(28),
                'views' => 134,
            ],
            [
                'title' => 'Behind The Scenes - Mobile App Development',
                'slug' => 'behind-scenes-mobile-app-development',
                'description' => 'Proses development mobile app dari wireframe hingga deployment. Tim sedang fokus mengerjakan fitur real-time notification dan offline mode.',
                'image' => null,
                'category' => 'Behind The Scenes',
                'tags' => ['Mobile App', 'Development', 'BTS', 'Process'],
                'is_published' => true,
                'published_at' => now()->subDays(35),
                'views' => 245,
            ],
            [
                'title' => 'Team Outing - Refresh & Bonding Session',
                'slug' => 'team-outing-refresh-bonding',
                'description' => 'Sesi refresh tim setelah menyelesaikan beberapa project besar. Quality time untuk strengthen team bonding dan recharge energy.',
                'image' => null,
                'category' => 'Team Event',
                'tags' => ['Team Building', 'Outing', 'Fun', 'Bonding'],
                'is_published' => true,
                'published_at' => now()->subDays(42),
                'views' => 312,
            ],
            [
                'title' => 'Code Review Session - Best Practices & Standards',
                'slug' => 'code-review-session-best-practices',
                'description' => 'Sesi code review bersama untuk maintain code quality, share knowledge, dan ensure semua engineer follow coding standards yang sama.',
                'image' => null,
                'category' => 'Development',
                'tags' => ['Code Review', 'Best Practices', 'Team', 'Quality'],
                'is_published' => true,
                'published_at' => now()->subDays(49),
                'views' => 167,
            ],
            [
                'title' => 'Server Room Setup - New Infrastructure',
                'slug' => 'server-room-setup-new-infrastructure',
                'description' => 'Setup server room untuk on-premise infrastructure klien enterprise. Rack servers, networking equipment, dan monitoring system yang robust.',
                'image' => null,
                'category' => 'Infrastructure',
                'tags' => ['Server', 'Infrastructure', 'Hardware', 'Setup'],
                'is_published' => true,
                'published_at' => now()->subDays(56),
                'views' => 198,
            ],
        ];

        foreach ($mediaItems as $item) {
            Media::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}
