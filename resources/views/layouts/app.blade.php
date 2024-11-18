<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TickEasy - Easier Way to Your Ticketing Experience</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
     
    <style>
        /* Basic styling for dashboard layout */
        
    </style>
</head>
<body>
    <!-- Navigation bar -->
    <nav>
        <h2><i class="bi bi-cash-coin" class="nav-link"></i></i><div class="d">TickEasy</div></h2>

        <a href="{{ route('products.index') }}" style="display:flex;gap:7px;"><i class="bi bi-ticket-perforated"></i>Tickets</a>
        <a href="{{ route('transactions.index') }}"  style="display:flex;gap:7px;"><i class="bi bi-receipt"></i>Transactions</a>
        <a href="/users" class="about"  style="display:flex;gap:7px;" ><i class="bi bi-people-fill"></i> Admins Information</a>
        <a href="/abouts" class="about"  style="display:flex;gap:7px;" ><i class="bi bi-info-circle-fill"></i>About the App</a>
        
        
        <form action="{{ route('logout') }}" method="POST" style="margin-top: auto;">
            @csrf
            <button type="submit" class="logout"><i class="bi bi-box-arrow-left"></i> Logout</button>
        </form>
    </nav>

    <!-- Main content area -->
    <div class="content">

        @yield('content')
    </div>
    @yield('footer')

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>document.addEventListener('contextmenu', (e) => e.preventDefault());

function ctrlShiftKey(e, keyCode) {
return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
}

document.onkeydown = (e) => {
// Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
if (
e.keyCode === 123 || // F12
ctrlShiftKey(e, 'I') || // Ctrl + Shift + I
ctrlShiftKey(e, 'J') || // Ctrl + Shift + J
ctrlShiftKey(e, 'C') || // Ctrl + Shift + C
(e.ctrlKey && e.keyCode === 'U'.charCodeAt(0)) // Ctrl + U
) {
return false;
}
};</script>
</body>
</html>
