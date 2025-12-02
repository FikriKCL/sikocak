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
            ->get();

        $id_rank = User::select('id_rank');

        foreach ($ranking as $user) {
            $xp = $user->xp;

            if ($xp >= 2000) {
                $user->id_rank = 5;
            } elseif ($xp >= 1000) {
                $user->id_rank = 4;
            } elseif ($xp >= 500) {
                $user->id_rank = 3;
            } elseif ($xp >= 300) {
                $user->id_rank = 2;
            } else {
                $user->id_rank = 1;
            }
        }
        

        return view('leaderboard', compact('ranking'));
    }


    public function store(Request $request) {}
    public function show(Rank $rank) {}
    public function update(Request $request, Rank $rank) {}
    public function destroy(Rank $rank) {}
}
