<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News_article;
use Illuminate\Support\Facades\File;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $josn = File::get(path:'database/json/news.json');
        $news_article = collect(json_decode($josn));

        $news_article->each(function ($news_article){
            News_article::create([
                'title' => $news_article->title,
                'category' => $news_article->category,
                'shortDesc' => $news_article->shortDesc,
                'image_url' => $news_article->image_url,
                'image_id' => $news_article->image_id,
                'description' => $news_article->description,
                'tags' => $news_article->tags,
                'status' => $news_article->status,
                'creator_id' => $news_article->creator_id,
            ]);
        });
    }
}
