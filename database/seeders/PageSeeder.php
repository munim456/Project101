<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::updateOrCreate(
            ['slug' => 'privacy-policy'],
            [
                'title' => 'Privacy Policy',
                'body' => '<p>Placeholder privacy policy — to be replaced with content reviewed against the Australian Privacy Principles (APPs) before launch. Editable from the admin dashboard.</p>',
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'terms'],
            [
                'title' => 'Terms & Conditions',
                'body' => '<p>Placeholder terms and conditions — to be confirmed with the client before launch. Editable from the admin dashboard.</p>',
            ]
        );
    }
}
