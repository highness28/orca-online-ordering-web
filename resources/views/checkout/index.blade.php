@extends('layouts.app')

@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Checkout</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="active">Checkout</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <form action="{{ url('/payment') }}" method="POST">
                    @csrf
                    @if(Auth::check())
                        <div class="col-md-7">
                            <!-- Billing Details -->
                            <div class="billing-details">
                                <div class="section-title">
                                    <h3 class="title">Billing address</h3>
                                </div>

                                @foreach($addressBooks as $address)
                                    <div class="payment-method">
                                        <div class="input-radio">
                                            <input type="radio" name="address_book" value="{{ $address->id }}" id="shipping-{{ $address->id }}"
                                            {{ old('address_book') ?  (old('address_book') == $address->id ? 'checked':'') : $addressBooks->first()->id == $address->id ? 'checked':'' }}>
                                            <label for="shipping-{{ $address->id }}">
                                                <span></span>
                                                {{ $address->delivery_address }}
                                            </label>
                                            <div class="caption" style="padding-left: 20px;">
                                                <p><strong>Province: </strong> {{ $address->province }}</p>
                                                <p><strong>City: </strong> {{ $address->city }}</p>
                                                <p><strong>Barangay: </strong> {{ $address->barangay }}</p>
                                                <p><strong>Phone number: </strong> {{ $address->phone_number }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- /Billing Details -->
                        
                            <!-- Shiping Details -->
                            <div class="shiping-details">
                                <div class="section-title">
                                    <h3 class="title">Shiping address</h3>
                                </div>
                                <div class="input-checkbox">
                                    <input type="checkbox" id="shiping-address" name="ship_different" {{ old('ship_different') == "on" ? 'checked' : '' }}>
                                    <label for="shiping-address">
                                        <span></span>
                                        Ship to a diffrent address?
                                    </label>
                                    <div class="caption">
                                        <div class="form-group">
                                            <input class="input" type="text" name="delivery_address" placeholder="Delivery address" value="{{ old('delivery_address') }}">
                                            @if ($errors->has('delivery_address'))
                                                <span class="invalid-feedback" role="alert" style="color: red;">
                                                    <strong>{{ $errors->first('delivery_address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="text" name="province" placeholder="Province" value="{{ old('province') }}">
                                            @if ($errors->has('province'))
                                                <span class="invalid-feedback" role="alert" style="color: red;">
                                                    <strong>{{ $errors->first('province') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="text" name="city" placeholder="City" value="{{ old('city') }}">
                                            @if ($errors->has('city'))
                                                <span class="invalid-feedback" role="alert" style="color: red;">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="text" name="barangay" placeholder="Barangay" value="{{ old('barangay') }}">
                                            @if ($errors->has('barangay'))
                                                <span class="invalid-feedback" role="alert" style="color: red;">
                                                    <strong>{{ $errors->first('barangay') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input class="input" type="tel" name="phone_number" placeholder="Phone number" value="{{ old('phone_number') }}">
                                            @if ($errors->has('phone_number'))
                                                <span class="invalid-feedback" role="alert" style="color: red;">
                                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Shiping Details -->

                            <!-- Order notes -->
                            <!-- <div class="order-notes">
                                <textarea class="input" placeholder="Order Notes"></textarea>
                            </div> -->
                            <!-- /Order notes -->
                        </div>
                    @else
                        <div class="col-md-7">
                            <div class="billing-details">
                                <div class="section-title">
                                    <h3 class="title">Login</h3>
                                </div>
                                <div class="form-group">
                                    <form method="POST" action="{{ route('login') }}" id="login-form">
                                        @csrf
                                        <div class="form-group">
                                            <input id="email" class="input" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert" style="color: red;">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input id="password" class="input" type="password" name="password" placeholder="Passowrd" required>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert" style="color: red;">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <button type="submit" class="primary-btn order-submit">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Order Details -->
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">Your Order</h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>PRODUCT</strong></div>
                                <div><strong>TOTAL</strong></div>
                            </div>
                            <div class="order-products">
                                @foreach($cartContents as $product)
                                    <div class="order-col">
                                        <div>{{ $product->quantity . 'x ' . explode("splitHere", $product->name)[0] }}</div>
                                        <div>{{ 'Php ' . number_format($product->price * $product->quantity) }}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="order-col">
                                <div><strong>TOTAL</strong></div>
                                <div><strong class="order-total">{{ 'Php ' . number_format($total) }}</strong></div>
                            </div>
                        </div>

                        <label>Payment method</label>

                        <div class="payment-method">
                            <div class="input-radio">
                                <input type="radio" name="payment_method" id="payment-1" value="Cash on Delivery" checked="checked">
                                <label for="payment-1">
                                    <span></span>
                                    Cash on Delivery
                                </label>
                                <div class="caption">
                                </div>
                            </div>
                            
                            <div class="input-radio">
                                <input type="radio" name="payment_method" id="payment-2" value="Card">
                                <label for="payment-2">
                                    <span></span>
                                    Credit / Debit / Visa / BDO
                                </label>
                                <div class="caption">
                                    <img src="{{ asset('img/credit-card-template.png') }}" alt="credit-card" style="width: 100%;">
                                    <div class="form-group">
                                        <input id="card_number" class="input" type="text" name="card_number" placeholder="Card Number ####-####-####-####" value="{{ old('card_number') }}">
                                        @if ($errors->has('card_number'))
                                            <span class="invalid-feedback" role="alert" style="color: red;">
                                                <strong>{{ $errors->first('card_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <input id="expiration" class="input" type="text" name="expiration" placeholder="Expiration" value="{{ old('expiration') }}">
                                        @if ($errors->has('expiration'))
                                            <span class="invalid-feedback" role="alert" style="color: red;">
                                                <strong>{{ $errors->first('expiration') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <input id="cvc" class="input" type="text" name="cvc" placeholder="CVC" value="{{ old('cvc') }}">
                                        @if ($errors->has('cvc'))
                                            <span class="invalid-feedback" role="alert" style="color: red;">
                                                <strong>{{ $errors->first('cvc') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Terms & condition</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                BLAH BLAH BLAH BLAH BLAH BLAH BLAH 
                                BLAH BLAH BLAH BLAH BLAH BLAH BLAH 
                                BLAH BLAH BLAH BLAH BLAH BLAH BLAH 
                                BLAH BLAH BLAH BLAH BLAH BLAH BLAH 
                                BLAH BLAH BLAH BLAH BLAH BLAH BLAH
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>
                        
                        <div class="input-checkbox" style="margin-top: 20px;">
                            <input type="checkbox" name="terms_and_condition" id="terms">
                            <label for="terms">
                                <span></span>
                                I've read and accept the <a href="#" data-toggle="modal" data-target="#exampleModal">Terms & condition</a>
                            </label>
                            <br>
                            @if ($errors->has('terms_and_condition'))
                                <span class="invalid-feedback" role="alert" style="color: red;">
                                    <strong>{{ $errors->first('terms_and_condition') }}</strong>
                                </span>
                            @endif
                        </div>

                        @if(Auth::check())
                            @if(getCartCount() == 0)
                                <span class="primary-btn order-submit">Please add items to cart first</span>
                            @else
                                <button class="primary-btn order-submit">Place order</button>
                            @endif
                        @endif
                    </div>
                </form>
                <!-- /Order Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection