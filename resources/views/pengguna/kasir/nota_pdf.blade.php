<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}- welcome</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- icon awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    {{-- <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script> --}}


    {{-- ini untuk family chart --}}
    <link rel="stylesheet" href="{{ asset('treant/Treant.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <style>
        body {
            font-family: 'Courier New', monospace;
            background: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .receipt {
            max-width: 320px;
            margin: auto;
            background: #fff;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .header p {
            margin: 4px 0;
            font-size: 12px;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        .info {
            font-size: 12px;
            line-height: 1.6;
        }

        table {
            width: 100%;
            font-size: 12px;
            border-collapse: collapse;
        }

        table th {
            text-align: left;
            padding-bottom: 5px;
            border-bottom: 1px dashed #000;
        }

        table td {
            padding: 4px 0;
            vertical-align: top;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total-row td {
            border-top: 1px dashed #000;
            font-weight: bold;
            padding-top: 8px;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            margin-top: 20px;
        }

        @media print {
            body {
                background: none;
                padding: 0;
            }

            .receipt {
                box-shadow: none;
                border-radius: 0;
            }
        }
    </style>

    <div class="receipt">

        <div class="header">
            <h2>WARKOP CAK-IMIN</h2>
            <p>Nota Pembayaran</p>
        </div>

        <div class="divider"></div>

        <div class="info">
            <div><strong>Kode</strong> : {{ $transaksi->kode_pesanan }}</div>
            <div><strong>Nama</strong> : {{ $transaksi->nama_pemesan }}</div>
            <div><strong>Tanggal</strong> :
                {{ $transaksi->created_at->format('d-m-Y H:i') }}</div>
            <div><strong>Metode</strong> :
                {{ strtoupper($transaksi->metode_pembayaran) }}</div>
        </div>

        <div class="divider"></div>

        <table>
            <thead>
                <tr>
                    <th>Menu</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Sub</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->keranjang->item as $item)
                    <tr>
                        <td>{{ $item->produk->nama_produk }}</td>
                        <td class="text-center">{{ $item->jumlah }}</td>
                        <td class="text-right">
                            {{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach

                <tr class="total-row">
                    <td colspan="2">TOTAL</td>
                    <td class="text-right">
                        {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Terima kasih sudah berkunjung ke WARKOP CAK-IMIN </p>
            <p>~ Selamat Menikmati ~</p>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>


</body>

</html>
