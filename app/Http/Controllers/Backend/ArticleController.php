<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Backend\Article;
use App\Http\Requests\ArticleRequest;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $article = Article::with(['user' => function ($query) {
            $query->select('id', 'name', 'email', 'contacts', 'role');
        }])
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

        $news = new Article();
        $news->title = $request->title;
        $news->category = $request->category;
        $news->shortDesc = $request->shortDesc;
        $news->image_url = $uploadedFileUrl;
        $news->image_id = $public_id;
        $news->description = $request->description;
        $news->tags = $request->tags;
        $news->status = 'active';
        $news->save();

        return redirect()->route('news.create')->with('success','News Create Successfully !');
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
            $StoreImageId = $article->image_id;

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

        return redirect()->route('news.show',$article->id)->with('success', 'News Update Successfully !');
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
