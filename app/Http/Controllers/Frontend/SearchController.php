<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchNews(Request $request) 
    {
        $search = $request->search;

        $news = Article::where('status', 'active')->latest() // শুধুমাত্র অ্যাকটিভ নিউজ নিবো
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%$search%")
                    ->orWhere('tags', 'like', "%$search%");
                });
            });

        $searchNews = $news->paginate(2)->withQueryString(); // পেজিনেশনে সার্চ টার্ম ধরে রাখবে

    return view('frontend.search.searchNews', compact('searchNews'));
    }
}
