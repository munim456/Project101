<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        Doctor::updateOrCreate(
            ['name' => 'Dr Homayera Noor'],
            [
                'role' => 'Practice Principal',
                'qualifications' => 'MBBS, DCH, FRACGP',
                'bio' => 'Dr Homayera Noor is the Practice Principal at Cringila General Medical Practice, with a special interest in mental health, and men\'s and women\'s health.',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        Doctor::updateOrCreate(
            ['name' => 'Dr Muhammad Iqbal'],
            [
                'role' => 'General Practitioner',
                'qualifications' => 'MBBS, Dip. Occup. Health & Safety (UOW), NSW Medical Acupuncture Course',
                'bio' => 'Dr Muhammad Iqbal brings additional expertise in occupational health and medical acupuncture to the practice.',
                'sort_order' => 2,
                'is_active' => true,
            ]
        );
    }
}
