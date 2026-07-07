<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $category = Category::where('slug', 'chronic-disease')->first();

        Post::updateOrCreate(
            ['slug' => 'managing-diabetes-with-your-gp'],
            [
                'user_id' => $admin?->id,
                'category_id' => $category?->id,
                'title' => 'Managing Diabetes with Your GP',
                'excerpt' => 'Practical tips on managing type 2 diabetes with regular GP care.',
                'body' => '<p>Diabetes management works best with <strong>regular GP visits</strong>, blood sugar monitoring, and a tailored care plan. Your GP can help coordinate referrals, medication reviews, and lifestyle support as part of ongoing chronic disease management.</p>',
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ]
        );
    }
}
