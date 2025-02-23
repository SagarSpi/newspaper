<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\newslattermail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Frontend\Newsletter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{

    public function sendEmail()
    {   
        $emails = Newsletter::pluck('email');
        $message = "Hello, Welcome to BestNews. Thank you for your suscription !";
        $subject = "Welcome to Best News";

        foreach ($emails as $recipent) {
            Mail::to($recipent)->send(new newslattermail($message,$subject));
        }

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emails = Newsletter::latest()
                            ->paginate();

        return view('backend.newsletter',compact('emails'));
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

        $inputs = $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create([
            'email'=>$request->email,
        ]);

        return back()->with('success','Subscription successful!');
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
        $email = Newsletter::findOrFail($id);

        return response()->json([
            'status'=>200,
            'email'=>$email,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $email = Newsletter::findOrFail($request->id);

        $inputs = $request->validate([
            'email' => 'required|email|unique:newsletters,email,'.$request->id,
            'status' => 'required|string|min:3'
        ]);

        try {
            DB::beginTransaction();

            $email->update([
                'email'=>$request->email,
                'status'=>$request->status
            ]);

            DB::commit();
            return redirect()->back()->with('success','Email Updated Successfully !');
        } catch (\Exception $err) {
            DB::rollBack();
            return redirect()->back()->with('error','Email Update Unsuccessful !');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
