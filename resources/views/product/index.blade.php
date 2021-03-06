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
							<li><a href="{{ url('/') }}" style="font-size: 18px;">Home</a></li>
							<li><a href="{{ url('/products?category='.$product->category->id) }}" style="font-size: 18px;">{{ $product->category->category_name }}</a></li>
							<li><a href="{{ url('/products?brand='.$product->brand->id) }}" style="font-size: 18px;">{{ $product->brand->brand_name }}</a></li>
							<li class="active" style="font-size: 18px;">{{ $product->product_name }}</li>
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
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							<div class="product-preview">
								<img src="data:image/png;base64,{{ base64_encode($product->image) }}">
							</div>
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							<div class="product-preview">
								<img src="data:image/png;base64,{{ base64_encode($product->image) }}">
							</div>
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name">{{ $product->product_name }}</h2>
							<div>
								<div class="product-rating">
									<i class="fa fa-star{{ $reviewRating > 0 ? '':'-o' }}"></i>
									<i class="fa fa-star{{ $reviewRating > 1 ? '':'-o' }}"></i>
									<i class="fa fa-star{{ $reviewRating > 2 ? '':'-o' }}"></i>
									<i class="fa fa-star{{ $reviewRating > 3 ? '':'-o' }}"></i>
									<i class="fa fa-star{{ $reviewRating > 4 ? '':'-o' }}"></i>
								</div>
								<a class="review-link" href="#">{{ count($reviews) }} Review(s)</a>
							</div>
							<div>
								<h3 class="product-price">{{ 'Php ' . number_format($product->product_price, 2) }}</h3>
								<span class="product-available">{{ $stock }} In Stock</span>
							</div>
							<p>{!! $product->description !!}</p>

							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number" value="{{ $cartQuantity }}" name="quantity" id="product_quantity">
									</div>
								</div>
								<button class="add-to-cart-btn" data-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>

							<ul class="product-btns">
								<li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
							</ul>

							<ul class="product-links">
								<li>Category:</li>
								<li><a href="{{ url('/product?category='.$product->category_id) }}">{{ $product->category->category_name }}</a></li>
							</ul>

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li  class="active"><a data-toggle="tab" href="#tab3">Reviews ({{ count($reviews) }})</a></li>
								<li><a data-toggle="tab" href="#tab1">Description</a></li>
								<li><a data-toggle="tab" href="#tab2">Specification</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<p>{!! $product->description !!}</p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<p>{!! $product->specification !!}</p>
										</div>
									</div>
								</div>
								<!-- /tab2  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in active">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>{{ $reviewRating }}</span>
													<div class="rating-stars">
														<i class="fa fa-star{{ $reviewRating > 0 ? '':'-o' }}"></i>
														<i class="fa fa-star{{ $reviewRating > 1 ? '':'-o' }}"></i>
														<i class="fa fa-star{{ $reviewRating > 2 ? '':'-o' }}"></i>
														<i class="fa fa-star{{ $reviewRating > 3 ? '':'-o' }}"></i>
														<i class="fa fa-star{{ $reviewRating > 4 ? '':'-o' }}"></i>
													</div>
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
															<div style="width: {{ $starProgress[4] != 0 ? ($starProgress[4] / count($reviews) * 100 ) : '0' }}%"></div>
														</div>
														<span class="sum">{{ $starProgress[4] }}</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: {{ $starProgress[3] != 0 ? ($starProgress[3] / count($reviews) * 100 ) : '0' }}%"></div>
														</div>
														<span class="sum">{{ $starProgress[3] }}</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: {{ $starProgress[2] != 0 ? ($starProgress[2] / count($reviews) * 100 ) : '0' }}%"></div>
														</div>
														<span class="sum">{{ $starProgress[2] }}</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: {{ $starProgress[1] != 0 ? ($starProgress[1] / count($reviews) * 100 ) : '0' }}%"></div>
														</div>
														<span class="sum">{{ $starProgress[1] }}</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: {{ $starProgress[0] != 0 ? ($starProgress[0] / count($reviews) * 100 ) : '0' }}%"></div>
														</div>
														<span class="sum">{{ $starProgress[0] }}</span>
													</li>
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">
													@foreach($customerReview as $review)
														<li>
															<div class="review-heading">
																<h5 class="name">{{ $review->customer->first_name . ' ' .  $review->customer->last_name }}</h5>
																<p class="date">{{ $review->created_at->diffForHumans() }}</p>
																<div class="review-rating">
																	<i class="fa fa-star{{ $review->star >= 1 ? '':'-o' }}"></i>
																	<i class="fa fa-star{{ $review->star >= 2 ? '':'-o' }}"></i>
																	<i class="fa fa-star{{ $review->star >= 3 ? '':'-o' }}"></i>
																	<i class="fa fa-star{{ $review->star >= 4 ? '':'-o' }}"></i>
																	<i class="fa fa-star{{ $review->star >= 5 ? '':'-o' }}"></i>
																</div>
															</div>
															<div class="review-body">
																<p>{!! $review->description !!}</p>
															</div>
														</li>
													@endforeach
												</ul>
												{{ $customerReview->appends(request()->except('page'))->links() }}
											</div>
										</div>
										<!-- /Reviews -->

										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												<form class="review-form">
													<input type="text" name="product_id" class="hidden" value="{{ $product->id }}">
													<input type="text" name="customer_id" class="hidden" value="{{ Auth::check() ? getAuth()->id : '' }}">
													<input class="input" name="name" type="text" placeholder="Your Name" value="{{ Auth::check() ? getAuth()->first_name . ' ' . getAuth()->last_name : '' }}" disabled>
													<input class="input" name="email" type="email" placeholder="Your Email" value="{{ Auth::check() ? getAuth()->account->email : '' }}" disabled>
													<textarea class="input" name="description" placeholder="Your Review" required></textarea>
													<div class="input-rating">
														<span>Your Rating: </span>
														<div class="stars">
															<input id="star5" name="star" required value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="star" required value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="star" required value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="star" required value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="star" required value="1" type="radio"><label for="star1"></label>
														</div>
													</div>
													@if($reviewPower)
														<button class="primary-btn">Submit</button>
													@elseif(!Auth::check())
														<p style="color: red;">Please login to review.</p>													
													@endif
													
													<div style="margin-top: 20px;">
														<p><strong>Note:</strong> only those who bought the product can review.</p>
													</div>
												</form>
											</div>
										</div>
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		@if(count($relatedProducts) > 0)
			<!-- Section -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">

						<div class="col-md-12">
							<div class="section-title text-center">
								<h3 class="title">Related Products</h3>
							</div>
						</div>

						<!-- Products tab & slick -->
						<div class="col-md-12">
							<div class="row">
								<div class="products-tabs">
									<!-- tab -->
									<div id="tab2" class="tab-pane fade in active">
										<div class="products-slick" data-nav="#slick-nav-2">
											@foreach($relatedProducts as $product)
												<div class="product">
													<div class="product-img" style="padding-top: 20px;">
														<img src="data:image/png;base64,{{ base64_encode($product->image) }}" alt="New Product" style="padding: 10px;">
														<div class="product-label">
															<span class="new">{{ $product->brand->brand_name }}</span>
														</div>
													</div>
													<div class="product-body">
														<p class="product-category">{{ $product->category->category_name }}</p>
														<h3 class="product-name"><a href="/product?id={{ base64_encode($product->id) }}">{{ $product->product_name }}</a></h3>
														<h4 class="product-price">{{ 'Php ' . number_format($product->product_price, 2) }}</h4>
														
														<div class="product-rating">
															<i class="fa fa-star{{ getProductRating($product->id) > 1 ? '':'-o' }}"></i>
															<i class="fa fa-star{{ getProductRating($product->id) > 2 ? '':'-o' }}"></i>
															<i class="fa fa-star{{ getProductRating($product->id) > 3 ? '':'-o' }}"></i>
															<i class="fa fa-star{{ getProductRating($product->id) > 4 ? '':'-o' }}"></i>
															<i class="fa fa-star{{ getProductRating($product->id) > 5 ? '':'-o' }}"></i>
														</div>

														<div class="product-btns">
															<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
															<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
														</div>
													</div>
													<div class="add-to-cart">
														<button class="add-to-cart-btn" data-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i> add to cart</button>
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
		@endif
		<!-- /Section -->
		<br><br><br>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".add-to-cart-btn").on('click', function() {
                $id = $(this).attr("data-id");
                $.ajax( '/update-cart', {
                    type: "GET",
                    data: {
						id: $id,
						quantity: $("#product_quantity").val()
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

							document.getElementById('cart-qty-' + $id).textContent = $("#product_quantity").val() + "x";
						} else {
							document.getElementById('cart-qty-' + $id).textContent = $("#product_quantity").val() + "x";
						}

						$.get("/cart-qty", function( quantity ) {
								document.getElementById("cart-badge").textContent = quantity;
								document.getElementById("cart-badge").classList.add('qty');
							});

						$.get("/cart-total", function( total ) {
							document.getElementById("cart-total").textContent = total;
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