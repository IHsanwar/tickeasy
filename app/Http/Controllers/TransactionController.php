<?php

// app/Http/Controllers/TransactionController.php
namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{   

    // Apply middleware in the constructor
    public function __construct()
    {
        $this->middleware('auth');  // This ensures only authenticated users can access the methods
    }

    public static function middleware(): array
    {
        return [
            new Middleware(middleware: 'auth:sanctum', except: ['index', 'show']),
        ];
    }
    
    public function index()
    {
        $transactions = Transaction::with('product')->get(); // Eager load product
        return view('transactions.index', compact('transactions'));
    }

    public function destroy($id)
{
    $transaction = Transaction::findOrFail($id);
    $transaction->delete();

    return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
}


    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('transactions.create', compact('products'));
    }

    // Store a new transaction
    public function store(Request $request)
{
    // Get product id and requested quantity from the form data
    $productId = $request->input('product_id');
    $quantity = $request->input('quantities')[$productId];
    $customer = $request->input('customer');

    // Retrieve the product to check stock
    $product = Product::findOrFail($productId);

    // Check if enough stock is available
    if ($quantity > $product->stock) {
        // Add an error message if there's not enough stock
        return redirect()->back()->withErrors(['quantity' => 'Not enough stock available.']);
    }

    // Proceed to create the transaction if stock is sufficient
    Transaction::create([
        'product_id' => $productId,
        'quantity' => $quantity,
        
        'customer' => $customer,
        'total_price' => $product->price * $quantity,
    ]);

    // Reduce stock for the product
    $product->stock -= $quantity;
    $product->save();

    return redirect()->route('transactions.index')->with('success', 'Transaction created successfully!');
}


    public function generateInvoice($id)
    {
        $transaction = Transaction::with('product')->findOrFail($id);

        $pdf = Pdf::loadView('invoices.invoice', compact('transaction'));

        return $pdf->download('invoice_' . $transaction->id . '.pdf');
    }


    
    
    public function generateTickets($id)
    {
        // Fetch the transaction and related product
        $transaction = Transaction::with('product')->findOrFail($id);

        // Initialize Guzzle client
        $client = new Client();

        // URL for generating the QR code
        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . urlencode($transaction->id);

        // Fetch the QR code image from the API
        $response = $client->get($qrCodeUrl);

        // Define the local path to save the QR code image
        $qrImagePath = public_path('qrcodes/' . $transaction->id . '.png');

        // Check if the directory exists, if not, create it
        if (!File::exists(public_path('qrcodes'))) {
            File::makeDirectory(public_path('qrcodes'), 0755, true);
        }

        // Save the QR code image to the local path
        File::put($qrImagePath, $response->getBody());

        // Convert image to base64 encoding
        $qrCodeBase64 = base64_encode(file_get_contents($qrImagePath));

        // Pass the QR code base64 string and transaction data to the Blade view
        $pdf = Pdf::loadView('tickets.ticket', compact('transaction', 'qrCodeBase64'));

        // Return the PDF as a download
        return $pdf->download('Ticket Number - ' . $transaction->id . '.pdf');
    }
}





