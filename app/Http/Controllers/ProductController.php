<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $result = Product::where('title', 'LIKE', '%'.request('search').'%')->get();
        $products = Product::with('user')->latest()->get();
        if ($result) {
            return view('product.index', ['products' => $products, 'stocks' => $result]);
        }
        return view('product.index', ['products' => $products]);
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


        $request->user()->products()->create($data);
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
        return redirect(route('products.index'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', ['product' => $product]);
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('products.index'));
    }
}
