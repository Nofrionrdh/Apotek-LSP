<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MidtransController extends Controller
{
    public function getSnapToken(Request $request, $id)
    {
        $penjualan = Penjualan::with(['details.obat', 'pelanggan'])
            ->findOrFail($id);
        
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        
        $params = array(
            'transaction_details' => array(
                'order_id' => $penjualan->no_pemesanan,
                'gross_amount' => (int) $penjualan->total_bayar
            ),
            'customer_details' => array(
                'first_name' => $penjualan->pelanggan->nama_pelanggan,
                'email' => $penjualan->pelanggan->email,
                'phone' => $penjualan->pelanggan->no_telp
            ),
            'item_details' => array_merge(
                // Product items
                $penjualan->details->map(function($detail) {
                    return [
                        'id' => $detail->obat->id,
                        'price' => $detail->harga_beli,
                        'quantity' => $detail->jumlah_beli,
                        'name' => $detail->obat->nama_obat
                    ];
                })->toArray(),
                // Shipping cost
                [[
                    'id' => 'shipping',
                    'price' => (int) $penjualan->ongkos_kirim,
                    'quantity' => 1,
                    'name' => 'Biaya Pengiriman'
                ]],
                // Platform fee
                [[
                    'id' => 'platform_fee',
                    'price' => (int) $penjualan->biaya_app,
                    'quantity' => 1,
                    'name' => 'Biaya Platform'
                ]]
            )
        );

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function handleNotification(Request $request)
    {
        try {
            $notification = new \Midtrans\Notification();
            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            
            $penjualan = Penjualan::with('details.obat')
                ->where('no_pemesanan', $orderId)
                ->first();

            if (!$penjualan) {
                throw new \Exception('Order not found');
            }

            DB::beginTransaction();
            try {
                switch ($transactionStatus) {
                    case 'capture':
                    case 'settlement':
                        $penjualan->update([
                            'status_order' => 'Diproses',
                            'keterangan_status' => 'Pembayaran berhasil, pesanan sedang diproses'
                        ]);
                        
                        // Update stock
                        foreach ($penjualan->details as $detail) {
                            $detail->obat->decrement('stok', $detail->jumlah_beli);
                        }
                        break;
                        
                    case 'pending':
                        $penjualan->update([
                            'status_order' => 'Menunggu Konfirmasi',
                            'keterangan_status' => 'Menunggu pembayaran dari pembeli'
                        ]);
                        break;
                        
                    case 'deny':
                    case 'expire':
                    case 'cancel':
                        $penjualan->update([
                            'status_order' => 'Dibatalkan Sistem',
                            'keterangan_status' => 'Pembayaran ' . $transactionStatus
                        ]);
                        break;
                }
                
                DB::commit();
                return response()->json(['status' => 'success']);
                
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function finishRedirect(Request $request)
    {
        return redirect()->route('pemesanan.index')
            ->with('success', 'Pembayaran berhasil diproses!');
    }

    public function unfinishRedirect(Request $request)
    {
        return redirect()->route('pemesanan.index')
            ->with('warning', 'Pembayaran belum selesai!');
    }

    public function errorRedirect(Request $request)
    {
        return redirect()->route('pemesanan.index')
            ->with('error', 'Pembayaran gagal!');
    }
}