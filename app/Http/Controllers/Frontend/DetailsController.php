<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Backend\User;
use Illuminate\Http\Request;
use App\Models\Backend\Article;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DetailsController extends Controller
{
    public function detailsPage(int $id)
    {
        $news_details = Article::findOrFail($id);

        $news_details->increment('visits');

        $related_news = Article::where([
                                ['status','active'],
                                ['category',$news_details->category],
                            ])
                            ->whereNot('id', $id)
                            ->take(4)
                            ->get();

        $latest_news = Article::where('status','active')
                                ->whereNot('id',$id)
                                ->latest()
                                ->take(9)
                                ->get();

        $trading_news = Article::where('status','active')
                                    ->whereNot('id',$id)
                                    ->orderByDesc('visits')
                                    ->take(7)
                                    ->get();

        $shareLinks = \Share::page(
            route('news.details',$id)
        )
        ->facebook()
        ->linkedin()
        ->twitter()
        ->whatsapp();

        return view('frontend.details.details',[
            'news_details'=>$news_details,
            'related_news'=>$related_news,
            'latest_news'=>$latest_news,
            'trading_news'=>$trading_news,
            'shareLinks'=>$shareLinks
        ]);
    }

    public function ratingUser(Request $request,int $id)
    {
        $user = User::findOrFail($id);

        try {
            DB::beginTransaction();

            $input = $request->validate([
                'rate'=>'required|integer|min:1|max:5'
            ]);
    
            // Rating এর গড় হিসাব রাখার জন্য rating_count ব্যবহার করা হচ্ছে
            $newRatingCount = $user->rating_count + 1;
            $newRating = (($user->rating * $user->rating_count) + $input['rate']) / $newRatingCount;

            // নতুন রেটিং আপডেট করা হচ্ছে
            $user->update([
                'rating' => $newRating,
                'rating_count' => $newRatingCount
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Rating submitted successfully!');

        } catch (\Exception $err) {

            DB::rollBack();
            return redirect()->back()->with('error', 'Rating submission failed! Please try again.');
        }
    }
}