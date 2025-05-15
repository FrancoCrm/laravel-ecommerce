<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCategory($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();
    $products = Product::where('category_id', $category->id)->latest()->paginate(12);

    return view('categories.show', compact('category', 'products'));
}
}
