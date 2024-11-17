<!-- resources/views/auth/register.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="login-container">
        
        <h2>Register</h2>
        <form action="{{ route('register') }}" method="POST" class= "login-form">
            @csrf
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
                @error('username')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <div >{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <button type="submit" style="margin-top:10px">Register</button>
        </form>
    </div>
@endsection
