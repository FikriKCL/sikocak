<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        // Data dummy untuk contoh
        $userData = [
            'name' => 'Cania Citta',
            'badge' => 'Perunggu',
            'trophies' => 0,
            'sikocak_percentage' => 0,
            'current_level' => 1,
            'unlocked_levels' => [1, 2, 3, 4],
        ];

        $materials = [
            ['id' => 1, 'name' => 'Materi-1'],
            ['id' => 2, 'name' => 'Materi-1'],
            ['id' => 3, 'name' => 'Materi-1'],
            ['id' => 4, 'name' => 'Materi-1'],
        ];

        return view('game', compact('userData', 'materials'));
    }

    public function startLevel($level)
    {
        // Logic untuk memulai level
        return response()->json(['success' => true, 'message' => 'Level dimulai!']);
    }

    public function completeMaterial($material)
    {
        // Logic untuk menyelesaikan materi
        return response()->json(['success' => true, 'message' => 'Materi selesai!']);
    }
}