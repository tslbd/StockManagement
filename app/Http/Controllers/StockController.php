<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        $SearchStockProducts = Auth::user()->products()->where('title', 'LIKE', '%' . $search . '%')->get();
        $stockProductStatus = [];
        $stocks = Stock::where('user_id', Auth::user()->id)->get();
        foreach ($stocks as $stock) {
            $stockProductStatus[$stock->product_id] = $stock->is_stock;
        };
        $productsStock = Auth::user()->products;
        if ($SearchStockProducts) {
            return view('stock.index',
                [
                    'products' => $SearchStockProducts,
                    'stocksProductStatus' => $stockProductStatus,
                    'stocks' => $stocks,
                ]);
        }

        return view('stock.index',
            [
                'products' => $productsStock,
                'stocksProductStatus' => $stockProductStatus,
                'stocks' => $stocks,
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
        Stock::create([
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
    public function update(Request $request, Stock $id)
    {

        $stock = DB::table('stocks')
            ->where('user_id', '=', Auth::user()->id)
            ->where('product_id', '=', $request->get('id'))
            ->update(['is_stock' => $request->isStock]);
        return to_route('stocks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
