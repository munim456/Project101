<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Support\ImageUploader;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        return view('admin.media.index', [
            'media' => Media::latest()->paginate(24),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required', 'image', 'max:8192', 'mimes:jpg,jpeg,png,webp,svg'],
            'alt_text' => ['nullable', 'string', 'max:255'],
        ]);

        $path = ImageUploader::store($request->file('file'), 'media');

        Media::create([
            'filename' => $request->file('file')->getClientOriginalName(),
            'path' => $path,
            'alt_text' => $request->input('alt_text'),
        ]);

        return redirect()->route('admin.media.index')->with('status', 'Image uploaded.');
    }

    public function destroy(Media $media)
    {
        ImageUploader::delete($media->path);
        $media->delete();

        return redirect()->route('admin.media.index')->with('status', 'Image deleted.');
    }
}
