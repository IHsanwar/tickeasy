<!DOCTYPE html>
<html>
<head>
    <title>Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .ticket-box {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #f92e65;
            color: #fff;
            padding: 15px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .qr-code {
            text-align: center;
            margin: 20px 0;
        }
        .details {
            margin-top: 20px;
            line-height: 1.6;
        }
        .details strong {
            display: block;
        }
        .footer {
            font-size: 12px;
            color: #666;
            text-align: center;
            padding: 10px;
            background-color: #f9f9f9;
            border-top: 1px solid #ddd;
        }
        .footer a {
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="ticket-box">
        <div class="header">
            <h2>TickEasy</h2>
        </div>
        <div class="content">
            
            <div class="qr-code">
                        @php
                        $qrCodeUrl = urlencode($transaction->id);
                    @endphp
            <img width="180px" src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code">
            
        <h2 style="text-align:center">{{ $transaction->customer }}</h2>

            </div>
            <div class="details">
                <p><strong>Ticket No:</strong> TEX-{{ $transaction->id }}</p>
                <p><strong>Ticket Type:</strong> {{ $transaction->product->name }}</p>
                <p><strong>Date:</strong> {{ $transaction->created_at->format('d M Y') }}</p>
                <p><strong>Time:</strong> 07:00 - 17:00</p>
                <p><strong>Price:</strong> Rp{{ number_format($transaction->product->price, 2) }}</p>
            </div>
        </div>
        <div class="footer">
            <p>Valid for entry on the date above only.</p>
            <p>Contact: +62 812-9308-0153 | Email: <a href="mailto:ihsanwar77@gmail.com">ihsanwardhanar.com</a></p>
        </div>
    </div>
</body>
</html>
