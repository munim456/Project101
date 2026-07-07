<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        Announcement::updateOrCreate(
            ['message' => 'Patients with respiratory symptoms are asked to wear a mask while in the waiting room.'],
            ['type' => 'info', 'is_active' => true]
        );

        Announcement::updateOrCreate(
            ['message' => 'November is Diabetes Awareness Month — ask your GP about a diabetes health check.'],
            ['type' => 'info', 'is_active' => false]
        );
    }
}
