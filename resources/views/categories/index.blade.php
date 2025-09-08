@extends('layouts.app')
@section('title','Categories')

@section('content')
<div class="flex items-center justify-between mb-6">
  <div>
    <h2 class="text-xl font-semibold text-gray-900">Categories</h2>
    <p class="text-sm text-gray-600 mt-1">Manage your product categories</p>
  </div>
  <a href="{{ route('categories.create') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition duration-200">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
    </svg>
    Create category
  </a>
</div>

<div class="bg-white rounded shadow">
  @if($categories->count())
    <div class="divide-y divide-gray-200">
      @foreach($categories as $category)
        <div class="flex items-center justify-between p-6 hover:bg-gray-50 transition duration-150">
          <div class="flex items-center space-x-4">
            <!-- Category Icon/Image -->
            <div class="flex-shrink-0">
              @if($category->image)
                <img class="h-12 w-12 rounded-lg object-cover" src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}">
              @else
                <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                  </svg>
                </div>
              @endif
            </div>

            <div>
              <div class="flex items-center space-x-3">
                <h3 class="text-lg font-medium text-gray-900">{{ $category->name }}</h3>
                @if($category->status == 1)
                  <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    Active
                  </span>
                @else
                  <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    Inactive
                  </span>
                @endif
              </div>
              
              @if($category->slug)
                <p class="text-sm text-gray-600 mt-1">Slug: <span class="font-mono bg-gray-100 text-gray-800 px-2 py-1 rounded">{{ $category->slug }}</span></p>  
              @endif
            </div>
          </div>


          <div class="flex items-center space-x-2">
            <a href="{{ route('categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900 transition p-2" title="Edit">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
              </svg>
            </a>
            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Delete this category?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-900 transition p-2" title="Delete">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
              </button>
            </form>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Pagination -->
    @if($categories->hasPages())
      <div class="px-6 py-4 border-t border-gray-200">
        {{ $categories->links() }}
      </div>
    @endif
  @else
    <!-- Empty State -->
    <div class="p-12 text-center">
      <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
      </svg>
      <h3 class="text-lg font-medium text-gray-900 mb-2">No categories found</h3>
      <p class="text-gray-600 mb-4">Get started by creating your first category.</p>
      <a href="{{ route('categories.create') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition duration-200">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Create Category
      </a>
    </div>
  @endif
</div>
@endsection