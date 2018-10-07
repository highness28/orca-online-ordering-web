<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Customer;
use App\Brand;
use Auth;
use View;

class BaseController extends Controller
{
    public function __construct() {
        $categories = Category::get();
        $brands = Brand::get();
        $newCategories = Category::orderBy('id', 'desc')->take(5)->get();
        $loggedInCustomer = null;

        if(!Auth::check()) {
            $loggedInCustomer = Customer::find(1);
        }

        View::share('categories', $categories);
        View::share('newCategories', $newCategories);
        View::share('loggedInCustomer', $loggedInCustomer);
        View::share('brands', $brands);
    }
}
