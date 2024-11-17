@extends('layouts.app')

@section('content')
        
    
        <h1>Admins Information</h1>
        
    <!-- Success Message -->
    @if(session('success'))
        <p class="success-messag">{{ session('success') }}</p>
    @endif

    
    <table class="transaction-table">
        <tr>
            
            <th width="25%">User Id</th>
            <th width="45%">Username</th>
            
            <th width="30%">Created At</th>
        </tr>
        @foreach($users as $users)
            <tr>
                <td>{{ $users->id }}</td>
                <td>{{ $users->username }}</td>
                
                <td>{{ $users->created_at }}</td>
            </tr>
        @endforeach
    </table>
    <a href="/register"><button class= "invoice-btn">Add New Admin</button></a>
@endsection
