<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Article;

class HomeController extends Controller
{
    public function homePage()
    {
        $lead_news = Article::where('status','active')
                                    ->orderByDesc('created_at')
                                    ->first();

        $lead_sidebar_news = Article::where('status','active')
                                    ->orderByDesc('created_at')
                                    ->skip(1)
                                    ->take(3)
                                    ->get();

        $hero_news = Article::where('status','active')
                                ->orderByDesc('created_at')
                                ->skip(4)
                                ->take(6)
                                ->get();
                            
        $hero_sidebar_news = Article::where('status','active')
                                    ->orderByDesc('created_at')
                                    ->skip(10)
                                    ->take(10)
                                    ->get();

        $politics_news = Article::where('status','active')
                                ->where('category','Politics')
                                ->orderByDesc('created_at')
                                ->take(6)
                                ->get();

        $politics_news_sidebar = Article::where('status','active')
                                ->where('category','Politics')
                                ->orderByDesc('created_at')
                                ->skip(6)
                                ->take(10)
                                ->get();

        $business_news = Article::where('status','active')
                                ->where('category','Business')
                                ->orderByDesc('created_at')
                                ->take(6)
                                ->get();

        $business_news_sidebar = Article::where('status','active')
                                        ->where('category','Business')
                                        ->orderByDesc('created_at')
                                        ->skip(6)
                                        ->take(6)
                                        ->get();
        
        $sports_news = Article::where('status','active')
                                ->where('category','Sports')
                                ->orderByDesc('created_at')
                                ->take(6)
                                ->get();
        
        $sports_news_sidebar = Article::where('status','active')
                                        ->where('category','Sports')
                                        ->orderByDesc('created_at')
                                        ->skip(6)
                                        ->take(6)
                                        ->get();

        $education_news = Article::where('status','active')
                                ->where('category','Education')
                                ->orderByDesc('created_at')
                                ->take(6)
                                ->get();
                
        $education_news_sidebar = Article::where('status','active')
                                        ->where('category','Education')
                                        ->orderByDesc('created_at')
                                        ->skip(6)
                                        ->take(6)
                                        ->get();

        return view('frontend.home.home',[
            'lead_news'=>$lead_news,
            'lead_news_side'=>$lead_sidebar_news,
            'hero_news'=>$hero_news,
            'hero_news_side'=>$hero_sidebar_news,
            'politics_news'=>$politics_news,
            'politics_news_side'=>$politics_news_sidebar,
            'business_news'=>$business_news,
            'business_news_side'=>$business_news_sidebar,
            'sports_news'=>$sports_news,
            'sports_news_side'=>$sports_news_sidebar,
            'education_news'=>$education_news,
            'education_news_side'=>$education_news_sidebar,
        ]);
    }
}
