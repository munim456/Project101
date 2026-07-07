<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Page;
use App\Models\Section;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about', [
            'about' => optional(Section::where('key', 'about')->first())->content ?? [],
            'doctors' => Doctor::active()->get(),
        ]);
    }

    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('pages.static', ['page' => $page]);
    }
}
