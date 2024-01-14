<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function tryLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = DB::table('users')->where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {

            // Login successful, authenticate the user
            Auth::loginUsingId($user->id);

            // Login successful, redirect to home page
            return redirect()->route('adminGames');
        } 
        else
        {
            // Login failed, redirect back to the login page with an error message
            return redirect()->route('login')->with('error', 'Invalid credentials.');
        }
    }

    /* ADMIN CREDENTIALS */

    public function indexEditor()
    {
        return view('admin.credentials');
    }

    public function editPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('adminCredentials')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('username', 'admin')->first();
        
        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('new_password');

        if (Hash::check($currentPassword, $user->password)) {
            $user->update(['password' => Hash::make($newPassword)]);
            return redirect()->route('adminCredentials')->with('success', 'Password updated successfully.');
        } else {
            return redirect()->route('adminCredentials')->with('error', 'Current password is incorrect.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Déconnexion de l'utilisateur
        $request->session()->invalidate(); // Invalidates the user's session
        $request->session()->regenerateToken(); // Génère un nouveau jeton CSRF pour la protection des formulaires
        return redirect()->route('login'); // Redirection vers la page d'accueil (ou une autre page si nécessaire)
    }
}

