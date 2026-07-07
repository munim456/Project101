@extends('layouts.admin')

@section('title', 'Site Settings')
@section('heading', 'Site Settings')
@section('subheading', 'Clinic details, opening hours, HealthEngine link, and other site-wide values.')

@section('content')
    <form method="POST" action="{{ route('admin.settings.update') }}" class="max-w-2xl space-y-6 bg-white border border-primary-100 rounded-2xl p-8">
        @csrf
        @method('PUT')

        <x-admin.field label="Clinic name" name="clinic_name">
            <input type="text" id="clinic_name" name="clinic_name" value="{{ old('clinic_name', $settings['clinic_name']) }}" required
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <div class="grid grid-cols-2 gap-5">
            <x-admin.field label="Phone" name="clinic_phone">
                <input type="text" id="clinic_phone" name="clinic_phone" value="{{ old('clinic_phone', $settings['clinic_phone']) }}"
                       class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
            </x-admin.field>
            <x-admin.field label="Email" name="clinic_email">
                <input type="email" id="clinic_email" name="clinic_email" value="{{ old('clinic_email', $settings['clinic_email']) }}"
                       class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
            </x-admin.field>
        </div>

        <x-admin.field label="Address" name="clinic_address">
            <input type="text" id="clinic_address" name="clinic_address" value="{{ old('clinic_address', $settings['clinic_address']) }}"
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <x-admin.field label="Opening hours" name="opening_hours" hint="One line per row, shown as-is in the footer.">
            <textarea id="opening_hours" name="opening_hours" rows="3"
                      class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">{{ old('opening_hours', $settings['opening_hours']) }}</textarea>
        </x-admin.field>

        <x-admin.field label="HealthEngine booking URL" name="healthengine_url" hint="Get this from the clinic's HealthEngine practice dashboard. Used site-wide for every Book Appointment button.">
            <input type="url" id="healthengine_url" name="healthengine_url" value="{{ old('healthengine_url', $settings['healthengine_url']) }}"
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <x-admin.field label="Google Map embed (optional)" name="google_map_embed" hint="Paste the <iframe> embed code from Google Maps.">
            <textarea id="google_map_embed" name="google_map_embed" rows="3"
                      class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base font-mono text-sm">{{ old('google_map_embed', $settings['google_map_embed']) }}</textarea>
        </x-admin.field>

        <x-admin.field label="Analytics snippet (optional)" name="analytics_snippet" hint="Paste your Google Analytics (or other) tracking code.">
            <textarea id="analytics_snippet" name="analytics_snippet" rows="3"
                      class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base font-mono text-sm">{{ old('analytics_snippet', $settings['analytics_snippet']) }}</textarea>
        </x-admin.field>

        <x-admin.field label="Footer text" name="footer_text">
            <textarea id="footer_text" name="footer_text" rows="2"
                      class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">{{ old('footer_text', $settings['footer_text']) }}</textarea>
        </x-admin.field>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3 rounded-xl">Save Settings</button>
        </div>
    </form>
@endsection
