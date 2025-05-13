<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function index()
{

    $totalProducts = Product::count();
    $totalCategories = Category::count();
    $totalUsers = User::count();

    return view('dashboard', compact('totalProducts', 'totalCategories', 'totalUsers'));
}

 public function productList() {

    $products = Product::with('category')->latest()->paginate(5);
    return view('dashboard.products.index', compact('products'));


}

public function productAdd() {
    $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));

}



}
