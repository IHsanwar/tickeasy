<?php
// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',  // Ensure quantity is non-negative
            'price' => 'required|numeric|min:0',     // Ensure price is non-negative
        ]);

        // Create a new product using the validated data
        Product::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        // Redirect to the index with a success message
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

        // app/Http/Controllers/ProductController.php
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update($request->only(['name', 'stock', 'price']));

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }


   

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
