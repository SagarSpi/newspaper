<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Backend\Article;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $josn = File::get(path:'database/json/article.json');
        $article = collect(json_decode($josn));

        $article->each(function ($article){
            Article::create([
                'title' => $article->title,
                'category' => $article->category,
                'shortDesc' => $article->shortDesc,
                'image_url' => $article->image_url,
                'image_id' => $article->image_id,
                'description' => $article->description,
                'tags' => $article->tags,
                'status' => $article->status,
                'user_id' => $article->user_id,
            ]);
        });
    }
}
