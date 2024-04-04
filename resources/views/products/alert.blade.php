@extends ('shopify-app::layouts.default')

@section('content')

<div class="container mx-auto mt-10">
    <div class="flex flex-wrap justify-center">
        <div class="w-full md:w-3/4 lg:w-1/2">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-blue-800 text-white font-bold rounded-t-lg">
                    Set an alert for product: {{ $product_id }}
                </div>
                <div class="p-6">
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product_id }}">

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea name="description" id="description" rows="5" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">{{ $description->custom_description ?? '' }}</textarea>
                        </div>
                        
                        <div class="flex items-center justify-center">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Save Alert
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
