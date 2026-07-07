<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = collect([
            ['loc' => route('home'), 'priority' => '1.0'],
            ['loc' => route('about'), 'priority' => '0.8'],
            ['loc' => route('services.index'), 'priority' => '0.8'],
            ['loc' => route('doctors'), 'priority' => '0.7'],
            ['loc' => route('blog.index'), 'priority' => '0.8'],
            ['loc' => route('booking'), 'priority' => '0.9'],
            ['loc' => route('contact'), 'priority' => '0.6'],
            ['loc' => route('privacy'), 'priority' => '0.3'],
            ['loc' => route('terms'), 'priority' => '0.3'],
        ]);

        Service::active()->get()->each(function ($service) use ($urls) {
            $urls->push(['loc' => route('services.show', $service->slug), 'priority' => '0.7']);
        });

        Post::published()->get()->each(function ($post) use ($urls) {
            $urls->push([
                'loc' => route('blog.show', $post->slug),
                'priority' => '0.6',
                'lastmod' => $post->updated_at->toAtomString(),
            ]);
        });

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
