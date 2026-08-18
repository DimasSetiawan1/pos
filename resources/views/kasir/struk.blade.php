<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran - {{ $transaksi->invoice }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
            background: #fff;
            margin: 0;
            padding: 10px;
            width: 300px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .fw-bold { font-weight: bold; }
        .header { margin-bottom: 15px; }
        .header h3 { margin: 0 0 5px 0; font-size: 16px; letter-spacing: 1px; }
        .header p { margin: 0; font-size: 10px; color: #555; }
        .info-table, .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .info-table td { padding: 2px 0; font-size: 11px; }
        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        .items-table td { padding: 4px 0; vertical-align: top; }
        .items-table tr.item-row td { font-size: 11px; }
        .totals-table {
            width: 100%;
            margin-top: 10px;
        }
        .totals-table td { padding: 3px 0; font-size: 11px; }
        .totals-table tr.grand-total td { font-size: 13px; font-weight: bold; }
        .footer {
            margin-top: 20px;
            font-size: 10px;
        }
        .no-print-btn {
            background: #6F4E37;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-family: sans-serif;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
        }
        .no-print-btn:hover { background: #3d1f0d; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; margin: 0; width: 100%; }
        }
    </style>
</head>
<body>

    <!-- Tombol Cetak Manual (Hanya muncul di layar, disembunyikan saat cetak) -->
    <div class="no-print">
        <button class="no-print-btn" onclick="window.print()"><i class="bi bi-printer"></i> CETAK STRUK</button>
    </div>

    <!-- Header Toko -->
    <div class="text-center header">
        <h3>☕ BLOK BARAT</h3>
        <p>Blok Barat Coffee & Eatery</p>
        <p>Jl. Raya Blok Barat, Kec. Bekasi Selatan</p>
        <p>Telp: 0812-3456-7890</p>
    </div>

    <div class="divider"></div>

    <!-- Info Transaksi -->
    <table class="info-table">
        <tr>
            <td>No. Invoice:</td>
            <td class="text-right fw-bold">{{ $transaksi->invoice }}</td>
        </tr>
        <tr>
            <td>Tanggal:</td>
            <td class="text-right">{{ $transaksi->created_at->format('d/m/Y H:i:s') }}</td>
        </tr>
        <tr>
            <td>Kasir:</td>
            <td class="text-right">{{ $transaksi->kasir->name ?? 'Kasir' }}</td>
        </tr>
        <tr>
            <td>Pembayaran:</td>
            <td class="text-right fw-bold">{{ strtoupper($transaksi->metode_pembayaran) }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    <!-- Daftar Item Belanja -->
    <table class="items-table">
        @foreach($transaksi->details as $detail)
        <tr class="item-row">
            <td colspan="2">
                {{ $detail->product->nama_produk ?? 'Produk Terhapus' }}
            </td>
        </tr>
        <tr class="item-row">
            <td style="padding-left: 10px; color: #555;">
                {{ $detail->qty }} x Rp {{ number_format($detail->harga, 0, ',', '.') }}
            </td>
            <td class="text-right">
                Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
            </td>
        </tr>
        @endforeach
    </table>

    <div class="divider"></div>

    <!-- Ringkasan Total -->
    <table class="totals-table">
        <tr>
            <td>Subtotal:</td>
            <td class="text-right">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
        </tr>
        <tr class="grand-total">
            <td>TOTAL:</td>
            <td class="text-right">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Bayar:</td>
            <td class="text-right">Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</td>
        </tr>
        <tr class="fw-bold" style="color: #2e7d32;">
            <td>Kembalian:</td>
            <td class="text-right">Rp {{ number_format($transaksi->kembali, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    <!-- Footer Struk -->
    <div class="text-center footer">
        <p class="fw-bold">TERIMA KASIH</p>
        <p>Atas Kunjungan Anda</p>
        <p>Silakan datang kembali! ☕</p>
    </div>

    <!-- Script auto-print dan menutup jendela setelah cetak (jika dibuka di popup window) -->
    <script>
        window.onload = function() {
            window.print();
            // Opsional: Tutup jendela otomatis setelah cetak selesai (hanya berfungsi jika dibuka via JS window.open)
            window.onafterprint = function() {
                window.close();
            }
        }
    </script>
</body>
</html>
