@extends('layouts.admin')

@section('title', 'About Section')
@section('heading', 'About the Practice')
@section('subheading', 'Shown on the homepage and the About page.')

@section('content')
    <form method="POST" action="{{ route('admin.sections.update', 'about') }}"
          class="max-w-2xl space-y-6 bg-white border border-primary-100 rounded-2xl p-8">
        @csrf
        @method('PUT')

        <x-admin.field label="Heading" name="heading">
            <input type="text" id="heading" name="heading" value="{{ old('heading', $section->content['heading'] ?? '') }}" required
                   class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
        </x-admin.field>

        <x-admin.field label="Body text" name="body">
            <textarea id="body" name="body" rows="5"
                      class="w-full rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">{{ old('body', $section->content['body'] ?? '') }}</textarea>
        </x-admin.field>

        <div x-data="{ points: {{ Js::from(old('points', $section->content['points'] ?? [''])) }} }">
            <label class="block text-sm font-medium text-primary-900 mb-2">Key points (checkmark list)</label>
            <div class="space-y-2">
                <template x-for="(point, i) in points" :key="i">
                    <div class="flex gap-2">
                        <input type="text" :name="'points[' + i + ']'" x-model="points[i]"
                               class="flex-1 rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
                        <button type="button" @click="points.splice(i, 1)" class="text-red-600 px-2">✕</button>
                    </div>
                </template>
            </div>
            <button type="button" @click="points.push('')" class="text-primary text-sm font-medium mt-2">+ Add point</button>
        </div>

        <div x-data="{ stats: {{ Js::from(old('stats', $section->content['stats'] ?? [['label' => '', 'value' => '']])) }} }">
            <label class="block text-sm font-medium text-primary-900 mb-2">Stats with count-up animation</label>
            <div class="space-y-2">
                <template x-for="(stat, i) in stats" :key="i">
                    <div class="flex gap-2">
                        <input type="text" :name="'stats[' + i + '][label]'" x-model="stat.label" placeholder="Label, e.g. Years serving the community"
                               class="flex-1 rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
                        <input type="number" :name="'stats[' + i + '][value]'" x-model="stat.value" placeholder="Number"
                               class="w-28 rounded-lg border-primary-200 focus:border-primary focus:ring-primary text-base">
                        <button type="button" @click="stats.splice(i, 1)" class="text-red-600 px-2">✕</button>
                    </div>
                </template>
            </div>
            <button type="button" @click="stats.push({label: '', value: ''})" class="text-primary text-sm font-medium mt-2">+ Add stat</button>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-accent hover:bg-accent-dark text-white font-semibold px-6 py-3 rounded-xl">Save About Section</button>
        </div>
    </form>
@endsection
