<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Backend\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $article = Article::with('user')
        ->orderBy('created_at','DESC')
        ->paginate(9);

        return view('backend.article',compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.articleCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
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

        $article = new Article();
        $article->title = $request->title;
        $article->category = $request->category;
        $article->shortDesc = $request->shortDesc;
        $article->image_url = $uploadedFileUrl;
        $article->image_id = $public_id;
        $article->description = $request->description;
        $article->tags = $request->tags;
        $article->user_id = 1;
        $article->status = 'active';
        $article->save();

        return redirect()->route('article.create')->with('success','News Create Successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id);
        return view('backend.articleDetail',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        return view('backend.articleEdit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, string $id)
    {
        $article = Article::findOrFail($id);

        if ($request->hasFile('image')) {

            // Old database Image Id 
            $storedImageId = $article->image_id;

            $defaultImageId = 'Newspaper/Default_image/news_defalult_image';

            if ($storedImageId && $storedImageId !== $defaultImageId) {
                Cloudinary::destroy($storedImageId);
            }

            $timeStamp = Carbon::now()->format('Y-M');
            $folderName = 'Newspaper/'. $timeStamp;
            $imageUniqueName = time();

            // Upload with image to cloudinary
            $uploadimage = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => $folderName,
                'public_id'=> $imageUniqueName
            ]);
            
            $article->image_url = $uploadimage->getSecurePath();
            $article->image_id = $uploadimage->getPublicId();
        }

        $article->title = $request->title;
        $article->category = $request->category;
        $article->shortDesc = $request->shortDesc;
        $article->description = $request->description;
        $article->tags = $request->tags;
        $article->status = 'active';
        $article->save();

        return redirect()->route('article.show',$article->id)->with('success', 'News Update Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        $article->status = 'deleted';
        $article->deleted_at = now();
        $article->save();
    }
}
