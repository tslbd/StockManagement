<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(3);
        $result = [];
        $stocks = Stock::where('user_id', Auth::user()->id)->get();
        foreach ($stocks as $stock) {
            $result[$stock->product_id] = $stock->user_id;
        }
        if (request('search')) {
            $searchResult = Product::where('title', 'LIKE', '%' . request('search') . '%')->get();
            return view('product.index', [
                'products' => $searchResult,
                'stocks' => $result,
            ]);
        }

        return view('product.index', [
            'products' => $products,
            'stocks' => $result,
        ]);
    }

    public function create(): View
    {
        return view('product.create');
    }

    public function store(StoreProductRequest $request)
    {
        $imagePath = $request->file('photo')->store('public');

        $data = array_merge(
            $request->all(),
            ['photo' => $imagePath],
        );
        Product::create($data);
        return redirect(route('products.index'));
    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $imagePath = $request->file('photo')->store('public');
        $data = array_merge(
            $request->all(),
            ['photo' => $imagePath],
        );

        $product->update($data);
        return to_route('products.index');
    }
}
