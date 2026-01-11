<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi Bulanan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 5px;
        }
        .periode {
            text-align: center;
            margin-bottom: 20px;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
        th {
            background-color: #f0f0f0;
        }
        .right {
            text-align: right;
        }
        .center {
            text-align: center;
        }
        .total {
            margin-top: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>LAPORAN TRANSAKSI</h2>
    <div class="periode">Periode: {{ $bulan }}</div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pesanan</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksis as $index => $t)
                <tr>
                    <td class="center">{{ $index + 1 }}</td>
                    <td>{{ $t->kode_pesanan }}</td>
                    <td class="center">{{ $t->created_at->format('d-m-Y') }}</td>
                    <td>{{ $t->nama_pemesan }}</td>
                    <td class="right">
                        Rp {{ number_format($t->total_harga, 0, ',', '.') }}
                    </td>
                    <td class="center">{{ ucfirst($t->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="center">Tidak ada data transaksi</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total">
        Total Omzet (Selesai):
        Rp {{ number_format($totalOmzet, 0, ',', '.') }}
    </div>

</body>
</html>
