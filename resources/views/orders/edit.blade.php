@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container" style="padding: 20px;">
            <div class="row">

                <div class="col-xs-6">
                    <h3><strong>Customer Name:</strong> {{ $invoice->customer->first_name . ' ' . $invoice->customer->last_name }}</h3>
                    <ul>
                        <li><strong>Contact #:</strong> {{ $invoice->deliveryAddress->phone_number }}</li>
                        <li><strong>Delivery Address</strong> {{ $invoice->deliveryAddress->delivery_address }}</li>
                        <li><strong>Province</strong> {{ $invoice->deliveryAddress->province }}</li>
                        <li><strong>City</strong> {{ $invoice->deliveryAddress->city }}</li>
                        <li><strong>Barangay</strong> {{ $invoice->deliveryAddress->barangay }}</li>
                        <li><strong>Tacking number:</strong> {{ $invoice->tracking_number }}</li>
                        <li><strong>Date orderd:</strong> {{ date('F d, Y', strtotime($invoice->created_at)) }}</li>
                        <li><strong>Status: </strong> {{ $invoice->status == 3 ? 'Completed' : ($invoice->status == 2 ? 'For Delivery' : 'For Verification') }} {{ $invoice->delivery_date ? ' on ' . date('F d, Y', strtotime($invoice->delivery_date)):'' }}</li>
                        <li><strong>Total: </strong> {{ 'Php ' . number_format($invoice->total, 2) }}</li>
                    </ul>
                </div>

                <div class="col-xs-6">
                    <div class="col-xs-12">
                        <span><strong>Products Ordered:</strong></span>
                    </div>

                    <div class="col-xs-6" style="margin-top: 30px;">
                        <ol>
                            @foreach($ordersList as $order)
                                <a href="{{ url('/product?id='.base64_encode($order->product_id)) }}">
                                    <li>
                                        @if($order->product->image)
                                            <img src="data:image/png;base64,{{ base64_encode($order->product->image) }}" alt="Product" style="height: 30px;">
                                        @else
                                            <img src="{{ url('/img/products/default.png') }}" alt="Product" style="height: 30px;">
                                        @endif
                                        <strong>{{ $order->product->product_name }}</strong>
                                    </li>
                                </a>
                            @endforeach
                        </ol>
                    </div>

                    <div class="col-xs-6" style="margin-top: 30px;">
                        <ul style="list-style-type:none">
                            @foreach($ordersList as $order)
                                <li style="height: 30px;">{{ $order->quantity }} x <em>{{ number_format($order->subtotal, 2) }}</em></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection