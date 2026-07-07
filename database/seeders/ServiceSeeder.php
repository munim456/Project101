<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Medical Treatment',
                'icon' => 'heart',
                'short_description' => 'General medical care for the whole family, five days a week.',
                'description' => 'Our GPs provide comprehensive medical treatment for patients of all ages, from routine check-ups to ongoing management of health conditions.',
            ],
            [
                'title' => 'Emergency Help',
                'icon' => 'exclamation-triangle',
                'short_description' => 'Urgent same-day appointments for pressing health concerns.',
                'description' => 'For urgent but non-life-threatening concerns, same-day appointments are available. For medical emergencies, always call 000.',
            ],
            [
                'title' => 'Medical Professionals',
                'icon' => 'user-group',
                'short_description' => 'An experienced, caring team you can build a relationship with.',
                'description' => 'Our practice is staffed by experienced GPs and support staff dedicated to continuity of care for every patient.',
            ],
            [
                'title' => 'Qualified Doctors',
                'icon' => 'academic-cap',
                'short_description' => 'FRACGP-qualified GPs with specialised areas of interest.',
                'description' => 'Our doctors hold recognised qualifications and bring specialised experience in mental health, chronic disease, and occupational health.',
            ],
        ];

        foreach ($services as $index => $service) {
            Service::updateOrCreate(
                ['slug' => Str::slug($service['title'])],
                [
                    'title' => $service['title'],
                    'icon' => $service['icon'],
                    'short_description' => $service['short_description'],
                    'description' => $service['description'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
