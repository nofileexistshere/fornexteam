<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    public function run(): void
    {
        ContactInfo::create([
            'title' => "let's get connected",
            'description' => 'Memberdayakan bisnis Anda melalui teknologi. Hubungi kami sekarang!',
            'chat_admin_name' => 'Chat Admin kami :',
            'chat_hours' => "Senin - Jum'at\n09:00 to 18:00 WIB",
            'address_title' => 'Jakarta',
            'address_line1' => 'Pasar Rebo - Jakarta Selatan, 16426,',
            'address_line2' => 'Indonesia',
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.8676851374824!2d106.8478875!3d-6.2956827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f2e6d7e3e7e7%3A0x7e7e7e7e7e7e7e7!2sPasar%20Rebo%2C%20Jakarta!5e0!3m2!1sen!2sid!4v1234567890123!5m2!1sen!2sid',
            'map_latitude' => -6.2956827,
            'map_longitude' => 106.8478875,
            'tiktok_url' => 'https://www.tiktok.com/@fornexteam',
            'instagram_url' => 'https://www.instagram.com/fornexteam/',
            'linkedin_url' => 'https://www.linkedin.com/company/nofileexistshere/',
            'is_active' => true,
        ]);
    }
}
