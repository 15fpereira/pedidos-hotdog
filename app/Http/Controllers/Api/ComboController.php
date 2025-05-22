<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComboRequest;
use App\Models\Product;

class ComboController extends Controller
{
    public function index()
    {
        return Product::where('type', 'pizza')->orWhere('type', 'hotdog')->get();
    }

    public function store(StoreComboRequest $request)
    {
        $product = Product::create($request->validated());
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(StoreComboRequest $request, Product $product)
    {
        $product->update($request->validated());
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Combo excluído.']);
    }
}
