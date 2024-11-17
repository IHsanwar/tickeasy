<?php
// app/Http/Controllers/UserLoginController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLogin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }
    
    public function index()
    {
        $users = UserLogin::all();
        return view('user.index', compact('users'));
    }

   // app/Http/Controllers/UserLoginController.php
   public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

    $user = UserLogin::where('username', $request->username)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        Auth::login($user);  // Logs the user in
        return redirect()->route('abouts');  // Redirects to the dashboard
    }

    return back()->withErrors(['username' => 'Invalid credentials']);
}


    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect()->route('login');
    }
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate input data
        $request->validate([
            'username' => 'required|string|unique:user_logins,username|max:255',
            'password' => 'required|string|min:6|confirmed'
        ]);

        // Create a new user with hashed password
        $user = UserLogin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        // Automatically log in the new user
        Auth::login($user);

        // Redirect to dashboard or intended page
        return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome.');
    }
    public function accountDetails()
{
    // Fetch the logged-in user details from the session
    $user = UserLogin::find(session('user_id'));

    // Check if the user is logged in
    if (!$user) {
        return redirect()->route('login')->with('error', 'Please log in first.');
    }

    return view('account.details', compact('user'));
}
}
