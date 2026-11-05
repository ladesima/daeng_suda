<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Leader;

class ProfileController extends Controller
{
    public function show()
    {
        $leaders = Leader::orderBy('id')->get();
        $leader = $leaders->first();

        return view('front.profile', compact('leader', 'leaders'));
    }
}
