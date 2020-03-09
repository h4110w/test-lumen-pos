<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'slug' => 'test',
            'title' => 'ini judul',
            'body' => 'ini body'
        ]);
    }
}
