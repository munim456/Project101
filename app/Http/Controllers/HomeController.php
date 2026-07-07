<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Doctor;
use App\Models\Post;
use App\Models\Section;
use App\Models\Service;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'hero' => optional(Section::where('key', 'hero')->first())->content ?? [],
            'about' => optional(Section::where('key', 'about')->first())->content ?? [],
            'services' => Service::active()->get(),
            'doctors' => Doctor::active()->get(),
            'announcements' => Announcement::active()->get(),
            'testimonials' => Testimonial::active()->get(),
            'latestPosts' => Post::published()->latest('published_at')->take(4)->get(),
        ]);
    }
}
