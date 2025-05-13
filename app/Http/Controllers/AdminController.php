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

 public function storeProduct(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imagePath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Produk berhasil ditambahkan');
    }



}
