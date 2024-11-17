<!-- resources/views/products/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>
    
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" min="0" value="{{ old('stock', $product->stock) }}" required>
            @error('stock')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="price">Price</label>
            <input type="text" id="price" name="price" value="{{ old('price', $product->price) }}" required>
            @error('price')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Update Product</button>
    </form>
@endsection
