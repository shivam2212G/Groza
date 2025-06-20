<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
{
    $products = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.category_id')
        ->join('subcategories', 'products.subcategory_id', '=', 'subcategories.subcategory_id')
        ->select(
            'products.*',
            'categories.category_name',
            'subcategories.subcategory_name'
        )
        ->get();

    return view('admin.pages.product.productlist', compact('products'));
}

    public function create()
    {
        $category_subs = DB::table('categories')
    ->leftJoin('subcategories', 'categories.category_id', '=', 'subcategories.category_id')
    ->select(
        'categories.category_id',
        'categories.category_name',
        'subcategories.subcategory_id',
        'subcategories.subcategory_name'
    )
    ->get();


    return view('admin.pages.product.addproduct', compact('category_subs'));

    }

    public function store(Request $request)
    {
    $request->validate([
        'product_name' => 'required',
        'product_image' => 'required|image',
        'product_description' => 'required',
        'subcategory_id' => 'required',
        'product_price' => 'required',
    ]);

    $imagePath = null;
    if ($request->hasFile('product_image')) {
        $imagePath = $request->file('product_image')->store('products', 'public');
    }

    $subcategory = Subcategory::find($request->subcategory_id);
    if (!$subcategory) {
        return back()->with('error', 'Invalid Subcategory.');
    }

    Product::create([
        'product_name' => $request->product_name,
        'product_price' => $request->product_price,
        'product_image' => $imagePath,
        'product_description' => $request->product_description,
        'subcategory_id' => $subcategory->subcategory_id,
        'category_id' => $subcategory->category_id,
    ]);

    return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }


    public function edit($id)
    {
    $product = Product::findOrFail($id);
    $categories = Category::with('subcategories')->get();
    return view('admin.pages.product.editproduct', compact('product', 'categories'));
    }


    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'product_name' => 'required',
        'product_image' => 'nullable|image',
        'product_description' => 'required',
        'subcategory_id' => 'required',
        'product_price' => 'required',
    ]);

    if ($request->hasFile('product_image')) {
        // Delete old image if exists
        if ($product->product_image) {
            Storage::disk('public')->delete($product->product_image);
        }

        $product->product_image = $request->file('product_image')->store('products', 'public');
    }

    $subcategory = Subcategory::find($request->subcategory_id);

    $product->update([
        'product_name' => $request->product_name,
        'product_description' => $request->product_description,
        'subcategory_id' => $subcategory->subcategory_id,
        'category_id' => $subcategory->category_id,
        'product_price' => $request->product_price,
    ]);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}


    public function delete($id)
    {
        $product = Product::findOrFail($id);
        if ($product->product_image) {
            Storage::disk('public')->delete($product->product_image);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
