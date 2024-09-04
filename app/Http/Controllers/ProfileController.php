<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function displayProfile()
    {
        return view('profile');
    }

    public function updatedProfile(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:Male,Female',
        ]);
        Auth::user()->update($validatedData);
        return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès');
    }
}
