@extends('layouts.app')

@section('content')
<div class="cont-crt">
    <h1>{{ isset($product) ? 'Edit Product' : 'Add Product' }}</h1>
    <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" method="POST">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required>
        </div>
        <div>
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $product->price ?? 0) }}" required>
        </div>
        <button type="submit" class="add-prdc-btn">{{ isset($product) ? 'Update' : 'Add' }} Product</button>
    </form>
</div>
@endsection
