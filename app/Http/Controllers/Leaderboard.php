<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;

class Leaderboard extends Controller
{
    public function index()
    {
        $leaderboard = User::select('id', 'name', 'id_rank')->with('rank:id,name,imageUri')->paginate(10)->get();
    
        
        return view()
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rank $rank)
    {
        //
    }

    /**||
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rank $rank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rank $rank)
    {
        //
    }
}
