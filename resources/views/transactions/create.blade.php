@extends('layouts.app')

@section('content')
    <h1>Create New Transaction</h1>
    <form action="{{ route('transactions.store') }}" method="POST" id="transactionForm">
        @csrf
        <input 
        type="text" 
        id="searchBar" 
        placeholder='⌕ search ticket name...' 
        onkeyup="filterTickets()"
        style="margin-bottom: 20px; width: 100%; padding: 10px; font-size: 16px;"
    >
        
        @foreach($products as $product)
        <div>
   

        <div class="cont-crt" 
            data-name="{{ strtolower($product->name) }}">
            <input 
                type="radio" 
                name="product_id" 
                value="{{ $product->id }}" 
                id="product_{{ $product->id }}" 
                required
                onclick="updateQuantityField('{{ $product->id }}')"
            >
            <label for="product_{{ $product->id }}" class="nameprd">
                <h3>{{ $product->name }}</h3>
                <p>
                    @if($product->stock > 0)
                        Stocks left: {{ $product->stock }}
                    @else
                        Out of stock
                    @endif
                </p>
                <p>Price: Rp{{ number_format($product->price, 2) }}</p>
            </label>

            <div class="trx-create">
                <label for="quantity_{{ $product->id }}" class="quantity-label">Quantity:</label>
                <div class="quantity-container">
                    <button 
                        type="button" 
                        class="quantity-btn decrement" 
                        onclick="decreaseQuantity('{{ $product->id }}')">-
                    </button>
                    <input 
                        type="number" 
                        id="quantity_{{ $product->id }}" 
                        name="quantities[{{ $product->id }}]" 
                        min="1" 
                        value="1" 
                        class="quantity-input" 
                    >
                    <button 
                        type="button" 
                        class="quantity-btn increment" 
                        onclick="increaseQuantity('{{ $product->id }}')">+
                    </button>
                </div>
            </div>
        </div>

        @endforeach

        <!-- Hidden quantity field to submit only the selected product's quantity -->
        <input type="hidden" name="quantity" id="selectedQuantity" value="1">

        <!-- Trigger Modal -->
        <button type="button" id="openModalBtn" class="review-btn"><i class="bi bi-book"></i> Review Transaction</button>
    </form>

    <!-- Modal -->
    <div id="transactionModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Transaction Review</h2>
            <div id="transactionDetails">
                <p><i class="bi bi-ticket-perforated"></i> Ticket: <span id="productName"></span></p>
                <p><i class="bi bi-currency-dollar"></i> Price: Rp<span id="productPrice"></span></p>
                <p><i class="bi bi-box"></i> Quantity: <span id="productQuantity"></span></p>
                <p><i class="bi bi-cash-stack"></i> Total: Rp<span id="totalPrice"></span></p>

                <label for="customer"><i class="bi bi-person-fill"></i> Customer Name:</label>
                <input type="text" id="customer" name="customer" required>
            </div>
            <button type="submit" form="transactionForm" class="add-transaction-btn" style="margin-top:20px; border:none; cursor:pointer;"><i class="bi bi-arrow-right-square-fill" ></i> Confirm and Create Transaction</button>
        </div>
    </div>

    <script>
        let modal = document.getElementById("transactionModal");
    let btn = document.getElementById("openModalBtn");
    let span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        let selectedProduct = document.querySelector('input[name="product_id"]:checked');
        if (selectedProduct) {
            let productId = selectedProduct.value;
            let productName = document.querySelector('label[for="product_' + productId + '"] h3').innerText;
            let productPrice = parseFloat(document.querySelector('label[for="product_' + productId + '"] p:nth-of-type(2)').innerText.replace('Price: Rp', '').replace(',', ''));
            let quantity = parseInt(document.getElementById('quantity_' + productId).value);
            let total = productPrice * quantity;

            document.getElementById('productName').innerText = productName;
            document.getElementById('productPrice').innerText = productPrice.toFixed(2);
            document.getElementById('productQuantity').innerText = quantity;
            document.getElementById('totalPrice').innerText = total.toFixed(2);
        }
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // On form submission, set customer name in the form
    document.querySelector('button[type="submit"][form="transactionForm"]').addEventListener('click', function() {
        let customerName = document.getElementById('customer').value;
        if (customerName) {
            // Set the customer name in the hidden field
            let customerField = document.createElement('input');
            customerField.setAttribute('type', 'hidden');
            customerField.setAttribute('name', 'customer');
            customerField.setAttribute('value', customerName);
            document.getElementById('transactionForm').appendChild(customerField);
        } else {
            alert('Please enter the customer name.');
            return false; // Prevent form submission if no customer name is provided
        }
    });

        // Update hidden quantity field when a product is selected
        function updateQuantityField(productId) {
            let selectedQuantity = document.getElementById('quantity_' + productId).value;
            document.getElementById('selectedQuantity').value = selectedQuantity;
        }

        function increaseQuantity(productId) {
            let quantityInput = document.getElementById('quantity_' + productId);
            let currentQuantity = parseInt(quantityInput.value);
            quantityInput.value = currentQuantity + 1;
            updateQuantityField(productId); // Update hidden field when quantity changes
        }

        function decreaseQuantity(productId) {
            let quantityInput = document.getElementById('quantity_' + productId);
            let currentQuantity = parseInt(quantityInput.value);

            if (currentQuantity > 1) {
                quantityInput.value = currentQuantity - 1;
                updateQuantityField(productId); // Update hidden field when quantity changes
            }
        }
        function filterTickets() {
            let searchQuery = document.getElementById('searchBar').value.toLowerCase();
            let ticketContainers = document.querySelectorAll('.cont-crt[data-name]'); // Only elements with class `cont-crt` and `data-name`

            ticketContainers.forEach(ticket => {
                let ticketName = ticket.getAttribute('data-name');

                if (ticketName.includes(searchQuery)) {
                    ticket.style.display = "block"; // Show matching ticket
                } else {
                    ticket.style.display = "none"; // Hide non-matching ticket
                }
            });
        }

    </script>

    <style>
        /* Modal Styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        #customer{
            max-width:300px
        }
        #transactionDetails p {
            margin: 10px 0;
        }
    </style>
@endsection
