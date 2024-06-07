<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\ProductUser;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $result = [];
        $stocks = ProductUser::where('user_id', Auth::user()->id)->get();
        foreach ($stocks as $stock) {
            $result[$stock->product_id] = $stock->user_id;
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

    public function edit(Product $product)
    {
        return view('product.edit', ['product' => $product]);
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return to_route('products.index');
    }
}
