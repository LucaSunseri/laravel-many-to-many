<?php

use App\Post;
use App\Category;
use Illuminate\Database\Seeder;

class UpdatePostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            $post->category_id = Category::inRandomOrder()->first()->id;

            $post->save();
        }
    }
}
