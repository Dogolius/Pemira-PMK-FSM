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
        // Set the start date and time
        $startDateTime = Carbon::create(2023, 12, 4, 8, 0, 0, 'Asia/Jakarta');

        // Set the end date and time
        $endDateTime = Carbon::create(2023, 12, 7, 15, 0, 0, 'Asia/Jakarta');

        // Get the current date and time
        $currentDateTime = Carbon::now('Asia/Jakarta');

        if ($currentDateTime < $startDateTime) {
            // Display a message or redirect, indicating that the voting period is closed
            return redirect('/dashboard/vote')->with('voteError', 'Voting belum dibuka');
        }

        if ($currentDateTime > $endDateTime) {
            // Display a message or redirect, indicating that the voting period is closed
            return redirect('/dashboard/vote')->with('voteError', 'Voting telah ditutup');
        }


        // Check if the current time is within the specified time range (8:00 AM to 3:00 PM)
        if ($currentDateTime->format('H:i') >= '08:00' && $currentDateTime->format('H:i') <= '15:00') {
            // Allow the user to vote
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
        } else {
            // Display a message or redirect, indicating that it's outside the allowed voting time
            return redirect('/dashboard/vote')->with('voteError', 'Voting dibuka hanya dari jam 08:00 sampai 15:00');
        }

        

    }
}
