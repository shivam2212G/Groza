<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function showcategory(){
        $adminId = session('admin_id');
        $categories = Category::where('admin_id', $adminId)->get();

        return view('admin.pages.category.categorylist',compact('categories',));
    }

    public function showcatform(){
        return view('admin.pages.category.addcategoryform');
    }

    public function store(Request $request)
    {
    $request->validate([
        'category_name' => 'required|string|max:255',
        'category_image' => 'required|image',
        'category_description' => 'nullable|string',
    ]);

    // Handle image upload
    $imagePath = $request->file('category_image')->store('category', 'public');

    Category::create([
        'category_name' => $request->category_name,
        'category_image' => $imagePath,
        'category_description' => $request->category_description,
        'admin_id' => session('admin_id'),
    ]);

    return redirect()->back()->with('success', 'Category added successfully.');
    }


    public function edit($id)
    {
    $category = Category::findOrFail($id);
    return view('admin.pages.category.editcategory', compact('category'));
    }

// Update category
public function update(Request $request, $id)
{
    $category = Category::findOrFail($id);

    $request->validate([
        'category_name' => 'required|string|max:255',
        'category_image' => 'nullable|image|mimes:jpg,jpeg,png',
        'category_description' => 'nullable|string',
    ]);

    // If new image uploaded
    if ($request->hasFile('category_image')) {
        $imagePath = $request->file('category_image')->store('category', 'public');
        $category->category_image = $imagePath;
    }

    $category->category_name = $request->category_name;
    $category->category_description = $request->category_description;
    $category->save();

    return redirect()->route('admin.category')->with('success', 'Category updated successfully.');
    }

    public function delete($id)
{
    $category = Category::findOrFail($id);

    if ($category->category_image && Storage::exists('public/' . $category->category_image)) {
        Storage::delete('public/' . $category->category_image);
    }

    $category->delete();

    return redirect()->back()->with('success', 'Category deleted successfully.');
}
}

