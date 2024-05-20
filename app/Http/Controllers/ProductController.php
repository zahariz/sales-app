<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->all('search');
        $data = product::orderBy('sku', 'desc')
        ->filter($request->only('search'))
        ->paginate(8)
        ->withQueryString()
        ->through(fn ($products) => [
            'id' => $products->id,
            'sku' => $products->sku,
            'product' => $products->product,
            'price' => $products->price
        ]);

        return Inertia::render('Barang/Index', [
            'data' => $data,
            'title' => 'Products',
            'filters' => $filter
        ]);
    }

    public function create()
    {
        return Inertia::render('Barang/Create', [
            'title' => 'Create Products'
        ]);
    }

    public function store(ProductCreateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $product = new product($data);
        $product->save();

        return redirect()->route('barang')->with('success', 'Product Successfully Added!');
    }

    public function edit(int $id) {
        $data = product::where('id', $id)->first();

        return Inertia::render('Barang/Edit', [
            'data' => $data,
            'title' => 'Edit Product'
        ]);
    }

    public function update(int $id, ProductUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $product = product::where('id', $id)->first();
        $product->fill($data);
        $product->save();

        return redirect()->route('barang')->with('success', 'Product Successfully updated!');

    }

    public function delete(int $id)
    {
        $product = product::where('id', $id)->first();
        $product->delete();

        return redirect()->route('barang')->with('success', 'Product Successfully deleted!');
    }
}
