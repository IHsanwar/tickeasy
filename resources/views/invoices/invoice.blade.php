<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            background:url('https://www.mydebtepiphany.com/wp-content/uploads/2016/12/payment-921087_1280.png');
            background-size: 400px; /* Resize the background image to cover the entire container */
            background-repeat: no-repeat;
            background-position: center;
            font-family: monospace;
        }
        .invoice-box { 
            max-width: 800px; 
            margin: auto; 
            padding: 30px; 
            border: 1px solid #eee; 
            position: relative; /* Allow for positioning the 'PAID' text inside the container */
            z-index: 2; /* Make sure the content is above the 'PAID' text */
        }
        .invoice-box h1 { 
            text-align: center;
            font-family: Arial;
        }
        .details { 
            margin-top: 20px; 
        }
        .total { 
            font-weight: bold; 
            text-align: right; 
            margin-top: 20px; 
        }

        /* 'PAID' Text inside the Container */
        .paid-text {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 10rem;
            color: rgba(0, 128, 0, 0.1); /* Green color with opacity for a subtle effect */
            font-weight: bold;
            z-index: 1; /* Make sure it's behind the content */
            white-space: nowrap;
            pointer-events: none; /* Prevent it from interfering with user interaction */
            user-select: none; /* Prevent text selection */
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <!-- 'PAID' Text Inside the Container -->
        <div class="paid-text">PAID</div>
        
        <h1>TickEasy Invoice</h1>
        <p>Transaction ID: {{ $transaction->id }}</p>
        <p>Date: {{ $transaction->created_at->format('d/m/Y') }}</p>
        
        <div class="details">
            <p><strong>Customer:</strong> {{ $transaction->customer }}</p>
            <p><strong>Ticket:</strong> {{ $transaction->product->name }}</p>
            <p><strong>Quantity:</strong> {{ $transaction->quantity }}</p>
            <p><strong>Unit Price:</strong> Rp{{ number_format($transaction->product->price, 2) }}</p>
            <p><strong>Total Price:</strong> Rp{{ number_format($transaction->total_price, 2) }}</p>
        </div>

        <div class="total">Total Payment: Rp{{ number_format($transaction->total_price, 2) }}</div>
    </div>
</body>
</html>
