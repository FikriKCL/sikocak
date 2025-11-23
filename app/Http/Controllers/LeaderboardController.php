<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LeaderboardController extends Controller
{
  public function index()
    {
        $ranking = User::select('id', 'name', 'id_rank', 'xp')
            // ->whereNot('role', 'admin')
            ->orderBy('xp','desc')
            ->paginate(10);

        Log::info("Data Leaderboard :", $ranking->toArray());

        return view('leaderboard', compact('ranking'));
    }


    public function store(Request $request) {}
    public function show(Rank $rank) {}
    public function update(Request $request, Rank $rank) {}
    public function destroy(Rank $rank) {}
}
