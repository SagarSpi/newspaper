<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Article;

class CategoryController extends Controller
{
    function categoryPage(string $category)
    {
        $lead_news = Article::where([
                            ['status','active'],
                            ['category',$category],
                        ])
                        ->orderByDesc('created_at')
                        ->first();

        $lead_news_sidebar = Article::where([
                            ['status','active'],
                            ['category',$category]
                        ])
                        ->orderByDesc('created_at')
                        ->skip(1)
                        ->take(3)
                        ->get();

        $cat_news = Article::where([
                            ['status','active'],
                            ['category',$category]
                        ])
                        ->orderByDesc('created_at')
                        ->skip(4)
                        ->take(12)
                        ->get();

        $cat_news_sidebar = Article::where([
                            ['status','active'],
                            ['category',$category]
                        ])
                        ->orderByDesc('created_at')
                        ->skip(16)
                        ->take(10)
                        ->get();

        return view('frontend.category.category',[
            'lead_news'=> $lead_news,
            'lead_news_side'=>$lead_news_sidebar,
            'cat_news' => $cat_news,
            'cat_news_side'=>$cat_news_sidebar
        ]);
    }
}
