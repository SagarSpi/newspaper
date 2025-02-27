<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Article;
use App\Models\Backend\User;
use Illuminate\Http\Request;

class DashboardContoller extends Controller
{
    function index(Request $request)
    {   

        $pendingUsers = User::where('status','active')->latest()->paginate(5);

        $usersChart = User::whereYear('created_at', now()->year)
            ->selectRaw('COUNT(*) as count, DATE_FORMAT(created_at, "%b") as month_name')
            ->groupByRaw('MONTH(created_at), DATE_FORMAT(created_at, "%b")')
            ->pluck('count', 'month_name')
            ->toArray();


        // ARTICLE CHART CODE START 
        $now = now();
        $last30Days = [$now->copy()->subDays(30), $now]; // শেষ ৩০ দিনের জন্য
        $previous30Days = [$now->copy()->subDays(60), $now->copy()->subDays(31)]; // তার আগের ৩০ দিনের জন্য

        // গত ৩০ দিনের ডাটা
        $lastPeriod = Article::whereBetween('created_at', $last30Days)
            ->selectRaw('COUNT(*) as count, category')
            ->groupBy('category')
            ->get()
            ->pluck('count', 'category');

        // তার আগের ৩০ দিনের ডাটা
        $previousPeriod = Article::whereBetween('created_at', $previous30Days)
            ->selectRaw('COUNT(*) as count, category')
            ->groupBy('category')
            ->get()
            ->pluck('count', 'category');

        // ফরম্যাটিং করে আউটপুট
        $articleChart = [
            'last_30_days' => $lastPeriod->toArray(),
            'previous_30_days' => $previousPeriod->toArray(),
        ];
        // ARTICLE CHART CODE END 


        return view('dashboard.dashboard', compact('pendingUsers','articleChart', 'usersChart'));

    }
}
