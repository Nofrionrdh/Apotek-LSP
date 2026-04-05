<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Obat;
use App\Models\Pelanggan;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $cart_items = [];
        $total_price = 0;

        foreach ($cart as $id => $item) {
            $cart_items[] = $item;
            $total_price += $item['price'] * $item['quantity'];
        }

        return view('fe.cart.index', [
            'title' => 'Cart',
            'cart_items' => $cart_items,
            'total_price' => $total_price
        ]);
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $product = Obat::findOrFail($productId);
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->nama_obat,
                'price' => $product->harga_jual,
                'image' => $product->foto1,
                'quantity' => $quantity
            ];
        }
        session(['cart' => $cart]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }
        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function updateQuantity(Request $request, $productId)
    {
        $quantity = max(1, (int)$request->input('quantity', 1));
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session(['cart' => $cart]);
        }
        return redirect()->route('cart.index')->with('success', 'Jumlah produk diperbarui!');
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }
        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang!');
    }

    public function checkout(Request $request)
    {
        $selectedProducts = json_decode($request->selected_products, true);
        
        if (empty($selectedProducts)) {
            return redirect()->route('cart.index')
                ->with('error', 'Pilih minimal satu produk untuk checkout');
        }

        $total_price = 0;
        foreach ($selectedProducts as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }

        return view('fe.checkout.index', [
            'checkout_items' => $selectedProducts,
            'total_price' => $total_price
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
