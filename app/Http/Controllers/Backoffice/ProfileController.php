<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('backoffice.profile.index', compact('user'));
    }
}