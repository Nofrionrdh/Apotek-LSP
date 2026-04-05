<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Pembelian;
use App\Models\Obat;
use App\Models\Distributor;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalPelanggan = Pelanggan::count();
        $totalPenjualan = Penjualan::count();
        $totalPembelian = Pembelian::count();
        $totalObat = Obat::count();
        $totalDistributor = Distributor::count();
        $totalPengiriman = Pengiriman::count();

        $totalPenjualanUser = 0;
        if (Auth::check() && Auth::user()->jabatan == 'kasir') {
            $totalPenjualanUser = Penjualan::where('created_by', Auth::id())->count();
        }

        $totalPengeluaran = Pembelian::sum('total_bayar');
        $totalPenghasilan = Penjualan::sum('total_bayar');

        return view('be.dashboard.index', compact(
            'totalUser',
            'totalPelanggan',
            'totalPenjualan',
            'totalPembelian',
            'totalObat',
            'totalDistributor',
            'totalPengiriman',
            'totalPenjualanUser',
            'totalPengeluaran',
            'totalPenghasilan'
        ));
    }

    public function exportPdf(Request $request)
    {
        // // Validasi akses
        // if (!auth()->check() || !in_array(auth()->user()->jabatan, ['admin', 'pemilik'])) {
        //     abort(403, 'Unauthorized action.');
        // }

        // Ambil data periode
        $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::now()->startOfMonth();
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::now()->endOfMonth();

        // Data untuk PDF
        $data = [
            'totalUser' => User::count(),
            'totalPelanggan' => Pelanggan::count(),
            'totalPenjualan' => Penjualan::whereBetween('created_at', [$startDate, $endDate])->count(),
            'totalPembelian' => Pembelian::whereBetween('created_at', [$startDate, $endDate])->count(),
            'totalObat' => Obat::count(),
            'totalDistributor' => Distributor::count(),
            'totalPengiriman' => Pengiriman::whereBetween('created_at', [$startDate, $endDate])->count(),
            'totalPengeluaran' => Pembelian::whereBetween('created_at', [$startDate, $endDate])->sum('total_bayar'),
            'totalPenghasilan' => Penjualan::whereBetween('created_at', [$startDate, $endDate])->sum('total_bayar'),
            'periode' => $startDate->format('d M Y') . ' - ' . $endDate->format('d M Y'),
            'tanggalExport' => Carbon::now()->format('d-m-Y H:i:s'),
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        // Generate PDF
        $pdf = Pdf::loadView('be.dashboard.export-pdf', $data);

        // Set nama file
        $filename = 'laporan-dashboard-' . Carbon::now()->format('Y-m-d') . '.pdf';

        // Download PDF
        return $pdf->download($filename);
    }
}