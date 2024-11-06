<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    // Handle registration
    public function register(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new User instance and assign the validated data
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // Hash the password before storing it
        $user->password = bcrypt($request->input('password'));
        // Save the user to the database
        $user->save();
        // dd($user->save());

        // Optional: Automatically log the user in after registration
        // Auth::login($user);

        // Redirect to the dashboard with a success message
        return redirect()->route('loginRegister')->with('success', 'Registration successful.');
    }


    // Show the login form
    public function showLoginRegForm()
    {
        return view('loginRegister');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('blogs')->with('success', 'Login successful.');
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/blog')->with('success', 'Logged out successfully.');
    }
}
