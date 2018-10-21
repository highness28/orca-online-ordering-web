<?php
    function getProductRating($id) {
        $reviews = App\ProductReview::where('product_id', $id)->get();
        $totalReview = 0;

        foreach($reviews as $review) {
            $totalReview += $review->star;
        }

        if($totalReview == 0) {
            return 0;
        } else {
            return $totalReview / count($reviews);
        }
    }

    function getGlobalCategories() {
        return App\Category::get();
    }

    function getGlobalBrands() {
        return App\Brand::get();
    }

    function getCategories($breadCrumbCategories) {
        $eloquentCategory = App\Category::whereIn('id', $breadCrumbCategories)->get();

        $categories = [];
        foreach($eloquentCategory as $category) {
            $categories[] = $category->category_name;
        }

        if($categories != null) {
            return implode(', &nbsp;', $categories); 
        } else {
            return 'ALL CATEGORIES';
        }
    }

    function getBrands($breadCrumbBrands) {
        $eloquentBrand = App\Brand::whereIn('id', $breadCrumbBrands)->get();

        $brands = [];
        foreach($eloquentBrand as $brand) {
            $brands[] = $brand->brand_name;
        }

        if($brands != null) {
            return implode(', &nbsp;', $brands); 
        } else {
            return 'ALL CATEGORIES';
        }
    }

    function getCartTotal() {
        return number_format(Cart::getTotal(), 2);
    }

    function getCartCount() {
        return Cart::getContent()->count();
    }

    function getAuth() {
        if(\Auth::check()) {
            $loggedInCustomer = App\Customer::find(\Auth::user()->customer_id);
            return $loggedInCustomer;
        }
        return null;
    }