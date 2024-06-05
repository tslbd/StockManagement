<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $result = Product::where('title', 'LIKE', '%'.request('search').'%')->get();
        return view('product.index', ['products' => $result]);
    }
}
