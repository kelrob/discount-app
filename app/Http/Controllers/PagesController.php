<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class PagesController extends Controller
{
    public function index() {

        // Fetch Products in Random order
        $total = 0;
        $count = 0;
        $products = Product::inRandomOrder()->limit(3)->get();

        // Calculate Total Cost
        foreach($products as $product) {
            $total += $product->price;
            $count += 1;
        }

        // Add result above to view
        return view('index', compact('products', 'total', 'count'));
    }
}
