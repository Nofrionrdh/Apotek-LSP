<?php

namespace App\Http\Controllers;

use App\Models\MetodeBayar;
use App\Models\JenisPengiriman;
use App\Models\Obat;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil data cart dari session
        $cart = session('cart', []);
        $total_price = 0;
        $checkout_items = [];

        foreach($cart as $id => $details) {
            $total_price += $details['price'] * $details['quantity'];

            // Enrich cart item with product info and detect if it's 'obat keras'
            $obat = Obat::with('jenis_obat')->find($id);
            $is_keras = false;
            if ($obat && optional($obat->jenis_obat)->jenis) {
                $jenisText = strtolower(optional($obat->jenis_obat)->jenis);
                $is_keras = str_contains($jenisText, 'keras');
            }

            $details['is_keras'] = $is_keras;
            if (!isset($details['image']) && $obat && $obat->foto1) {
                $details['image'] = $obat->foto1;
            }

            $checkout_items[] = $details;
        }

        $has_obat_keras = collect($checkout_items)->where('is_keras', true)->count() > 0;

        // Ambil data jenis pengiriman dan metode pembayaran
        $jenis_pengirimans = JenisPengiriman::all();
        $metode_bayars = MetodeBayar::all();

        return view('fe.checkout.index', compact(
            'checkout_items',
            'total_price',
            'jenis_pengirimans',
            'metode_bayars'
        ))->with('has_obat_keras', $has_obat_keras);
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
        try {
            $request->validate([
                'url_resep' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'jenis_pengiriman' => 'required',
                'id_metode_bayar' => 'required',
                'ongkir' => 'required|numeric',
                'total_bayar' => 'required|numeric',
                'produk' => 'required'
            ]);

            $pelanggan = session('pelanggan');
            if (!$pelanggan) {
                return redirect()->route('pelanggan.login')
                    ->with('error', 'Silakan login terlebih dahulu.');
            }

            // Handle resep upload
            $resepPath = null;
            if ($request->hasFile('url_resep')) {
                $resepPath = $request->file('url_resep')->store('resep', 'public');
            }

            // Parse products from JSON
            $products = json_decode($request->produk, true);
            // If any product requires a prescription, enforce upload
            foreach ($products as $p) {
                $obat = Obat::with('jenis_obat')->find($p['id']);
                $jenisText = strtolower(optional($obat->jenis_obat)->jenis ?? '');
                if (str_contains($jenisText, 'keras') && !$request->hasFile('url_resep')) {
                    return redirect()->back()->withInput()->with('error', 'Produk tertentu memerlukan resep. Silakan upload foto resep.');
                }
            }
            $subtotal = collect($products)->sum(function($item) {
                return $item['price'] * $item['qty'];
            });
            
            // Hitung biaya aplikasi (10%)
            $biaya_aplikasi = $subtotal * 0.10;

            // Create penjualan record
            $penjualan = Penjualan::create([
                'no_pemesanan' => 'TRX' . date('YmdHis') . rand(100,999),
                'id_pelanggan' => $pelanggan->id,
                'id_metode_bayar' => $request->id_metode_bayar,
                'id_jenis_kirim' => $request->jenis_pengiriman,
                'tgl_penjualan' => now(),
                'url_resep' => $resepPath,
                'ongkos_kirim' => $request->ongkir,
                'biaya_app' => $biaya_aplikasi,
                'total_bayar' => $request->total_bayar + $biaya_aplikasi,
                'status_order' => 'Menunggu Konfirmasi',
                'keterangan_status' => ''
            ]);

            // Create detail penjualan records
            foreach ($products as $product) {
                DetailPenjualan::create([
                    'id_penjualan' => $penjualan->id,
                    'id_obat' => $product['id'],
                    'jumlah_beli' => $product['qty'],
                    'harga_beli' => $product['price'],
                    'subtotal' => $product['price'] * $product['qty']
                ]);
            }

            // Clear cart session
            session()->forget('cart');

            return redirect()->route('pemesanan.index')
                ->with('success', 'Pesanan berhasil dibuat!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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

    public function processOrder(Request $request)
    {
        // Ambil user id dari session pelanggan
        $pelanggan = session('pelanggan');
        $userId = $pelanggan ? $pelanggan->id : null;

        if (!$userId) {
            return redirect()->route('pelanggan.login')->withErrors('Silakan login terlebih dahulu.');
        }

        $produk = json_decode($request->produk, true);
        $jenis_pengiriman = $request->jenis_pengiriman;
        $ongkir = intval($request->ongkir);
        $total_bayar = intval($request->total_bayar);

        // Generate no_transaksi unik
        $no_transaksi = 'TRX' . date('YmdHis') . rand(100,999);

        // Simpan ke tabel penjualan
        $penjualan = Penjualan::create([
            'no_transaksi' => $no_transaksi,
            'id_pelanggan' => $userId,
            'total_bayar' => $total_bayar,
            'ongkir' => $ongkir,
            'status_order' => 'Diproses',
            'jenis_pengiriman' => $jenis_pengiriman,
        ]);

        // Simpan detail produk
        foreach ($produk as $item) {
            $penjualan->details()->create([
                'id_obat' => $item['id'],
                'jumlah_beli' => $item['qty'],
                'harga_beli' => $item['price'],
                'subtotal' => $item['qty'] * $item['price'],
            ]);
        }

        // Kosongkan cart session FE
        session()->forget('cart');

        return redirect()->route('pemesanan.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    // Tambahkan method ini di dalam class CheckoutController
    public function fakeOrder(Request $request)
    {
        // Simpan data pesanan ke session FE (bukan database)
        $produk = json_decode($request->produk, true);
        $jenis_pengiriman = $request->jenis_pengiriman;
        $ongkir = intval($request->ongkir);
        $total_bayar = intval($request->total_bayar);

        // Simulasi data pesanan (tanpa database)
        $fakeOrder = [
            'created_at' => now(),
            'no_transaksi' => 'TRX' . date('YmdHis') . rand(100,999),
            'total_bayar' => $total_bayar,
            'ongkir' => $ongkir,
            'biaya_aplikasi' => 0,
            'status_order' => 'Diproses',
            'metode_pembayaran' => '-',
            'jenis_pengiriman' => $jenis_pengiriman,
            'resep' => null,
            'details' => $produk,
        ];

        // Simpan ke session FE (bisa banyak order)
        $orders = session('fake_orders', []);
        $orders[] = $fakeOrder;
        session(['fake_orders' => $orders]);

        // Kosongkan cart session FE
        session()->forget('cart');

        return redirect()->route('pemesanan.index')->with('success', 'Pesanan berhasil dibuat!');
    }
}
