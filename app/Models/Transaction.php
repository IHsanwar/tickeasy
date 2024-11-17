<?php

// app/Models/Transaction.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity','customer','total_price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
