<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Article;

class DetailsController extends Controller
{
    function detailsPage(int $id)
    {
        $news_details = Article::findOrFail($id);

        $related_news = Article::where([
                                ['status','active'],
                                ['category',$news_details->category],
                            ])
                            ->whereNot('id', $id)
                            ->take(4)
                            ->get();

        $latest_news = Article::where('status','active')
                                ->whereNot('id',$id)
                                ->orderByDesc('created_at')
                                ->take(9)
                                ->get();

        $trading_news = Article::where('status','active')
                                    ->whereNot('id',$id)
                                    ->orderByDesc('visits')
                                    ->take(7)
                                    ->get();

        return view('frontend.details',[
            'news_details'=>$news_details,
            'related_news'=>$related_news,
            'latest_news'=>$latest_news,
            'trading_news'=>$trading_news
        ]);
    }
}
