<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Support\ImageUploader;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function edit(string $key)
    {
        abort_unless(in_array($key, ['hero', 'about']), 404);

        $section = Section::firstOrCreate(['key' => $key], ['content' => []]);

        return view("admin.sections.{$key}", compact('section'));
    }

    public function update(Request $request, string $key)
    {
        abort_unless(in_array($key, ['hero', 'about']), 404);

        $section = Section::firstOrCreate(['key' => $key], ['content' => []]);

        $content = match ($key) {
            'hero' => $request->validate([
                'heading' => ['required', 'string', 'max:255'],
                'subheading' => ['nullable', 'string', 'max:500'],
                'primary_button_text' => ['nullable', 'string', 'max:100'],
                'secondary_button_text' => ['nullable', 'string', 'max:100'],
            ]),
            'about' => [
                ...$request->validate([
                    'heading' => ['required', 'string', 'max:255'],
                    'body' => ['nullable', 'string'],
                ]),
                'points' => array_values(array_filter($request->input('points', []))),
                'stats' => collect($request->input('stats', []))
                    ->filter(fn ($stat) => filled($stat['label'] ?? null))
                    ->values()
                    ->all(),
            ],
        };

        if ($key === 'hero') {
            $request->validate(['image' => ['nullable', 'image', 'max:4096', 'mimes:jpg,jpeg,png,webp']]);

            if ($request->boolean('remove_image')) {
                ImageUploader::delete($section->content['image'] ?? null);
                $content['image'] = null;
            } elseif ($request->hasFile('image')) {
                ImageUploader::delete($section->content['image'] ?? null);
                $content['image'] = ImageUploader::store($request->file('image'), 'sections');
            } else {
                $content['image'] = $section->content['image'] ?? null;
            }
        }

        Section::updateOrCreate(['key' => $key], ['content' => $content]);

        return redirect()->route('admin.sections.edit', $key)->with('status', ucfirst($key).' section updated.');
    }
}
