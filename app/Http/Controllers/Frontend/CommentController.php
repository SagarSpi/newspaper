<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
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

            Comment::create([
                'title'=>$request->title,
                'subject'=>$request->subject,
                'description'=>$request->description,
            ]);
            DB::commit();
            return redirect()->back()->with('success','Comment submitted succesfully !');

        } catch (\Exception $err) {
            DB::rollBack();
            return back()->with('error','Something went wrong! Please try again !')->withInput();
        }
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
    public function edit(string $id)
    {
        //
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
