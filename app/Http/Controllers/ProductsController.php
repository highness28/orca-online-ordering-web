<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(Request $request) {
        $category = [];
        $brand = [];
        $productName = $request->input("product_name") ? $request->input("product_name") : "";

        if(isset($request->query()['category']) && is_array($request->query()['category'])) {
            $category = $request->query()['category'];
        } else {
            $category = isset($request->query()['category']) ? explode(',', $category = $request->query()['category']) : [];
        }

        if(isset($request->query()['brand']) && is_array($request->query()['brand'])) {
            $brand = $request->query()['brand'];
        } else {
            $brand = isset($request->query()['brand']) ? explode(',', $brand = $request->query()['brand']) : [];
        }

        $products = null;

        if(count($category) > 0 && count($brand) > 0) {
            $products = Product::whereIn('category_id', $category)
            ->whereIn('brand_id', $brand)
            ->where('product_name', 'LIKE', '%' . $productName . '%')
            ->where('deleted_at', '=', null)
            ->paginate(15);
        }
        else if(count($category) > 0 && count($brand) == 0) {
            $products = Product::whereIn('category_id', $category)
            ->where('product_name', 'LIKE', '%' . $productName . '%')
            ->where('deleted_at', '=', null)
            ->paginate(15);
        }
        else if(count($category) == 0 && count($brand) > 0) {
            $products = Product::whereIn('brand_id', $brand)
            ->where('product_name', 'LIKE', '%' . $productName . '%')
            ->where('deleted_at', '=', null)
            ->paginate(15);
        }
        else {
            $products = Product::where('product_name', 'LIKE', '%' . $productName . '%')
            ->where('deleted_at', '=', null)
            ->paginate(15);
        }

        $topSelling = DB::table('orders_list')
        ->select(DB::raw("SUM(quantity) as quantity, product_id, product_name, product_price, category_name, brand_name, image"))
        ->join('products', 'orders_list.product_id', '=', 'products.id')
        ->join('category', 'products.category_id', '=', 'category.id')
        ->join('brand', 'products.brand_id', '=', 'brand.id')
        ->groupBy('product_id')
        ->orderBy('quantity', 'desc')
        ->take(10)
        ->get();

        return view('products.index')
        ->with('products', $products)
        ->with('breadCrumbCategories', $category)
        ->with('breadCrumbBrands', $brand)
        ->with('topSelling', $topSelling)
        ->with('productName', $productName);
    }
}
