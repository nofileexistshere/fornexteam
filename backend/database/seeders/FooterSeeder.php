<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FooterSection;
use App\Models\FooterLink;
use App\Models\SocialLink;
use App\Models\FooterPage;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Footer Sections with Links
        $sections = [
            [
                'title' => 'Other Places',
                'order' => 1,
                'links' => [
                    ['title' => 'Fastwork', 'url' => 'https://fastwork.id/user/wikiarlnm/technical-support-53320956', 'is_external' => true, 'open_new_tab' => true],
                    ['title' => 'Upwork', 'url' => 'https://www.upwork.com/services/product/development-it-technical-support-jaringan-website-toubleshooting-1936466459809396282', 'is_external' => true, 'open_new_tab' => true],
                    ['title' => 'Sribu', 'url' => 'https://www.sribu.com/id/users/wikiarlianm/technical-support-32a666c4-d3a8-45be-af61-a4b54ec3ebdb', 'is_external' => true, 'open_new_tab' => true],
                ],
            ],
            [
                'title' => 'Company',
                'order' => 2,
                'links' => [
                    ['title' => 'About Us', 'url' => '/about-us', 'is_external' => false],
                    ['title' => 'Projects', 'url' => '/project', 'is_external' => false],
                    ['title' => 'Contact', 'url' => '/contact', 'is_external' => false],
                ],
            ],
            [
                'title' => 'Legal',
                'order' => 3,
                'links' => [
                    ['title' => 'Terms', 'url' => '/terms', 'is_external' => false],
                    ['title' => 'Privacy', 'url' => '/privacy', 'is_external' => false],
                    ['title' => 'License', 'url' => '/license', 'is_external' => false],
                ],
            ],
            [
                'title' => 'Resources',
                'order' => 4,
                'links' => [
                    ['title' => 'Blog', 'url' => '/blog', 'is_external' => false],
                    ['title' => 'Media', 'url' => '/', 'is_external' => false],
                    ['title' => 'Store', 'url' => '/store', 'is_external' => false],
                ],
            ],
            [
                'title' => 'Social',
                'order' => 5,
                'links' => [
                    ['title' => 'Instagram', 'url' => 'https://www.instagram.com/fornexteam/', 'is_external' => true, 'open_new_tab' => true],
                    ['title' => 'LinkedIn', 'url' => 'https://www.linkedin.com/company/nofileexistshere/', 'is_external' => true, 'open_new_tab' => true],
                    ['title' => 'Tiktok', 'url' => 'https://www.tiktok.com/@fornexteam', 'is_external' => true, 'open_new_tab' => true],
                ],
            ],
            [
                'title' => 'Tools',
                'order' => 6,
                'links' => [
                    ['title' => 'Speedtest', 'url' => '/speedtest', 'is_external' => false],
                ],
            ],
        ];

        foreach ($sections as $sectionData) {
            $section = FooterSection::create([
                'title' => $sectionData['title'],
                'order' => $sectionData['order'],
                'is_active' => true,
            ]);

            foreach ($sectionData['links'] as $index => $linkData) {
                FooterLink::create([
                    'footer_section_id' => $section->id,
                    'title' => $linkData['title'],
                    'url' => $linkData['url'],
                    'is_external' => $linkData['is_external'] ?? false,
                    'open_new_tab' => $linkData['open_new_tab'] ?? false,
                    'order' => $index,
                    'is_active' => true,
                ]);
            }
        }

        // Create Social Links
        $socialLinks = [
            ['name' => 'Instagram', 'url' => 'https://www.instagram.com/fornexteam/', 'icon' => 'instagram', 'order' => 1],
            ['name' => 'LinkedIn', 'url' => 'https://www.linkedin.com/company/nofileexistshere/', 'icon' => 'linkedin', 'order' => 2],
            ['name' => 'TikTok', 'url' => 'https://www.tiktok.com/@fornexteam', 'icon' => 'tiktok', 'order' => 3],
        ];

        foreach ($socialLinks as $socialLink) {
            SocialLink::create(array_merge($socialLink, ['is_active' => true]));
        }

        // Create Sample Footer Pages
        $pages = [
            [
                'title' => 'Terms of Service',
                'slug' => 'terms',
                'excerpt' => 'Terms and conditions for using our services',
                'content' => '<h2>Terms of Service</h2><p>This is a sample terms of service page. You can edit this content in the CMS.</p>',
                'is_published' => true,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy',
                'excerpt' => 'How we handle and protect your data',
                'content' => '<h2>Privacy Policy</h2><p>This is a sample privacy policy page. You can edit this content in the CMS.</p>',
                'is_published' => true,
            ],
            [
                'title' => 'License',
                'slug' => 'license',
                'excerpt' => 'Software license information',
                'content' => '<h2>License</h2><p>This is a sample license page. You can edit this content in the CMS.</p>',
                'is_published' => true,
            ],
        ];

        foreach ($pages as $page) {
            FooterPage::create($page);
        }
    }
}
