<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $result = Product::where('title', 'LIKE', '%'.request('search').'%')->get();

        $stocks = Stock::where('user_id', Auth::user()->id)->get();
        $arr = [];
        foreach ($stocks as $stock) {
            $arr[$stock->product_id] = $stock->user_id;
        }
        return view('product.index', ['products' => $result,  'stocks' => $arr]);
    }
}
