<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index(): Response
    {
        // an array to hold user stats
        $alumni_stats = [];

        // get stats
        $users_stats = User::alumni()
            ->whereYear('created_at', now()->format('Y'))
            ->select(DB::raw('MONTH(created_at) month'), DB::raw("count('month') as item_count"))
            ->groupby('month')
            ->get();
        // fill array with values
        foreach ($users_stats as $users_stat) {
            $alumni_stats[$users_stat->month] = $users_stat->item_count;
        }
        // fill zero if no stats
        foreach (range(1, 12) as $month) {
            if (! isset($alumni_stats[$month])) {
                $alumni_stats[$month] = 0;
            }
        }
        // sort array and implode
        ksort($alumni_stats);
        $alumni_stats = implode(',', $alumni_stats);

        return response()->view('admin.home', [
            'alumni_stats' => $alumni_stats,
        ]);
    }
}
