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
        $emailCheck = User::where('email', $request->input('email'))->exists();
        if ($emailCheck) {
            // Return a custom error message for existing email
            return redirect()->back()->with('error', 'The email address is already registered.');
        }
        try {
            // Validate the incoming request
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);
            // Check if the email already exists
            // Create a new User instance and assign the validated data
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            // Hash the password before storing it
            $user->password = bcrypt($request->input('password'));
            $user->role = "user";
            // Save the user to the database
            $user->save();

            // Optional: Automatically log the user in after registration
            // Auth::login($user);

            // Redirect to the login page with a success message
            return redirect()->route('login.form')->with('success', 'Registration successful.');
        } catch (\Exception $e) {
            // Handle the exception and display a user-friendly error message
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    // Show the login form
    public function showLoginRegForm()
    {
        return view('loginRegister');
    }

    // Handle login
    public function login(Request $request)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Attempt to log the user in
            if (Auth::attempt($request->only('email', 'password'))) {
                return redirect()->route('blogs')->with('success', 'Login successful.');
            }

            // If login fails, throw validation exception
            throw ValidationException::withMessages([
                'email' => ['The provided credentials do not match our records.'],
            ]);
        } catch (ValidationException $e) {
            // Handle validation errors and provide feedback to the user
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions and provide a generic error message
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    // Handle logout
    public function logout(Request $request)
    {
        try {
            Auth::logout();

            // Invalidate the session
            $request->session()->invalidate();

            // Redirect to the blogs page with a success message
            return redirect()->route('blogs')->with('success', 'Logged out successfully.');
        } catch (\Exception $e) {
            // Handle any error during logout
            return redirect()->route('blogs')->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
