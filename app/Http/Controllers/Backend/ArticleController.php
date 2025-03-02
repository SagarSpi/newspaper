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
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function searchData(Request $request)
    {
        $query = Article::query()->latest();

        // Keyword diye search korbo (ID, shortDesc, user->name)
        if (!empty($request->keyword)) {
            $query->where(function ($q) use ($request) {
                $q->where('id', $request->keyword)
                    ->orWhere('shortDesc', 'like', "%{$request->keyword}%")
                    ->orWhere('tags', 'like', "%{$request->keyword}%")
                    ->orWhereHas('user', function ($q) use ($request) {
                        $q->where('name', 'like', "%{$request->keyword}%");
                    });
            });
        }

        // Jodi title thake, tahole search query add korbo
        if (!empty($request->title)) {
            $query->where('title', 'like', "%{$request->title}%");
        }

        // Jodi category thake, tahole search query add korbo
        if (!empty($request->category)) {
            $query->where('category', 'like', "%{$request->category}%");
        }

        // Jodi status thake, tahole search query add korbo
        if (!empty($request->status)) {
            $query->where('status', 'like', "%{$request->status}%");
        }

        if (!empty($request->date_filter)) {
            $date = $request->date_filter;
            switch ($date) {
                case 'today':
                    $query->whereDate('created_at',Carbon::today());
                    break;
                case 'yesterday':
                    $query->whereDate('created_at',Carbon::yesterday());
                    break;
                case 'this_week':
                    $query->whereBetween('created_at',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()]);
                    break;
                case 'last_week':
                    $query->whereBetween('created_at',[Carbon::now()->subWeek(),Carbon::now()]);
                    break;
                case 'this_month':
                    $query->whereMonth('created_at',Carbon::now()->month);
                    break;
                case 'last_month':
                    $query->whereMonth('created_at',Carbon::now()->subMonth()->month);
                    break;
                case 'this_year':
                    $query->whereYear('created_at',Carbon::now()->year);
                    break;
                case 'last_year':
                    $query->whereYear('created_at',Carbon::now()->subYear()->year());
                    break;
            }
        }

        // 9 ta kore paginate korbo
        $articles = $query->paginate(9);

        // Jodi kono result na thake, tahole back pathay dibo
        if ($articles->isEmpty()) {
            
            // toastr()->closeButton(true)->info('No Article Found !');
            return redirect()->back()->with('info','No Article Found !');
        }

        return view('article.article', compact('articles'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('user')
                        ->withCount('comments')
                        ->orderByDesc('created_at')
                        ->paginate(9);

        return view('article.article',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('article.articleCreate');
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
                'status'=> 'pending',
            ]);

            DB::commit();
            return redirect()->back()->with('success','News Create Successfully !');

        } catch (\Exception $err) {

            DB::rollBack();
            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id);

        // Gate::authorize('view',$article);

        return view('article.articleDetail',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);

        Gate::authorize('update',$article);

        return view('article.articleEdit',compact('article'));
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
            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function articleRequest()
    {   
        $articles = Article::where('status','pending')
                            ->latest()
                            ->paginate(9);

        return view('article.articleRequest',compact('articles'));
    }

    public function articleReqApproved(string $id)
    {
        $article = Article::findOrFail($id);

        try {
            DB::beginTransaction();

            $article->update([
                'status'=>'active'
            ]);

            DB::commit();

            // return response()->json(["success"=>"Article Approved Successfully !"]);

        } catch (\Exception $err) {
            DB::rollBack();
            return redirect()->back()->with('error','Article Not Approved ! Please Try Again.');
        }
    }
    public function approvedAll(Request $request)
    {
        try {
            DB::beginTransaction();
            $ids = $request->ids;

            Article::whereIn('id',$ids)->update([
                'status'=>'active'
            ]);

            DB::commit();
        } catch (\Exception $err) {
            DB::rollBack();

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        try {
            DB::beginTransaction();

            $article->delete();
            DB::commit();

            // return response()->json(["success"=>"Article Deleted Successfully !"]);

        } catch (\Exception $th) {
            DB::rollBack();

            return redirect()->back()->with('error','Article Not Deleted ! Please Try Again.');
        }
    }

    public function destroyAll(Request $request)
    {
        try {

            DB::beginTransaction();

            $ids = $request->ids;
            Article::whereIn('id',$ids)->delete();

            DB::commit();
            return response()->json(["success"=>"Article Deleted Successfully !"]);

        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('error','Article Not Deleted ! Please Try Again.');
        }
    }
}
