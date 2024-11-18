@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- About the App Section -->
        <h1 class="abouth1 text-center my-5">About This App</h1>

        <div class="row">
    <!-- Left Column: About App Content -->
    <div class="col-md-6">
        <h3>App Guide</h3>
        <p class="aboutp">
            This cashier application provides an easy way to manage transactions in a retail environment. 
            It allows the admin to view product information, manage stock, and process transactions efficiently.
        </p>
        <ul>
            <li>Manage product inventory</li>
            <li>Track sales transactions</li>
            <li>View transaction history</li>
            <li>Admin login for secure access</li>
        </ul>
    </div>

    <!-- Right Column: Profile Section -->
    <div class="col-md-6 position-relative"> <!-- Added 'position-relative' -->
        <h3 class="text-center" id="prf">My Profile</h3>
        <div class="profile-container text-center">
            <p class="aboutp mt-3">
                Feel free to connect with me via the following platforms:
            </p>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="https://github.com/IHsanwar" target="_blank" class="btn btn-dark btn-sm">
                        <i class="bi bi-github"></i> GitHub
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="https://gitlab.com/Ihsanwar810" target="_blank" class="btn btn-dark btn-sm">
                        <i class="bi bi-gitlab"></i> GitLab
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="https://wa.me/+6281293080153" class="btn btn-dark btn-sm">
                        <i class="bi bi-telephone"></i> Phone: +62 812-9308-0153
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="mailto:ihsanwar77@gmail.com" class="btn btn-dark btn-sm">
                        <i class="bi bi-envelope"></i> Email: ihsanwar77@gmail.com</a>
                </li>
            </ul>
        </div>
        <!-- Version Info -->
        <p class="infover position-absolute bottom-0 start-0 w-100 text-center">
            Version: 1.20.34 check 
            <a href="https://github.com/IHsanwar/tickeasy/" target="_blank">
                github<i class="bi bi-arrow-up-right-square"></i>
            </a> for more details<br>
            
        </p>
        
        <p class="copyright">copyright&#xA9Ihsan Wardhana 2024</p>
            
        
    </div>
</div>

        </div>

        <!-- Success Message (if any) -->
        @if(session('success'))
            <p class="alert alert-success mt-4">{{ session('success') }}</p>
        @endif
    </div>
@endsection
