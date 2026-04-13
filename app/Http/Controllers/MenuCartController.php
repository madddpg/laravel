<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Menu;

class MenuCartController extends Controller
{
    /**
     * Read menu items from DB.
     *
     * @return array<int, array{id:int,name:string,description:string,price:int,image:string}>
     */
    private function menuItems(): array
    {
        return Menu::all(['id', 'name', 'description', 'price', 'image'])->toArray();
    }

    public function home(): View
    {
        $users = User::all();
        return view('home', compact('users'));
    }

    public function menu(): View
    {
        return view('menu', ['products' => $this->menuItems()]);
    }

    public function cart(Request $request): View
    {
        $cart = $request->session()->get('cart', []);

        $grandTotal = collect($cart)->sum(fn ($row) => $row['price'] * $row['quantity']);

        return view('cart', [
            'cart' => $cart,
            'grandTotal' => $grandTotal,
        ]);
    }

    public function addToCart(Request $request, int $id): RedirectResponse
    {
        $product = collect($this->menuItems())->firstWhere('id', $id);

        if (!$product) {
            return back()->with('error', 'Menu item not found.');
        }

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1,
            ];
        }

        $request->session()->put('cart', $cart);

        return redirect()->route('menu')->with('success', $product['name'] . ' added to cart.');
    }

    public function increaseQuantity(Request $request, int $id): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('cart');
    }

    public function decreaseQuantity(Request $request, int $id): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (!isset($cart[$id])) {
            return redirect()->route('cart');
        }

        $cart[$id]['quantity']--;

        if ($cart[$id]['quantity'] <= 0) {
            unset($cart[$id]);
        }

        $request->session()->put('cart', $cart);

        return redirect()->route('cart');
    }

    public function checkout(Request $request): View|RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $orderNumber = random_int(100000, 999999);

        $request->session()->forget('cart');

        return view('checkout', ['orderNumber' => $orderNumber]);
    }
}
