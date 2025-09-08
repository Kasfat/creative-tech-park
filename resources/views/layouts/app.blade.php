<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'E-Commerce')</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen">
  <header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4">
      <div class="flex items-center justify-between">
        <a href="{{ url('/') }}" class="text-xl sm:text-2xl font-bold text-blue-600">Creative Shop</a>
        
        <!-- Mobile menu button -->
        <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg hover:bg-gray-100">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
  </header>

  <div class="container mx-auto px-4 py-4 sm:py-8">
    <div class="flex flex-col lg:flex-row gap-4 lg:gap-6">
      <!-- Left Sidebar -->
      <aside id="sidebar" class="w-full lg:w-64 bg-white rounded shadow p-4 order-2 lg:order-1 hidden lg:block">
        <h3 class="font-semibold mb-4 text-base sm:text-lg">Dashboard</h3>
        
        <!-- Categories Section -->
        <div class="mb-4 lg:mb-6">
          <a href="{{ route('categories.index') }}" class="block text-sm font-medium text-gray-700 hover:text-blue-600 transition py-2 px-2 rounded hover:bg-gray-50 {{ request()->routeIs('categories.*') ? 'text-blue-600 bg-blue-50' : '' }}">
            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            Categories
          </a>
        </div>

        <!-- Products Section -->
        <div class="mb-4 lg:mb-6">
          <a href="{{ route('products.index') }}" class="block text-sm font-medium text-gray-700 hover:text-blue-600 transition py-2 px-2 rounded hover:bg-gray-50 {{ request()->routeIs('products.*') ? 'text-blue-600 bg-blue-50' : '' }}">
            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            Products
          </a>
        </div>

      
      </aside>

      <!-- Mobile Sidebar Overlay -->
      <div id="mobile-sidebar-overlay" class="fixed z-40 lg:hidden hidden">
        <aside class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg z-50 p-4">
          <div class="flex items-center justify-between mb-6">
            <h3 class="font-semibold text-lg">Dashboard</h3>
            <button id="close-sidebar" class="p-2 rounded-lg hover:bg-gray-100">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>

          <!-- Mobile Menu Items -->
          <div class="space-y-4">
            <a href="{{ route('categories.index') }}" class="block text-sm font-medium text-gray-700 hover:text-blue-600 transition py-3 px-3 rounded hover:bg-gray-50 {{ request()->routeIs('categories.*') ? 'text-blue-600 bg-blue-50' : '' }}">
              <svg class="w-4 h-4 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
              </svg>
              Categories
            </a>
            <a href="{{ route('products.index') }}" class="block text-sm font-medium text-gray-700 hover:text-blue-600 transition py-3 px-3 rounded hover:bg-gray-50 {{ request()->routeIs('products.*') ? 'text-blue-600 bg-blue-50' : '' }}">
              <svg class="w-4 h-4 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
              </svg>
              Products
            </a>
          </div>
        </aside>
      </div>

      <!-- Right Content Area -->
      <main class="flex-1 order-1 lg:order-2">
        @if(session('success'))
          <div class="mb-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-3 sm:px-4 py-3 rounded text-sm">
              <div class="flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.parentElement.parentElement.remove()" class="ml-2">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        @endif

        @if(session('error'))
          <div class="mb-4">
            <div class="bg-red-50 border border-red-200 text-red-800 px-3 sm:px-4 py-3 rounded text-sm">
              <div class="flex items-center justify-between">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.parentElement.parentElement.remove()" class="ml-2">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        @endif

        @yield('content')
      </main>
    </div>
  </div>

  <!-- Mobile Menu JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const mobileMenuBtn = document.getElementById('mobile-menu-btn');
      const mobileOverlay = document.getElementById('mobile-sidebar-overlay');
      const closeSidebar = document.getElementById('close-sidebar');

      mobileMenuBtn.addEventListener('click', function() {
        mobileOverlay.classList.remove('hidden');
      });

      closeSidebar.addEventListener('click', function() {
        mobileOverlay.classList.add('hidden');
      });

      mobileOverlay.addEventListener('click', function(e) {
        if (e.target === mobileOverlay) {
          mobileOverlay.classList.add('hidden');
        }
      });

      // Close mobile menu when clicking navigation links
      const mobileNavLinks = mobileOverlay.querySelectorAll('a');
      mobileNavLinks.forEach(link => {
        link.addEventListener('click', function() {
          mobileOverlay.classList.add('hidden');
        });
      });
    });
  </script>
</body>
</html>