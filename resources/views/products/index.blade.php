@extends('layouts.app')

@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="#">{!! count($breadCrumbCategories) > 0 ? getCategories($breadCrumbCategories) : 'All categories' !!}</a></li>
                        <li><a href="#">{!! count($breadCrumbBrands) > 0 ? getBrands($breadCrumbBrands) : 'All brands' !!}</a></li>
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
                <!-- ASIDE -->
                <form method="GET" action="{{ url('/products') }}">
                    <div id="aside" class="col-md-3">
                        <!-- aside Widget -->
                        <div class="aside">
                            <h3 class="aside-title">Categories</h3>
                            <div class="checkbox-filter">
                                @foreach(getGlobalCategories() as $category)
                                    <div class="input-checkbox">
                                        <input type="checkbox" name="category[]" type="checkbox" value="{{ $category->id }}" id="category-{{ $category->id }}" {{ in_array($category->id, $breadCrumbCategories) ? 'checked' : '' }}>
                                        <label for="category-{{ $category->id }}">
                                            <span></span>
                                            {{ $category->category_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /aside Widget -->

                        <!-- aside Widget -->
                        <!-- <div class="aside">
                            <h3 class="aside-title">Price</h3>
                            <div class="price-filter">
                                <div id="price-slider"></div>
                                <div class="input-number price-min">
                                    <input id="price-min" type="number">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                                <span>-</span>
                                <div class="input-number price-max">
                                    <input id="price-max" type="number">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>
                        </div> -->
                        <!-- /aside Widget -->

                        <!-- aside Widget -->
                        <div class="aside">
                            <h3 class="aside-title">Brand</h3>
                            <div class="checkbox-filter">
                                @foreach(getGlobalBrands() as $brand)
                                    <div class="input-checkbox">
                                        <input type="checkbox" name="brand[]" value="{{ $brand->id }}" id="brand-{{ $brand->id }}" {{ in_array($brand->id, $breadCrumbBrands) ? 'checked' : '' }}>
                                        <label for="brand-{{ $brand->id }}">
                                            <span></span>
                                            {{ $brand->brand_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /aside Widget -->

                        <div class="aside">
                            <div class="form-group">
                                <input class="input" type="text" name="product_name" placeholder="Product Name" value="{{ $productName }}">
                            </div>
                        </div>

                        <button class="primary-btn" style="width: 100%; margin: 10px 0 20px 0;">Submit</button>

                        <!-- aside Widget -->
                        <div class="aside">
                            <h3 class="aside-title">Top selling</h3>
                            @foreach($topSelling as $product)
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
                            @endforeach
                        </div>
                        <!-- /aside Widget -->
                    </div>
                </form>
                <!-- /ASIDE -->

                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- store top filter -->
                    <!-- <div class="store-filter clearfix">
                        <div class="store-sort">
                            <label>
                                Sort By: &nbsp;
                                <select class="input-select" style="width: 150px">
                                    <option value="">Select</option>
                                    <option value="0">Price</option>
                                    <option value="1">Name</option>
                                </select>
                            </label>
                        </div>
                    </div> -->
                    <!-- /store top filter -->

                    <!-- store products -->
                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-md-4 col-xs-6 clearfix">
                                    <div class="product">
                                        <div class="product-img">
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
                                </div>
                            @endforeach
						</div>
                    <!-- /store products -->

                    <!-- store bottom filter -->
                    <div class="store-filter clearfix col-xs-12">
                        <span class="store-qty">Showing {{ $products->count() . '-' . $products->total() }} product(s)</span>
                        {{ $products->appends(request()->except('page'))->links() }}
                    </div>
                    <!-- /store bottom filter -->
                </div>
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
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