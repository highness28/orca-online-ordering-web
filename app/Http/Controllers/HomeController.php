<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\FeaturedCategory;
use App\Category;
use Cart;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $newProducts = Product::orderBy('id', 'desc')->take(10)->get();
        $newCategories = Category::orderBy('id', 'desc')->take(5)->get();
        $featuredCategory = FeaturedCategory::where('status', '1')->get();

        $topSelling = DB::table('orders_list')
        ->select(DB::raw("SUM(quantity) as quantity, product_id, product_name, product_price, category_name, brand_name, image"))
        ->join('products', 'orders_list.product_id', '=', 'products.id')
        ->join('category', 'products.category_id', '=', 'category.id')
        ->join('brand', 'products.brand_id', '=', 'brand.id')
        ->groupBy('product_id')
        ->orderBy('quantity', 'desc')
        ->take(10)
        ->get();

        $recentBuy = DB::table('orders_list')
        ->select(DB::raw("product_id, product_name, product_price, category_name, image"))
        ->join('products', 'orders_list.product_id', '=', 'products.id')
        ->join('category', 'products.category_id', '=', 'category.id')
        ->orderBy('orders_list.id', 'desc')
        ->take(16)
        ->get();

        return view('index')
        ->with('newProducts', $newProducts)
        ->with('featuredCategory', $featuredCategory)
        ->with('topSelling', $topSelling)
        ->with('recentBuy', $recentBuy);
    }
}
