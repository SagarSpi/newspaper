<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Backend\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $article = Article::with('user')
                        ->withCount('comments')
                        ->orderByDesc('created_at')
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

        try {
            DB::beginTransaction();
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

            Article::create([
                'title'=>$request->title,
                'category'=> $request->category,
                'shortDesc'=> $request->shortDesc,
                'image_url'=> $uploadedFileUrl,
                'image_id'=> $public_id,
                'description'=> $request->description,
                'tags'=> $request->tags,
                'user_id'=> Auth::id(),
                'status'=> 'active',
            ]);

            DB::commit();
            return redirect()->route('article.list')->with('success','News Create Successfully !');

        } catch (\Exception $err) {

            DB::rollBack();
            return back()->with('error', 'Something went wrong! Please try again.'.$err->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id);

        // Gate::authorize('view',$article);

        return view('backend.articleDetail',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);

        Gate::authorize('update',$article);

        return view('backend.articleEdit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, int $id)
    {
        $article = Article::findOrFail($id);

        if ($request->user()->cannot('update',$article)) {
            abort(403,"You are not authorized");
        }

        try {
            DB::beginTransaction();

            $uploadedFileUrl = $article->image_url; // Default to current image
            $public_id = $article->image_id; // Default to current image ID

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
                
                $uploadedFileUrl = $uploadimage->getSecurePath();
                $public_id = $uploadimage->getPublicId();
            }

            $article->update([
                'title'       => $request->title,
                'category'    => $request->category,
                'shortDesc'   => $request->shortDesc,
                'image_url'   => $uploadedFileUrl,
                'image_id'    => $public_id,
                'description' => $request->description,
                'tags'        => $request->tags,
            ]);

            DB::commit();
    
            return redirect()->route('article.show',$article->id)->with('success', 'News Update Successfully !');
            
        } catch (\Exception $err) {

            DB::rollBack();
            return back()->with('error', 'Something went wrong! Please try again.'.$err->getMessage());
        }
        
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
