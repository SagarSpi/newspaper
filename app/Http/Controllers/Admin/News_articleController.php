<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News_article;

use function Pest\Laravel\get;

class News_articleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $newsArticle = News_article::where('status','active')
        //                             ->orderBy('created_at','DESC')
        //                             ->chunk(6,function ($newsArticle) {
        //                                 foreach ($newsArticle as $news) {

        //                                 }
        //                             });

        // return $newsArticle;
        return view('admin.newsArticle');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.newsCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('admin.newsEdit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
