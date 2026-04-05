<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Dashboard Medicare</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            background-color: #007BFF;
            color: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 36px;
            margin: 0;
        }

        .header h2 {
            font-size: 24px;
            font-weight: 400;
            margin: 10px 0;
        }

        .header .period {
            font-size: 16px;
            font-style: italic;
            margin-top: 5px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-left: 6px solid #007BFF;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: scale(1.02);
        }

        .stat-title {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: #007BFF;
        }

        .financial-summary {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .financial-summary h3 {
            font-size: 22px;
            color: #007BFF;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #007BFF;
            color: white;
            text-align: left;
            padding: 12px;
        }

        td {
            padding: 12px;
            border: 1px solid #e0e0e0;
            color: #333;
        }

        .footer {
            text-align: right;
            font-size: 14px;
            color: #6c757d;
            font-style: italic;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Medicare</h1>
        <h2>Laporan Dashboard Apotek</h2>
        <p class="period">Periode: {{ $periode }}</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <p class="stat-title">Total User</p>
            <p class="stat-value">{{ $totalUser }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-title">Total Pelanggan</p>
            <p class="stat-value">{{ $totalPelanggan }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-title">Total Penjualan</p>
            <p class="stat-value">{{ $totalPenjualan }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-title">Total Pembelian</p>
            <p class="stat-value">{{ $totalPembelian }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-title">Total Obat</p>
            <p class="stat-value">{{ $totalObat }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-title">Total Distributor</p>
            <p class="stat-value">{{ $totalDistributor }}</p>
        </div>
    </div>

    <div class="financial-summary">
        <h3>Ringkasan Keuangan</h3>
        <table>
            <tr>
                <th>Kategori</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>Total Pengeluaran</td>
                <td>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Penghasilan</td>
                <td>Rp {{ number_format($totalPenghasilan, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ date('d-m-Y H:i:s', strtotime($tanggalExport)) }}</p>
    </div>
</body>
</html>
