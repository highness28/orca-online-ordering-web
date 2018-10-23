<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\OrderList;
use Auth;

class OrderController extends Controller
{
    public function index() {
        $invoice = Invoice::where('customer_id', Auth::user()->customer_id)->get();
        
        return view('orders.index')
        ->with('invoice', $invoice);
    }
    
    public function view(Request $request) {
        $invoice = Invoice::find($request->id);
        $ordersList = OrderList::where('invoice_id', $invoice->id)->get();

        return view('orders.edit')
        ->with('invoice', $invoice)
        ->with('ordersList', $ordersList);
    }
}
