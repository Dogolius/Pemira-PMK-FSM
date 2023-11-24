<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    //
    public function store(Request $request)
    {
        $currentDateTime = Carbon::now('Asia/Jakarta');
        // Set the start time
        $startDateTime = Carbon::create(2023, 11, 25, 2, 27, 0, 'Asia/Jakarta');
        // Set the end time
        $endDateTime = Carbon::create(2023, 11, 25, 2, 29, 0, 'Asia/Jakarta');

        if ($currentDateTime < $startDateTime) {
            // Display a message or redirect, indicating that the voting period is closed
            return redirect('/dashboard/vote')->with('voteError', 'Voting belum dibuka');
        }

        if ($currentDateTime > $endDateTime) {
            // Display a message or redirect, indicating that the voting period is closed
            return redirect('/dashboard/vote')->with('voteError', 'Voting telah ditutup');
        }
        $validatedData = $request->validate([
            'voter_choose' => 'required'
        ]);
        $newVoteData = [
            'voter_id' => auth()->user()->id,
            'voter_name' => auth()->user()->name,
            'voter_nim' => auth()->user()->nim,
            'voter_choose' => $validatedData['voter_choose'],
        ];

        Vote::create($newVoteData);
        $updatedData = [
            'has_voted' => true
        ];

        User::where('id', auth()->user()->id)->update($updatedData);
        return redirect('/dashboard/vote')->with('success', 'Voting berhasil dilakukan');
        return redirect('/dashboard/vote')->with('success', 'Harap voting dalam periode waktu yang telah ditentukan');
    }
}
