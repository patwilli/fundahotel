<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class connectionManagementController extends Controller
{

    public function registerForm()
    {
        $page = 'register';
        return view('register', compact('page'));
    }

    public function loginForm()
    {
        $page = 'login';
        return view('login', compact('page'));
    }

    public function registerUser(Request $request)
    {
        // Vérification du mot de passe confirmé
        if ($request->password != $request->cpassword) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Passords do not match']);
        }
        // Vérification du sexe
        if (!isset($request->gender)) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Specify your gender']);
        }
        // Vérification de l unicite de l email
        $verif = User::where('email', $request->email)->get();
        $verif = count($verif);
        if ($verif > 0) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Email already registered.']);
        }

        // Valider les données du formulaire
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'gender' => 'required|in:Male,Female',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        // Créer un nouvel utilisateur
        $user = User::create([
            'id' => Str::uuid(),
            'fname' => $validatedData['fname'],
            'lname' => $validatedData['lname'],
            'phone' => $validatedData['phone'],
            'gender' => $validatedData['gender'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'status' => 0,
        ]);

        // Redirection vers une page de succès 
        return redirect()->route('login')->with('success', 'You have registered Successfully');
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // L'authentification a réussi
            return redirect()->intended('/Home')->with('success', 'Logged In Successfully');
        }

        // L'authentification a échoué
        return back()->withErrors(['failed' => 'Connection fails']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/Login');
    }
}
