<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\productUser;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
       $SearchStockProducts = Auth::user()->products()->where('title', 'LIKE', '%'.$search.'%')->get();
        $stockProductStatus = ProductUser::all()->pluck('is_stock', 'product_id');
        if ($SearchStockProducts) {
            return view('stock.index',
                [
                    'products' => $SearchStockProducts,
                    'stocks' => $stockProductStatus,
                ]);
        }
        $productsStock = Auth::user()->products;
        return view('stock.index',
            [
                'products' => $productsStock,
                'stocks' => [],
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ProductUser::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->get('id'),
        ]);
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
