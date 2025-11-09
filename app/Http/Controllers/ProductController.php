<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['brand', 'category', 'supplier'])->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.create', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'purchase_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'available_meters' => 'required|numeric',
            'barcode' => 'nullable|string',
        ]);
        Product::create($validated);
        session()->flash('success', 'Product created successfully.');
        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'brands', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required',
            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'purchase_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'available_meters' => 'required|numeric',
            'barcode' => 'nullable|string',
        ]);
        $product->update($validated);
        session()->flash('success', 'Product updated successfully.');
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        session()->flash('success', 'Product deleted successfully.');
        return redirect()->route('products.index');
    }
}
