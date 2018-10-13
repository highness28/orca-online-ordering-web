<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductReview;
use App\Customer;
use Auth;
use Cart;
use Illuminate\Support\Facades\DB;

class ProductController extends BaseController
{
    public function index(Request $request) {
        if(!$request->id) {
            abort(404);
        }

        $product_id = base64_decode($request->id);
        $product = Product::find($product_id);

        $reviews = ProductReview::where('product_id', $product_id)->get();
        $customerReview = ProductReview::with('customer')->where('product_id', $product_id)->paginate(3);
        $star1 = ProductReview::where('product_id', $product_id)->where('star', '1')->get();
        $star2 = ProductReview::where('product_id', $product_id)->where('star', '2')->get();
        $star3 = ProductReview::where('product_id', $product_id)->where('star', '3')->get();
        $star4 = ProductReview::where('product_id', $product_id)->where('star', '4')->get();
        $star5 = ProductReview::where('product_id', $product_id)->where('star', '5')->get();

        $starProgress = [
            count($star1),
            count($star2),
            count($star3),
            count($star4),
            count($star5),
        ];

        $reviewRating = 0;
        $ctr = 0;
        foreach($reviews as $review) {
            $reviewRating += $review->star;
            $ctr++;
        }
        if($ctr > 0) {
            $reviewRating = $reviewRating / $ctr;
        }

        $soldQuantity = DB::table('orders_list')
        ->select(DB::raw("SUM(quantity) as quantity"))
        ->join('invoice', 'invoice.id', 'orders_list.invoice_id')
        ->groupBy('product_id')
        ->where('product_id', $product_id)
        ->whereNotIn('invoice.status', [3,4,5])
        ->first();
        
        $soldQuantity = $soldQuantity ? $soldQuantity->quantity : 0;

        $inventoryQuantity = DB::table('inventories')
        ->select(DB::raw("SUM(quantity) as quantity"))
        ->where('product_id', $product_id)
        ->where('status', '1')
        ->first();

        $inventoryQuantity = $inventoryQuantity->quantity ? $inventoryQuantity->quantity : 0;

        $stock = $inventoryQuantity - $soldQuantity;

        $customer = null;
        $reviewPower = false;
        if(Auth::check()) {
            $customer_id = Auth::user()->customer_id;

            $ordersToReview = DB::table('orders_list')
            ->join('invoice', 'invoice.id', 'orders_list.invoice_id')
            ->where('invoice.customer_id', $customer_id)
            ->where('product_id', $product_id)
            ->where('reviewed', '0')
            ->whereNotIn('invoice.status', [3,4,5])
            ->get();

            if($ordersToReview->count() > 0) {
                $reviewPower = true;
            }
        }

        $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->take(20)
        ->get();

        $cartQuantity = Cart::get($product_id) ? Cart::get($product_id)->quantity : 1;
        
        return view('product.index')
        ->with('product', $product)
        ->with('reviewRating', $reviewRating)
        ->with('reviews', $reviews)
        ->with('stock', $stock)
        ->with('starProgress', $starProgress)
        ->with('customerReview', $customerReview)
        ->with('reviewPower', $reviewPower)
        ->with('customer', $customer)
        ->with('relatedProducts', $relatedProducts)
        ->with('cartQuantity', $cartQuantity);
    }

    public function addCart(Request $request) {
        $productEloquent = Product::find($request->id);
        
        $previousProduct = Cart::get($request->id);
        Cart::add(array(
            'id'       => $request->id,
            'name'     => $productEloquent->product_name."splitHere".base64_encode($productEloquent->image),
            'price'    => $productEloquent->product_price,
            'quantity' => 1
        ));

        if($previousProduct == null) {
            echo(json_encode(Cart::get($request->id)));
        } else {
            echo("");
        }
    }

    public function updateCart(Request $request) {
        $productEloquent = Product::find($request->id);

        $previousProduct = Cart::get($request->id);
        $product = Cart::update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity
            ),
        ));
        
        if($previousProduct == null) {
            echo(json_encode(Cart::get($request->id)));
        } else {
            echo("");
        }
    }

    public function getCart() {
        echo json_encode(Cart::getContent());
    }

    public function removeCart(Request $request) {
        Cart::remove($request->id);
        echo "remove success";
    }

    public function getCartTotal() {
        echo 'Php ' . number_format(Cart::getTotal(), 2);
    }
}
