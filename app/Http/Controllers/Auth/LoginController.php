<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Redirect authenticated users to the dashboard or intended route
    protected $redirectTo = '/dashboard'; // Change this to your desired route

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Add other methods like login(), logout(), etc.
}
