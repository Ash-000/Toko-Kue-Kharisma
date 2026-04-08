<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        $cartCount = 0;
        if (auth()->check()) {
            $cartCount = \App\Models\Cart::getTotalItems(auth()->id());
        }

        return view('menu', compact('products', 'cartCount'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product-detail', compact('product'));
    }
}
