@extends('layouts.app')

@section('content')
    <h1>Ticket List</h1>
    <a href="{{ route('products.create') }}" class="add-transaction-btn"><i class="bi bi-plus"></i> Add New Ticket</a>
    <table class= "transaction-table">
        <tr>
            <th>Name</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('products.edit', $product) }}" ><button class="invoice-btn"><i class="bi bi-pen"></i> Edit</button></a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn"><i class="bi bi-trash3"></i> Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <script>const navLinks = document.querySelectorAll('.nav-link');

// Get the current URL path
const currentPage = window.location.pathname;

// Loop through all links and set the active class
navLinks.forEach(link => {
    if (link.href.includes(currentPage)) {
        link.classList.add('active');
    }
});</script>
@endsection
