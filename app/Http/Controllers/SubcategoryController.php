<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    public function index()
{
    $subcategories = DB::table('subcategories')
        ->join('categories', 'subcategories.category_id', '=', 'categories.category_id')
        ->select(
            'subcategories.subcategory_id',
            'subcategories.subcategory_name',
            'subcategories.subcategory_description',
            'categories.category_name'
        )
        ->get();

    return view('admin.pages.category.subcategory.subcategorylist', compact('subcategories'));
}


    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.category.subcategory.addsubcategory', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required',
            'subcategory_description' => 'nullable',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        Subcategory::create($request->all());

        return redirect()->route('subcategories.index')->with('success', 'Subcategory added successfully.');
    }

    public function edit($id)
    {
    $subcategory = Subcategory::findOrFail($id);
    $categories = Category::all(); // for dropdown

    return view('admin.pages.category.subcategory.editsubcategory', compact('subcategory', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $request->validate([
            'subcategory_name' => 'required',
            'subcategory_description' => 'nullable',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        $subcategory->update($request->all());

        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully.');
    }

    public function delete($id)
    {
        Subcategory::findOrFail($id)->delete();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully.');
    }
}
