@extends('layouts.app')

@section('content')
        
    
        <h1>Transaction List</h1>
        
    <!-- Success Message -->
    @if(session('success'))
        <p class="success-messag">{{ session('success') }}</p>
    @endif
    
    <a href="{{ route('transactions.create') }}" class="add-transaction-btn"><i class="bi bi-plus"></i> Add New Transaction</a>
    <input 
        type="text" 
        id="searchBar" 
        placeholder='⌕ search for transactions...' 
        onkeyup="filterTransactions()"
        style="margin-bottom: 20px; width: 100%; padding: 10px; font-size: 16px;"
    >
    <table class="transaction-table" data-name="{{ strtolower($transactions) }}">
        <tr>
            <th width="20%"><i class="bi bi-person-fill"></i> Customer Name</th>
            <th width="20%">Ticket</th>
            <th width="5%">Quantity</th>
            <th width="10%">Total Price</th>
            <th width="10%">Date</th>
            <th width="40%">Action</th>
        </tr>
        @foreach($transactions as $transaction)
    <tr data-name="{{ strtolower($transaction->customer) }}">
        <td>{{ $transaction->customer }}</td>
        <td>
            @if($transaction->product)
                {{ $transaction->product->name }}
            @else
                Produk telah dihapus
            @endif
        </td>
        <td>{{ $transaction->quantity }}</td>
        <td>Rp{{ $transaction->total_price }}</td>
        <td>{{ $transaction->created_at->format('Y-m-d / H:i:s') }}</td>
        <td class="fl">
            <a href="{{ route('transactions.ticket', $transaction->id) }}"><button class="ticket-btn"><i class="bi bi-ticket-detailed"></i> Ticket</button></a>
            <a href="{{ route('transactions.invoice', $transaction->id) }}"><button class="invoice-btn"><i class="bi bi-receipt"></i> Invoice</button></a>
            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn"><i class="bi bi-trash3"></i> Delete</button>
            </form>
        </td>
    </tr>
    @endforeach

    </table>
    <script>function filterTransactions() {
    let searchQuery = document.getElementById('searchBar').value.toLowerCase();
    let transactionRows = document.querySelectorAll('table.transaction-table tr[data-name]'); // Select rows with `data-name`

    transactionRows.forEach(row => {
        let customerName = row.getAttribute('data-name'); // Get the customer's name from `data-name`

        if (customerName.includes(searchQuery)) {
            row.style.display = ""; // Show matching row
        } else {
            row.style.display = "none"; // Hide non-matching row
        }
    });
}

        </script>
@endsection
