<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'recentPosts' => Post::latest()->take(5)->get(),
            'unreadMessagesCount' => ContactMessage::where('is_read', false)->count(),
            'totalMessagesCount' => ContactMessage::count(),
            'publishedPostsCount' => Post::where('status', 'published')->count(),
        ]);
    }
}
