<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Mail\newslattermail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Frontend\Newsletter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{

    

    public function searchData(Request $request)
    {
        $query = Newsletter::query()->latest();

        if (!empty($request->id)) {
            $query->where('id',$request->id);
        }

        // Jodi title thake, tahole search query add korbo
        if (!empty($request->email)) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        // Jodi status thake, tahole search query add korbo
        if (!empty($request->status)) {
            $query->where('status', $request->status);
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
        $emails = $query->paginate(9);

        // Jodi kono result na thake, tahole back pathay dibo
        if ($emails->isEmpty()) {
            
            return redirect()->back()->with('info','No Emails Found !');
        }

        return view('newsletter.newsletter', compact('emails'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emails = Newsletter::latest()
                            ->paginate();

        return view('newsletter.newsletter',compact('emails'));
    }

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   

        $inputs = $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        try {
            DB::beginTransaction();

            Newsletter::create([
                'email'=>$request->email,
            ]);
            DB::commit();
            return redirect()->back()->with('success','Subscription successful!');

        } catch (\Exception $err) {
            DB::rollBack();

            return redirect()->back()->with('error','Failed to Subscription ! Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $email = Newsletter::findOrFail($id);

        Gate::authorize('update',$email);

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

        Gate::authorize('update',$email);

        $inputs = $request->validate([
            'email' => 'required|email|unique:newsletters,email,'.$request->id,
            'status' => 'nullable|string|min:3'
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
    public function destroy(int $id)
    {
        $email = Newsletter::findOrFail($id);

        Gate::authorize('delete',$email);

        try {
            DB::beginTransaction();

            $email->delete();
            
            DB::commit();
        } catch (\Exception $err) {
            DB::rollBack();
            return redirect()->back()->with('error','Email remove Successfully !');
        }
    }
}
