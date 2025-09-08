@extends('layouts.app')
@section('title','Create Category')

@section('content')
<div class="bg-white rounded shadow">
  <!-- Header -->
  <div class="px-6 py-4 border-b border-gray-200">
    <div class="flex items-center justify-between">
      <div>
        <h2 class="text-xl font-semibold text-gray-900">Create Category</h2>
      </div>
       <a href="{{ route('categories.index') }}" class="text-sm text-gray-600 hover:text-gray-900">← Back </a>
    </div>
  </div>

  <form action="{{ route('categories.store') }}" method="POST" class="p-6">
    @csrf
    <div class="space-y-6">
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Category Name *</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" 
               class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('name') border-red-500 @enderror"
               placeholder="Enter category name">
        @error('name') 
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
        @enderror
      </div>
      <div>
        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug <span class="text-gray-500">(optional)</span></label>
        <input type="text" id="slug" name="slug" value="{{ old('slug') }}" 
               class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('slug') border-red-500 @enderror"
               placeholder="category-slug">
        
        @error('slug') 
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
        @enderror
      </div>
      <div>
        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
        <select id="status" name="status" 
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('status') border-red-500 @enderror">
          <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
          <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status') 
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
        @enderror
      </div>
    </div>
    <div class="mt-8 pt-6 border-t border-gray-200 flex items-center gap-4">
      <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        Save Category
      </button>
      <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-900 transition">Cancel</a>
    </div>
  </form>
</div>
@endsection