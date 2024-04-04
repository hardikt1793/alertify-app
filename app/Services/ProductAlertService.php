<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductAlertService
{
    protected $apiVersion;
    protected $perPageLimit;

    public function __construct()
    {
        $this->apiVersion = env('SHOPIFY_API_VERSION');
        $this->perPageLimit = 10;
    }

    public function getProducts($shop)
    {
        $getProductsFromStore = $shop->api()->rest('GET', "/admin/api/{$this->apiVersion}/products.json", ['limit' => 250])['body']['products'];
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $products = collect($getProductsFromStore);
        $currentItems = $products->slice(($currentPage * $this->perPageLimit) - $this->perPageLimit, $this->perPageLimit)->all();    
        return new LengthAwarePaginator($currentItems, count($products), $this->perPageLimit, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
    }

    public function getProductDescription($product_id)
    {
        return Product::where('store_product_id', $product_id)->first();
    }

    public function storeProductDescription($request)
    {       
        $authStore = Auth::user();
        $shop_domain = $authStore->getDomain()->toNative();       
        $updateProduct = Product::updateOrCreate(
            ['store_product_id' => $request->product_id],
            [
                'custom_description' => $request->description, 
                'shop_domain' => $shop_domain
            ]
        );

        $metafieldData = [
            'namespace' => 'alertify-alert',
            'key' => 'custom-description',
            'value' => $updateProduct->custom_description,
            'type' => 'single_line_text_field'
        ];

        $this->createProductMetafield($request->product_id, $metafieldData)['body'];
    }

    private function createProductMetafield($productId, $metafieldData)
    {
        $authStore = Auth::user();
        return $authStore->api()->rest("POST", "/admin/api/{$this->apiVersion}/products/{$productId}/metafields.json", ['metafield' => $metafieldData]);
    }
}
