@extends('layouts.app')

@section('css')
    <style>
        .parallax { 
            /* The image used */
            background-image: url("{{ asset('img/parallax.png') }}");

            /* Set a specific height */
            height: 600px; 

            /* Create the parallax scrolling effect */
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endsection

@section('content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            {!! Session::get('message') !!}
            <!-- row -->
            <div class="row">
                @foreach($featuredCategory as $featured)
                    <div class="col-md-4 col-xs-6">
                        <div class="shop" style="border: 1px solid #eee;">
                            <div class="shop-img">
                                <img src="data:image/png;base64,{{ base64_encode($featured->image) }}" alt="">
                            </div>
                            <div class="shop-body">
                                <h3>{{ $featured->title }}</h3>
                                <a href="{{ url('/products?category='.$featured->category_id) }}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">New Products</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                @foreach(getGlobalCategories() as $category)
                                    <li><a href="{{ url('/products?category='.$category->id) }}">{{ $category->category_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach($newProducts as $product)
                                        <div class="product">
                                            <div class="product-img" style="padding-top: 20px;">
                                                <img src="data:image/png;base64,{{ base64_encode($product->image) }}" alt="New Product" style="padding: 10px;">
                                                <div class="product-label">
                                                    <span class="new">{{ $product->brand->brand_name }}</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $product->category->category_name }}</p>
                                                <h3 class="product-name"><a href="{{ url('/product?id='.base64_encode($product->id)) }}">{{ $product->product_name }}</a></h3>
                                                <h4 class="product-price">{{ 'Php ' . number_format($product->product_price, 2) }}</h4>

                                                <div class="product-rating">
                                                    <i class="fa fa-star{{ getProductRating($product->id) > 1 ? '':'-o' }}"></i>
                                                    <i class="fa fa-star{{ getProductRating($product->id) > 2 ? '':'-o' }}"></i>
                                                    <i class="fa fa-star{{ getProductRating($product->id) > 3 ? '':'-o' }}"></i>
                                                    <i class="fa fa-star{{ getProductRating($product->id) > 4 ? '':'-o' }}"></i>
                                                    <i class="fa fa-star{{ getProductRating($product->id) > 5 ? '':'-o' }}"></i>
                                                </div>

                                                <div class="product-btns">
                                                    <button class="quick-view" onclick="function relocate(){ window.location = '/product?id={{ base64_encode($product->id) }}' }; relocate()"><i class="fa fa-eye"></i><span class="tooltipp">view</span></button>
                                                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                                </div>
                                        </div>
                                            <div class="add-to-cart">
                                                <button class="add-to-cart-btn" data-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- HOT DEAL SECTION -->
    <div class="section parallax">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal" style="color: white; margin-top: 200px;">
                        <h2 class="text-uppercase" style="color: white;">Innovation is the only way to win</h2>
                        <p>What are you waitning for? shop now and innovate!</p>
                        <a class="primary-btn cta-btn" href="{{ url('/products') }}">Click here</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Top selling</h3>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    @foreach($topSelling as $product)
                                        <div class="product">
                                            <div class="product-img" style="padding-top: 20px;">
                                                <img src="data:image/png;base64,{{ base64_encode($product->image) }}" alt="New Product" style="padding: 10px;">
                                                <div class="product-label">
                                                    <span class="new">{{ $product->brand_name }}</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $product->category_name }}</p>
                                                <h3 class="product-name"><a href="/product?id={{ base64_encode($product->product_id) }}">{{ $product->product_name }}</a></h3>
                                                <h4 class="product-price">{{ 'Php ' . number_format($product->product_price, 2) }}</h4>

                                                <div class="product-rating">
                                                    <i class="fa fa-star{{ getProductRating($product->product_id) > 1 ? '':'-o' }}"></i>
                                                    <i class="fa fa-star{{ getProductRating($product->product_id) > 2 ? '':'-o' }}"></i>
                                                    <i class="fa fa-star{{ getProductRating($product->product_id) > 3 ? '':'-o' }}"></i>
                                                    <i class="fa fa-star{{ getProductRating($product->product_id) > 4 ? '':'-o' }}"></i>
                                                    <i class="fa fa-star{{ getProductRating($product->product_id) > 5 ? '':'-o' }}"></i>
                                                </div>

                                                <div class="product-btns">
                                                    <button class="quick-view" onclick="function relocate(){ window.location = '/product?id={{ base64_encode($product->product_id) }}' }; relocate()"><i class="fa fa-eye"></i><span class="tooltipp">view</span></button>
                                                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                                </div>
                                            </div>
                                            <div class="add-to-cart">
                                                <button class="add-to-cart-btn" data-id="{{ $product->product_id }}"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title">
                        <h4 class="title">Recent buys</h4>
                        <div class="section-nav">
                            <div id="slick-nav-3" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-3">
                        <div>
                            @foreach($recentBuy as $product)
                                <a href="{{ url('/product?id='.base64_encode($product->product_id)) }}">
                                    <div class="col-xs-3" style="margin-bottom: 20px;">
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="data:image/png;base64,{{ base64_encode($product->image) }}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $product->category_name }}</p>
                                                <h3 class="product-name"><a href="{{ url('/product?id='.base64_encode($product->product_id)) }}">{{ $product->product_name }}</a></h3>
                                                <h4 class="product-price">{{ 'Php ' . number_format($product->product_price, 2) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- NEWSLETTER -->
    <div id="newsletter" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                        <form>
                            <input class="input" type="email" placeholder="Enter Your Email">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                        </form>
                        <ul class="newsletter-follow">
                            <li>
                                <a href="https://www.facebook.com/opcsupplies/"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /NEWSLETTER -->
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".add-to-cart-btn").on('click', function() {
                $id = $(this).attr("data-id");

                $.ajax( '/add-cart', {
                    type: "GET",
                    data: {
                        id: $id
                    },
                    success: function(product) {
                        if(product == "error") {
                            alert("Insufficient stocks left")
                        } else if(product != "") {
                            $product = JSON.parse(product);
                            $("#cart-container").append(`
                                <div class="product-widget" id="cart-item-`+$id+`">
                                    <div class="product-img">
                                        <img src="data:image/png;base64,`+$product.name.split("splitHere")[1]+`" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-name"><a href="#">`+$product.name.split("splitHere")[0]+`</a></h3>
                                        <h4 class="product-price"><span class="qty" id="cart-qty-`+$id+`">1x</span>`+$product.price+`</h4>
                                    </div>
                                    <button class="delete cart-remove" onclick="removeCartItem(`+$id+`)"><i class="fa fa-close"></i></button>
                                </div>
                            `)
                        } else {
                            $quantityField = document.getElementById('cart-qty-' + $id).textContent;
                            $quantity = parseInt($quantityField.substring(0, $quantityField.length)) + 1;
                            document.getElementById('cart-qty-' + $id).textContent = $quantity + "x";
                        }
                        
                        $.get("/cart-total", function( total ) {
                            document.getElementById("cart-total").textContent = total;
                        });

                        $.get("/cart-qty", function( quantity ) {
                            document.getElementById("cart-badge").textContent = quantity;
                            document.getElementById("cart-badge").classList.add('qty');
                        });
                    },
                    error: function(req, status, err) {
                        console.warn(err)
                        alert(err)
                    }
                })
            });
        });
    </script>
@endsection