<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@cgmp.test'],
            [
                'name' => 'CGMP Admin',
                'password' => 'password',
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            CategorySeeder::class,
            DoctorSeeder::class,
            ServiceSeeder::class,
            AnnouncementSeeder::class,
            SettingSeeder::class,
            PageSeeder::class,
        ]);
    }
}
