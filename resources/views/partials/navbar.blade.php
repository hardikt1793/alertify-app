<nav class="bg-blue-600">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <div class="sm:block sm:ml-3">
            <div class="flex space-x-4">
                <a href="/dashboard"
                    class="@if(Request::path() == 'dashboard' || Request::path() == '/') bg-blue-700 @else text-white @endif px-3 py-2 rounded-lg text-sm font-medium leading-5 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 transition duration-150 ease-in-out">
                    App Instructions
                </a>

                <a href="/products" class="@if(Request::path() == 'products' || Request::path() == 'products/alert') bg-blue-700 @else text-white @endif ml-4 px-3 py-2 rounded-lg text-sm font-medium leading-5 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 transition duration-150 ease-in-out">
                  Products
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>
</nav>
