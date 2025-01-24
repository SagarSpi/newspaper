<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News_article;
use App\Http\Requests\NewsRequest;
use Carbon\Carbon;

class News_articleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $newsArticle = News_article::orderBy('created_at','DESC')
                                    ->paginate(9);

        return view('admin.newsArticle',compact('newsArticle'));
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
    public function store(NewsRequest $request)
    {
        if ($request->hasFile('image')) {

            $timeStamp = Carbon::now()->format('Y-M');
            $folderName = 'Newspaper/' . $timeStamp;
            $imageUniqueName = time();

            // Upload with image to cloudinary
            $uploadimage = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => $folderName,
                'public_id'=> $imageUniqueName
            ]);
            
            $uploadedFileUrl = $uploadimage->getSecurePath();
            $public_id = $uploadimage->getPublicId();
        }else{

        }
        $news = new News_article();
        $news->title = $request->title;
        $news->category = $request->category;
        $news->shortDesc = $request->shortDesc;
        $news->image_url = $uploadedFileUrl;
        $news->image_id = $public_id;
        $news->description = $request->description;
        $news->tags = $request->tags;
        $news->created_by = $request->creator;
        $news->creator_id = 1;
        // $news->creator_id = auth()->id();
        $news->status = 'active';
        $news->save();

        return redirect()->route('news.create')->with('success','News Create Successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News_article::findorfail($id);
        return view('admin.newsDetails',compact('news'));
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
