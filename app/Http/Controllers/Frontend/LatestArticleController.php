<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Article;

class LatestArticleController extends Controller
{
    public function latestArticles()
    {
        $lead_news = Article::where('status','active')
                                ->latest()
                                ->first();

        $lead_news_sidebar = Article::where('status','active')
                                    ->latest()
                                    ->skip(1)
                                    ->take(3)
                                    ->get();

        $trading_news_sidebar = Article::where('status','active')
                                        ->orderBy('visits', 'desc')
                                        ->latest()
                                        ->take(14)
                                        ->get();

        $latest_news = Article::where('status','active')
                                ->latest()
                                ->skip(4)
                                ->take(12)
                                ->get();

        $latest_news_sidebar = Article::where('status','active')
                                ->latest()
                                ->skip(16)
                                ->take(12)
                                ->get();

        return view('frontend.letestNews.lastestNews',compact('lead_news','lead_news_sidebar','trading_news_sidebar','latest_news','latest_news_sidebar'));
    }
}
