<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use Symfony\Component\HttpFoundation\Response;

class UpdateCartCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Hitung jumlah item di cart user
            $user = Auth::user();
            $cartCount = CartItem::where('cart_id', $user->cart->id)->sum('quantity');

            // Simpan jumlah item ke session
            session(['cart_count' => $cartCount]);
        }

        return $next($request);
    }
}
