@extends('layouts.app')
@section('title','Products')

@section('content')
<div class="flex items-center justify-between mb-6">
  <div>
    <h2 class="text-xl font-semibold text-gray-900">Products</h2>
    <p class="text-sm text-gray-600 mt-1">Manage your product inventory</p>
  </div>
  <a href="{{ route('products.create') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition duration-200">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
    </svg>
    Create product
  </a>
</div>

<div class="bg-white rounded shadow">
  @if($products->count())
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categories</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($products as $product)
          <tr class="hover:bg-gray-50 transition duration-150">
            <td class="px-6 py-4">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                  @if($product->image)
                    <img class="h-10 w-10 rounded-lg object-cover" src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                  @else
                    <div class="h-10 w-10 rounded-lg bg-gray-200 flex items-center justify-center">
                      <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                      </svg>
                    </div>
                  @endif
                </div>
                <div class="ml-3">
                  <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="text-sm font-mono bg-gray-100 text-gray-800 px-2 py-1 rounded">{{ $product->sku ?? '—' }}</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="text-sm font-medium text-gray-900">৳{{ number_format($product->price, 2) }}</span>
            </td>
            <td class="px-6 py-4">
              <div class="flex flex-wrap gap-1">
                @forelse($product->categories as $cat)
                  <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $cat->name }}
                  </span>
                @empty
                  <span class="text-xs text-gray-400">No category</span>
                @endforelse
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
              <div class="flex items-center justify-center space-x-2">
                <a href="{{ route('products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900 transition" title="Edit">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                  </svg>
                </a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Delete this product?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-900 transition" title="Delete">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
      <div class="px-6 py-4 border-t border-gray-200">
        {{ $products->links() }}
      </div>
    @endif
  @else
    <!-- Empty State -->
    <div class="p-12 text-center">
      <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
      </svg>
      <h3 class="text-lg font-medium text-gray-900 mb-2">No products found</h3>
      <p class="text-gray-600 mb-4">Get started by creating your first product.</p>
      <a href="{{ route('products.create') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition duration-200">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Create Product
      </a>
    </div>
  @endif
</div>
@endsection