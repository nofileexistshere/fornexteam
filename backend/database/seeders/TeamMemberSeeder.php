<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name' => 'Calvin Nicholas',
                'position' => 'Fullstack Developer',
                'bio' => null,
                'photo' => null,
                'linkedin' => 'https://www.linkedin.com/in/calvin-nicholas-6929431b0/',
                'instagram' => 'https://www.instagram.com/calvinnicholasss/',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Dwiki Arlian Maulana',
                'position' => 'System Engineer',
                'bio' => null,
                'photo' => null,
                'linkedin' => 'https://www.linkedin.com/in/dwiki-arlian-maulana-852b14209/',
                'instagram' => 'https://www.instagram.com/wikiarlnm/',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Fikri Pandu Wibawa',
                'position' => 'UI/UX Designer',
                'bio' => null,
                'photo' => null,
                'linkedin' => 'https://www.linkedin.com/in/fikri-pandu-wibawa-2aaaa5270/',
                'instagram' => 'https://www.instagram.com/fikri_pandu12/',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'M. Rafli Octavian',
                'position' => 'Mobile Developer',
                'bio' => null,
                'photo' => null,
                'linkedin' => 'https://www.linkedin.com/in/muhammad-rafli-octavian-8b3055231/',
                'instagram' => 'https://www.instagram.com/taoc.6ix/',
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($members as $member) {
            TeamMember::create($member);
        }
    }
}
