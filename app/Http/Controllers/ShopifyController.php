<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ProductAlertService;
use App\Models\Settings;

class ShopifyController extends Controller
{
    protected $productAlertService;

    public function __construct(ProductAlertService $productAlertService)
    {
        $this->productAlertService = $productAlertService;
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function index()
    {
        $authShop = Auth::user();
        $storeProducts = $this->productAlertService->getProducts($authShop);

        return view('products.index', compact('storeProducts', 'authShop'));
    }

    public function store(Request $request)
    {
        $this->productAlertService->storeProductDescription($request);
        $request->session()->flash('success', 'Product Custom Alert Saved Successfully!');
        return redirect()->route('products');
    }
}