@extends('shopify-app::layouts.default')

@section('content')

<div class="max-w-4xl mx-auto p-5">
    <h2 class="text-2xl font-bold mb-4">App Instructions</h2>
    <ol class="list-decimal list-inside bg-white shadow-md rounded-lg p-6 space-y-4">
        <li>
            <strong>Use case of app:</strong> Using Alertify app you can edit the alert messages that you want to display in product detail page.
        </li>
        <li>
            <strong>Insert snippet in your theme:</strong> To display the alert on your product detail page, copy & paste the following Liquid code in your main product template file:
            <div class="bg-gray-100 text-gray-800 font-mono rounded p-4 mt-2">
                <code>
                    &#123;&#123;% if product.metafields.alertify-alert.custom-description!=blank %&#125;&#125;
                    <div class="custom-description">
                        &#123;&#123; product.metafields.alertify-alert.custom-description &#125;&#125;
                    </div>
                    &#123;&#123;% endif %&#125;&#125;
                </code>
            </div>
        </li>
    </ol>
</div>


@endsection