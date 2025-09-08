<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'nullable|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $categories = new Category();
        $categories->name = $request->name;
        $categories->slug = $request->slug;
        $categories->status = $request->status;
        $categories->save();

        return redirect()->route('categories.index')->with('success', 'Category created.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        //dd($category);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'slug' => 'nullable|string|max:255',
            'status' => 'required|integer|in:0,1',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->products()->detach();
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted.');
    }
}
