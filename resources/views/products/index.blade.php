@extends ('shopify-app::layouts.default')

@section('title', 'Product Selection')

@section('header', 'Select a Product')

@section('content')

<div x-data="{ openModal: false, saving: false, currentProductId: null, currentDescription: '' }">
    @if(session('success'))
    <div id="flash-message" class="bg-blue-100 border border-blue-500 text-blue-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <button class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="document.getElementById('flash-message').remove();">
            <svg class="fill-current h-6 w-6 text-blue-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 14.849a1.2 1.2 0 01-1.697 0L10 11.819l-2.651 3.03a1.2 1.2 0 01-1.697-1.697l3.03-2.651-3.03-2.651a1.2 1.2 0 011.697-1.697l2.651 3.03 2.651-3.03a1.2 1.2 0 011.697 1.697l-3.03 2.651 3.03 2.651a1.2 1.2 0 010 1.697z" />
            </svg>
        </button>
    </div>
    @endif

    <div class="bg-blue-50 min-h-screen">
        <table class="table-auto w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-blue-200 text-black">
                <tr>
                    <th class="px-4 py-2 text-left">Product Title</th>
                    <th class="px-4 py-2 text-left">Product Alert</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($storeProducts as $product)

                <tr class="hover:bg-blue-100 transition duration-150 ease-in-out">
                    <td class="border px-4 py-2 text-gray-900">
                        {{ $product['title'] }}
                        <img src="{{ $product['image']['src'] ?? 'Default Image' }}" alt="{{ $product['image']['alt'] ?? '' }}" class="h-20 w-20 object-cover rounded-md shadow-sm" />
                    </td>
                    <td class="border px-4 py-2 text-gray-600">{{ \App\Models\Product::where('store_product_id', $product['id'])->first()->custom_description ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">
                    <a @click.prevent="openModal = true; currentProductId = {{ $product['id'] }}; currentDescription = '{{ \App\Models\Product::where('store_product_id', $product['id'])->first()->custom_description ?? '' }}';" class="inline-block bg-blue-600 text-white px-3 py-1 rounded-full text-sm hover:bg-blue-700 focus:outline-none transition duration-150 ease-in-out cursor-pointer">Set an Alert</a>
                    </td>
                </tr>
                
                @empty
                <tr>
                    <td colspan="4" class="border px-4 py-4 text-center text-sm text-gray-500">
                        No products found.
                    </td>
                </tr>
                @endforelse
                

            </tbody>
            <div x-show="openModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center" x-cloak>
                    <div class="bg-white rounded-lg p-5 shadow-lg w-full md:w-3/4 lg:w-1/2 xl:w-1/3 h-auto py-10">
                        <div class="flex justify-between items-center border-b pb-3">
                            <p class="text-lg font-semibold">Alert Details</p>
                            <button @click="openModal = false">X</button>
                        </div>
                        <form method="POST" action="{{ route('products.store') }}" @submit="saving = true">
                            @csrf
                            <input type="hidden" name="product_id" x-bind:value="currentProductId">
                            <!-- Form Content -->
                            <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea name="description" id="description" rows="5" x-model="currentDescription" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"></textarea>
                        </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center" :disabled="saving">
                                    <template x-if="!saving">
                                        <span>Save</span>
                                    </template>
                                    <template x-if="saving">
                                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </template>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
        </table>
        <div class="py-4">
            {{ $storeProducts->links() }}
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    setTimeout(function() {
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            flashMessage.style.transition = 'opacity 0.5s';
            flashMessage.style.opacity = '0';
            setTimeout(() => flashMessage.remove(), 500); // Extended to ensure the transition completes.
        }
    }, 5000); // Giving users more time to read the message.
</script>
@endpush