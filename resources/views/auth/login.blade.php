@extends('layouts.app')

@section('content')
    <div class="login-container">
        <h2><i class="bi bi-people-fill"></i>  Login</h2>
        
        <form action="{{ route('login') }}" method="POST" class="login-form">
            @csrf
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
                @error('username')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <div class="password-field">
                    <input type="password" name="password" id="password" required>
                    <span class="eye-icon" onclick="togglePassword()"><i class="bi bi-eye"></i></span>
                </div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Login</button>
            <p>Register new account <a href="/register">here</a></p>
        </form>

        @if(session('error'))
            <div class="error-message">{{ session('error') }}</div>
        @endif
    </div>


    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const icon = document.querySelector(".eye-icon i");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }

    </script>
@endsection
