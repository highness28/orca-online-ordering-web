<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductReview;
use App\Customer;
use App\AddressBook;
use App\Invoice;
use App\OrderList;
use App\CardLog;
use Auth;
use Cart;
use App\Notifications\OrderPlaced;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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
        ->whereIn('invoice.status', [1,2,3])
        ->first();
        
        $soldQuantity = $soldQuantity ? $soldQuantity->quantity : 0;

        $inventoryQuantity = DB::table('inventories')
        ->select(DB::raw("SUM(quantity) as quantity"))
        ->where('product_id', $product_id)
        ->where('status', '0')
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

        $soldQuantity = DB::table('orders_list')
        ->select(DB::raw("SUM(quantity) as quantity"))
        ->join('invoice', 'invoice.id', 'orders_list.invoice_id')
        ->groupBy('product_id')
        ->where('product_id', $request->id)
        ->whereNotIn('invoice.status', [3,4,5])
        ->first();
        
        $soldQuantity = $soldQuantity ? $soldQuantity->quantity : 0;

        $inventoryQuantity = DB::table('inventories')
        ->select(DB::raw("SUM(quantity) as quantity"))
        ->where('product_id', $request->id)
        ->where('status', '0')
        ->first();

        $inventoryQuantity = $inventoryQuantity->quantity ? $inventoryQuantity->quantity : 0;

        $stock = $inventoryQuantity - $soldQuantity;
        
        $previousProduct = Cart::get($request->id);

        if($previousProduct == null) {
            Cart::add(array(
                'id'       => $request->id,
                'name'     => $productEloquent->product_name."splitHere".base64_encode($productEloquent->image),
                'price'    => $productEloquent->product_price,
                'quantity' => 1
            ));

            echo(json_encode(Cart::get($request->id)));
        } else {
            if($previousProduct->quantity+1 > $stock) {
                echo "error";
            } else {
                Cart::add(array(
                    'id'       => $request->id,
                    'name'     => $productEloquent->product_name."splitHere".base64_encode($productEloquent->image),
                    'price'    => $productEloquent->product_price,
                    'quantity' => 1
                ));

                echo("");
            }
        }
    }

    public function updateCart(Request $request) {
        $productEloquent = Product::find($request->id);

        $soldQuantity = DB::table('orders_list')
        ->select(DB::raw("SUM(quantity) as quantity"))
        ->join('invoice', 'invoice.id', 'orders_list.invoice_id')
        ->groupBy('product_id')
        ->where('product_id', $request->id)
        ->whereNotIn('invoice.status', [4,5])
        ->first();
        
        $soldQuantity = $soldQuantity ? $soldQuantity->quantity : 0;

        $inventoryQuantity = DB::table('inventories')
        ->select(DB::raw("SUM(quantity) as quantity"))
        ->where('product_id', $request->id)
        ->where('status', '0')
        ->first();

        $inventoryQuantity = $inventoryQuantity->quantity ? $inventoryQuantity->quantity : 0;

        $stock = $inventoryQuantity - $soldQuantity;

        if($request->quantity > $stock) {
            echo "error";
        } else {
            $previousProduct = Cart::get($request->id);

            if($previousProduct == null) {
                Cart::add(array(
                    'id'       => $request->id,
                    'name'     => $productEloquent->product_name."splitHere".base64_encode($productEloquent->image),
                    'price'    => $productEloquent->product_price,
                    'quantity' => $request->quantity
                ));
                echo(json_encode(Cart::get($request->id)));
            } else {
                $product = Cart::update($request->id, array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $request->quantity
                    ),
                ));
                echo("");
            }
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

    public function getCartQuantity() {
        echo Cart::getContent()->count();
    }

    public function checkout() {
        $cartContents = Cart::getContent();
        $total = Cart::getTotal();

        if(Auth::check()) {
            $customerInfo = Customer::find(Auth::user()->id);
            $addressBooks = AddressBook::get();
        } else {
            $customerInfo = null;
            $addressBooks = [];
        }
        
        return view('checkout.index')
        ->with('cartContents', $cartContents)
        ->with('total', $total)
        ->with('addressBooks', $addressBooks)
        ->with('customerInfo', $customerInfo);
    }

    public function payment(Request $request) {
        $user = Auth::user();

        $customerInfo = Customer::find(Auth::user()->customer_id);

        if($request->ship_different == "on") {
            Validator::make($request->all(), [
                'delivery_address' => 'required',
                'province' => 'required',
                'city' => 'required',
                'barangay' => 'required',
                'phone_number' => 'required',
                'terms_and_condition' => 'required',
                // 'card_number' => 'required|regex:/[0-9]{4}-{0,1}[0-9]{4}-{0,1}[0-9]{4}-{0,1}[0-9]{4}+$/u',
                // 'expiration' => 'required|regex:/[0-9]{2}\/[0-9]{2}/',
                // 'cvc' => 'required|regex:/^[0-9]{3}+$/u'
            ])->validate();
            
            $addressBook = AddressBook::create([
                'delivery_address' => $request->delivery_address,
                'province' => $request->province,
                'city' => $request->city,
                'barangay' => $request->barangay,
                'phone_number' => $request->phone_number,
                'customer_id' => $customerInfo->id,
                'terms_and_condition' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                // 'card_number' => 'required|regex:/[0-9]{4}-{0,1}[0-9]{4}-{0,1}[0-9]{4}-{0,1}[0-9]{4}+$/u',
                // 'expiration' => 'required|regex:/[0-9]{2}\/[0-9]{2}/',
                // 'cvc' => 'required|regex:/^[0-9]{3}+$/u',
                'terms_and_condition' => 'required'
            ])->validate();
            
            $addressBook = AddressBook::find($request->address_book);
        }

        $invoice = Invoice::create([
            'address_book_id' => $addressBook->id,
            'customer_id' => $customerInfo->id,
            'tracking_number' => base64_encode(time()),
            'total' => Cart::getTotal()
        ]);

        // CardLog::create([
        //     'invoice_id' => $invoice->id,
        //     'card_number' => $request->card_number,
        //     'expiration' => $request->expiration,
        //     'cvc' => $request->cvc,
        // ]);

        $cartContent = Cart::getContent();
        $cartTotal = Cart::getTotal();

        foreach($cartContent as $product) {
            OrderList::create([
                'invoice_id' => $invoice->id,
                'product_id' => $product->id,
                'quantity' => $product->quantity,
                'subtotal' => $product->quantity * $product->price
            ]);
        }

        $user->notify(new OrderPlaced($customerInfo, $cartContent, $cartTotal));

        Cart::clear();

        return redirect('/')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            Thank you for shopping with us! we will inform you once your order has been receive and verified.
                            </div>');
    }
}
