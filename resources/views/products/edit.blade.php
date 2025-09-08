@extends('layouts.app')
@section('title','Edit Product')

@section('content')
<div class="bg-white rounded shadow p-6">
  <div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-semibold text-gray-900">Edit product</h2>
    <a href="{{ route('products.index') }}" class="text-sm text-gray-600 hover:text-gray-900">← Back</a>
  </div>

  <form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="grid gap-6 md:grid-cols-2">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
        <input name="name" value="{{ old('name', $product->name) }}" 
               class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('name') border-red-500 @enderror" 
               placeholder="Enter product name" />
        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">SKU</label>
        <input name="sku" value="{{ old('sku', $product->sku) }}" 
               class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('sku') border-red-500 @enderror" 
               placeholder="Enter SKU (optional)" />
        @error('sku') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Price (৳) *</label>
        <input name="price" value="{{ old('price', $product->price) }}" type="number" step="0.01" 
               class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('price') border-red-500 @enderror" 
               placeholder="0.00" />
        @error('price') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Categories *</label>
        <div class="mt-2 border border-gray-300 rounded-lg p-3 max-h-48 overflow-auto bg-gray-50">
          @if($categories->count())
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
              @foreach($categories as $category)
                <label class="inline-flex items-center space-x-2 cursor-pointer hover:bg-white rounded p-2 transition">
                  <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                         class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                         {{ (is_array(old('categories', $selected)) && in_array($category->id, old('categories', $selected))) ? 'checked' : '' }}>
                  <span class="text-sm text-gray-700">{{ $category->name }}</span>
                </label>
              @endforeach
            </div>
          @else
            <div class="text-center py-4">
              <p class="text-gray-500 text-sm">No categories available. <a href="{{ route('categories.create') }}" class="text-blue-600 hover:text-blue-800">Create one first</a>.</p>
            </div>
          @endif
        </div>
        @error('categories') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>
      <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
        <textarea name="description" rows="4" 
                  class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('description') border-red-500 @enderror" 
                  placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
        @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>
    </div>

    <div class="mt-8 pt-6 border-t border-gray-200 flex items-center gap-4">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200">
        Update Product
      </button>
      <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-900 transition">Cancel</a>
    </div>
  </form>
</div>
@endsection