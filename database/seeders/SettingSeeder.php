<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'clinic_name' => 'Cringila General Medical Practice',
            'clinic_phone' => '(02) 4276 1234',
            'clinic_email' => 'reception@cgmp.com.au',
            'clinic_address' => '1 Military Road, Cringila NSW 2502',
            'opening_hours' => "Monday – Friday: 8:30am – 5:30pm\nSaturday – Sunday: Closed",
            'healthengine_url' => 'https://healthengine.com.au/facility/cringila-general-medical-practice',
            'google_map_embed' => '',
            'analytics_snippet' => '',
            'footer_text' => 'Cringila General Medical Practice — open five days a week, same-day appointments available, walk-ins welcome.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Section::updateOrCreate(
            ['key' => 'hero'],
            ['content' => [
                'heading' => 'Compassionate care, close to home.',
                'subheading' => 'Same-day appointments available. Walk-ins welcome. Open five days a week.',
                'primary_button_text' => 'Book Appointment',
                'secondary_button_text' => 'Our Services',
            ]]
        );

        Section::updateOrCreate(
            ['key' => 'about'],
            ['content' => [
                'heading' => 'About Cringila General Medical Practice',
                'body' => "We're a GP clinic serving the Cringila and Wollongong community, with doctors specialising in mental health, men's and women's health, and chronic disease management. Same-day appointments are available and walk-ins are always welcome.",
                'points' => ['Open 5 days a week', 'Same-day appointments', 'Walk-ins welcome'],
                'stats' => [
                    ['label' => 'Years serving the community', 'value' => 15],
                    ['label' => 'Doctors', 'value' => 2],
                    ['label' => 'Patients cared for', 'value' => 8000],
                ],
            ]]
        );
    }
}
