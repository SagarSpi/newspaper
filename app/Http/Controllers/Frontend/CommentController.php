<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Article;
use App\Models\Frontend\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{   

    public function searchData(Request $request)
    {
        $query = Comment::query()->latest();

        if (!empty($request->id)) {
            $query->where('id',$request->id);
        }

        // Jodi title thake, tahole search query add korbo
        if (!empty($request->title)) {
            $query->where('title','like',"%{$request->title}%");
        }

        // Jodi subject thake, tahole search query add korbo
        if (!empty($request->subject)) {
            $query->where('subject','like',"%{$request->subject}%");
        }

        if (!empty($request->article_id)) {
            $query->where('commentable_type', Article::class)
                  ->where('commentable_id', $request->article_id);
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

        $comments = $query->paginate(9);

        // Jodi kono result na thake, tahole back pathay dibo
        if ($comments->isEmpty()) {
            return redirect()->back()->with('info', 'No Comments Cound.');
        }

        return view('comments.comments',compact('comments'));
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('commentable')
                        ->latest()
                        ->paginate(9);

        return view('comments.comments',compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $id)
    {
        $news = Article::findOrFail($id);

        $inputs = Validator::make($request->all(),[
            'title'=>'required|string|max:255',
            'subject'=>'nullable|string|max:255',
            'description'=>'required|string'
        ])->stopOnFirstFailure();

        if ($inputs->fails()) {
            return back()->withErrors($inputs)->withInput();
        }

        try {
            DB::beginTransaction();

            $news->comments()->create([
                'title'=>$request->title,
                'subject'=>$request->subject,
                'description'=>$request->description,
            ]);

            DB::commit();
            return redirect()->back()->with('success','Comment Submitted Succesfully !');

        } catch (\Exception $err) {
            DB::rollBack();
            return back()->with('error','Something Went Wrong! Please Try Again !')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = Comment::findOrFail($id);

        return response()->json([
            'status'=>200,
            'comment'=>$comment,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comment = Comment::findOrFail($id);

        return view('comments.commentEdit',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $comment = Comment::findOrFail($id);

        $inputs = Validator::make($request->all(),[
            'title'=>'required|string|max:255',
            'subject'=>'nullable|string|max:255',
            'description'=>'required|string'
        ])->stopOnFirstFailure();

        if ($inputs->fails()) {
            return back()->withErrors($inputs)->withInput();
        }

        try {
            DB::beginTransaction();

            $comment->update([
                'title'=>$request->title,
                'subject'=>$request->subject,
                'description'=>$request->description,
            ]);

            DB::commit();
            return redirect()->route('comment.list')->with('success','Comment Updated Successfully !');

        } catch (\Exception $err) {

            DB::rollBack();
            return redirect()->back()->with('error','Something went wrong! Please try again !');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {   
        $comment = Comment::findOrFail($id);

        try {
            DB::beginTransaction();

            $comment->delete();

            DB::commit();
        } catch (\Exception $err) {
            DB::rollBack();

            return redirect()->back()->with('error','Comment Not Deleted !');
        }
    }

    public function destroyAll(Request $request)
    {
        try {
            DB::beginTransaction();

            $ids = $request->ids;
            Comment::whereIn('id',$ids)->delete();

            DB::commit();
            // return redirect()->back()->with('success','Comment Delected Successfully !');

            return response()->json(["success"=>"Comment have been deleted ! "]);
            
        } catch (\Exception $th) {
            DB::rollBack();

            return redirect()->back()->with('error','Comment Not Deleted !');
        }
    }
}
