<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
   public function index()
{

    $totalProducts = Product::count();
    $totalCategories = Category::count();
    $totalUsers = User::count();
    $totalOrders = Order::count();

    return view('dashboard', compact('totalProducts', 'totalCategories', 'totalUsers', 'totalOrders'));
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
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:10024',
        ]);

        $image = $request->file('image');
        $image->storeAs('products', $image->hashName(), 'public');

        Product::create([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $image->hashName()
        ]);

        return redirect()->route('dashboard.products')->with('success', 'Produk berhasil ditambahkan');
    }

    public function deleteProduct ($id): RedirectResponse {
        $product = Product::findOrFail($id);
        Storage::delete('products/'.$product->image);
        $product->delete();
        return redirect()->route('dashboard.products')->with('success', 'Produk berhasil dihapus');
    }

    public function editProduct ($id) {
        $categories = Category::all();
      $product = Product::findOrFail($id);
        return view('dashboard.products.edit', compact('product','categories'));
    }

    public function updateProduct(Request $request, $id)
{
    $request->validate([
        'name'        => 'required|string|min:1',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required|string|min:10',
        'price'       => 'required|numeric',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:10024',
    ]);

    // ✅ Ambil produk dari database
    $product = Product::find($id);

    if (!$product) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan.');
    }

    // 📦 Jika upload gambar baru
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($product->image && Storage::disk('public')->exists('products/' . $product->image)) {
            Storage::disk('public')->delete('products/' . $product->image);
        }

        // Simpan gambar baru
        $image = $request->file('image');
        $imageName = $image->hashName();
        $image->storeAs('products', $imageName, 'public');

        $product->image = $imageName;
    }

    // 📝 Update field lainnya
    $product->name = $request->name;
    $product->category_id = $request->category_id;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->save();

    return redirect()->route('dashboard.products')->with('success', 'Produk berhasil diperbarui.');
}



    //Category
    public function categoryList() {
        $categories = Category::latest()->paginate(10);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function categoryAdd() {
        return view('dashboard.categories.create');
    }

    public function storeCategory(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('dashboard.categories')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function deleteCategory ($id): RedirectResponse {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('dashboard.categories')->with('success', 'Kategori berhasil dihapus');
    }

    public function editCategory ($id) {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:1',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        return redirect()->route('dashboard.categories')->with('success', 'Kategori berhasil diperbarui.');
    }

    //Users
    public function userList() {
        $users = User::latest()->paginate(10);
        return view('dashboard.users.index', compact('users'));
    }

    public function deleteUser ($id): RedirectResponse {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('dashboard.users')->with('success', 'User berhasil dihapus');
    }

    //Order
    public function listOrder() {

        $orders = Order::orderBy('id','desc')->paginate(10);
        return view('dashboard.orders.index', compact('orders'));
    }

    public function showOrder($id) {
        $order = Order::with(['orderItems.product', 'user'])->findOrFail($id);
        return view('dashboard.orders.show', compact('order'));
    }

    public function deleteOrder ($id): RedirectResponse {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('dashboard.orders')->with('success', 'Order berhasil dihapus');
    }

}
