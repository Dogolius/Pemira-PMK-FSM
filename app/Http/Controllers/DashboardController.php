<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
        return view('dashboard.index', [
            'title' => "Dashboard",
            'name' => auth()->user()->name
        ]);
    }

    public function register()
    {
        return view('dashboard.signup', [
            'title' => "Buat Akun",
        ]);
    }

    public function vote()
    {
        $belumMulai = true;
        // Set the start date and time
        $startDate = Carbon::create(2023, 12, 4, 8, 0, 0, 'Asia/Jakarta');

        // Get the current date and time
        $currentDateTime = Carbon::now('Asia/Jakarta');

        if($currentDateTime >= $startDate){
            $belumMulai = false;
        }
        return view('dashboard.vote', [
            'title' => "Voting Calon Ketua PMK FSM Undip",
            'belum_mulai' => $belumMulai
        ]);
    }

    public function result()
    {
        return view('dashboard.result', [
            'title' => "Hasil dan Statistik Perolehan Suara",
            'voter_count' => User::where('has_voted', true)->count(),
            'yet_to_vote_count' => User::where('has_voted', false)->count() - 1,
            'christina_voter' => Vote::where('voter_choose', "Christina")->count(),
            'kotak_voter' => Vote::where('voter_choose', "Kotak")->count(),
            'votes' => Vote::all()
        ]);
    }
}
