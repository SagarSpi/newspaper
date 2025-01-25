<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News_article;
use App\Http\Requests\NewsRequest;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
            $folderName = 'Newspaper/'. $timeStamp;
            $imageUniqueName = time();

            // Upload with image to cloudinary
            $uploadimage = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => $folderName,
                'public_id'=> $imageUniqueName
            ]);
            
            $uploadedFileUrl = $uploadimage->getSecurePath();
            $public_id = $uploadimage->getPublicId();
        }else{
            $uploadedFileUrl = 'https://res.cloudinary.com/demeqriqu/image/upload/v1737737855/Newspaper/Default_image/news_defalult_image.png';
            $public_id = 'Newspaper/Default_image/news_defalult_image';
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
    public function edit(string $id)
    {   
        $news = News_article::findOrFail($id);

        return view('admin.newsEdit',compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, string $id)
    {
        $news = News_article::findOrFail($id);

        if ($request->hasFile('image')) {

            // Old database Image Id 
            $StoreImageId = $news->image_id;

            $defaultImageId = 'Newspaper/Default_image/news_defalult_image';

            if ($StoreImageId !== $defaultImageId) {
                Cloudinary::destroy($StoreImageId);
            }

            $timeStamp = Carbon::now()->format('Y-M');
            $folderName = 'Newspaper/'. $timeStamp;
            $imageUniqueName = time();

            // Upload with image to cloudinary
            $uploadimage = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => $folderName,
                'public_id'=> $imageUniqueName
            ]);
            
            $news->image_url = $uploadimage->getSecurePath();
            $news->image_id = $uploadimage->getPublicId();
        }

        $news->title = $request->title;
        $news->category = $request->category;
        $news->shortDesc = $request->shortDesc;
        $news->description = $request->description;
        $news->tags = $request->tags;
        $news->created_by = $request->creator;
        $news->creator_id = 1;
        // $news->creator_id = auth()->id();
        $news->status = 'active';
        $news->save();

        return redirect()->route('news.show',$news->id)->with('success', 'News Update Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News_article::findOrFail($id);

        $news->status = 'deleted';
        $news->deleted_at = now();
        $news->save();
    }
}
