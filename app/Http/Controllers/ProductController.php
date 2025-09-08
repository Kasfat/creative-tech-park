<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['categories' => function ($query) {
            $query->where('status', 1);
        }])->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();


        $product->categories()->sync($request->categories);

        return redirect()->route('products.index')->with('success', 'Product created.');
    }



    public function edit(Product $product)
    {
        $categories = Category::where('status', 1)->orderBy('name')->get();
        $selected = $product->categories()->pluck('categories.id')->toArray();
        return view('products.edit', compact('product', 'categories', 'selected'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $id,
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();


        $product->categories()->sync($request->categories);

        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->categories()->detach();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}
