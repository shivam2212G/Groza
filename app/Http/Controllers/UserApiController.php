<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserApiController extends Controller
{
    // GET all categories
    public function getAllCategories()
    {
        return response()->json(Category::all());
    }

    // GET all subcategories of a specific category
    public function getSubcategoriesByCategory($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }

    // GET all subcategories
    public function getAllSubcategories()
    {
        return response()->json(Subcategory::all());
    }

    // GET all products of a specific category
    public function getProductsByCategory($categoryId)
    {
        $products = Product::where('category_id', $categoryId)->get();
        return response()->json($products);
    }

    public function getProductsByCategoryAndSubcategory($category_id, $subcategory_id)
    {
    $products = Product::where('category_id', $category_id)
        ->where('subcategory_id', $subcategory_id)
        ->get();

    return response()->json($products);
    }

    public function getAllProducts()
    {
        $products = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.category_id')
        ->join('subcategories', 'products.subcategory_id', '=', 'subcategories.subcategory_id')
        ->select(
            'products.product_id',
            'products.product_name',
            'products.product_image',
            'products.product_description',
            'products.product_price',
            'categories.category_name',
            'subcategories.subcategory_name'
        )
        ->get();

        return response()->json([
            'status' => true,
            'message' => 'All Products List',
            'data' => $products
        ]);
    }

}
