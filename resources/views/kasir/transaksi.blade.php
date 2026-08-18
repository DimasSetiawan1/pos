@extends('layouts.app')
@section('title', 'Transaksi Baru')
@section('page-title', 'Input Transaksi')

@push('styles')
<style>
    .product-card {
        background: white;
        border-radius: 14px;
        padding: 16px;
        border: 2px solid transparent;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        height: 100%;
        user-select: none;
    }
    .product-card:hover {
        border-color: var(--coffee-medium);
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(111,78,55,0.2);
    }
    .product-card:active { transform: scale(0.97); }
    .product-card .product-emoji { font-size: 2rem; margin-bottom: 8px; }
    .product-card .product-name { font-weight: 600; font-size: 0.9rem; color: var(--coffee-dark); }
    .product-card .product-price { color: var(--coffee-medium); font-weight: 700; font-size: 0.85rem; }
    .product-card .stok-badge { font-size: 0.7rem; }

    .cart-panel {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        position: sticky;
        top: 80px;
    }
    .cart-header {
        background: linear-gradient(135deg, var(--coffee-dark), var(--coffee-brown));
        color: white;
        padding: 18px 20px;
        border-radius: 16px 16px 0 0;
    }
    .cart-items { max-height: 300px; overflow-y: auto; }
    .cart-item {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 16px;
        border-bottom: 1px solid #f5ede3;
    }
    .cart-item-name { font-weight: 600; font-size: 0.85rem; flex: 1; }
    .cart-item-price { font-size: 0.8rem; color: #888; }
    .qty-btn { width: 26px; height: 26px; border-radius: 50%; border: 1px solid var(--coffee-medium);
               background: none; color: var(--coffee-medium); font-weight: 700; cursor: pointer;
               display: flex; align-items: center; justify-content: center; transition: all 0.15s; }
    .qty-btn:hover { background: var(--coffee-medium); color: white; }
    .cart-total { padding: 16px 20px; border-top: 2px solid #f0e8e0; }
    .total-amount { font-size: 1.6rem; font-weight: 800; color: var(--coffee-dark); }

    /* Payment Method Selector */
    .metode-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 20px; }
    .metode-card {
        border: 2px solid #e8ddd5;
        border-radius: 14px;
        padding: 16px 10px;
        cursor: pointer;
        text-align: center;
        transition: all 0.2s;
        background: white;
    }
    .metode-card:hover { border-color: var(--coffee-medium); background: #faf6f2; }
    .metode-card.selected {
        border-color: var(--coffee-medium);
        background: linear-gradient(135deg, #f5ede3, #ffe8d6);
        box-shadow: 0 4px 12px rgba(111,78,55,0.2);
    }
    .metode-card .metode-icon { font-size: 2rem; margin-bottom: 6px; }
    .metode-card .metode-label { font-weight: 700; font-size: 0.85rem; color: var(--coffee-dark); }
    .metode-card .metode-desc { font-size: 0.7rem; color: #888; margin-top: 2px; }
    .metode-card input[type="radio"] { display: none; }

    /* Cash input section */
    .cash-section { transition: all 0.3s; }

    /* Struk preview in modal */
    .struk-preview {
        background: #faf6f2;
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 16px;
        border: 1px dashed #d4b896;
    }
    .struk-row { display: flex; justify-content: space-between; font-size: 0.85rem; margin-bottom: 6px; }
    .struk-row.total { font-size: 1rem; font-weight: 800; border-top: 1px solid #d4b896; padding-top: 8px; margin-top: 4px; }
    .struk-row.kembali { color: #2e7d32; font-weight: 700; }
</style>
@endpush

@section('content')
<div class="row g-4">
    <!-- Produk Grid -->
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ul class="nav nav-pills" id="categoryTabs">
                <li class="nav-item">
                    <button class="nav-link fw-bold px-4 active" data-filter="minuman" style="border-radius: 20px;">🥤 Minuman</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link fw-bold px-4" data-filter="makanan" style="border-radius: 20px;">🍟 Makanan</button>
                </li>
            </ul>
            <div class="d-flex gap-2">
                <div style="width: 250px;">
                    <input type="text" id="searchProduk" class="form-control" placeholder="🔍 Cari produk..." style="border-radius: 20px;">
                </div>
                <button class="btn btn-coffee" data-bs-toggle="modal" data-bs-target="#modalTambahProduk" style="border-radius: 20px; font-weight: 600;">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Menu
                </button>
            </div>
        </div>
        
        <div class="row g-3" id="produkGrid">
            @foreach($produk as $p)
            @if($p->stok > 0)
            @php
                $kat = str_contains(strtolower($p->kategori), 'minuman') ? 'minuman' : 'makanan';
                $slug = Str::slug($p->nama_produk);
            @endphp
            <div class="col-6 col-lg-3 produk-item filter-{{ $kat }}" data-nama="{{ strtolower($p->nama_produk) }}" data-kategori="{{ $kat }}" style="{{ $kat == 'minuman' ? '' : 'display:none;' }}">
                <div class="product-card" onclick="tambahKeCart({{ $p->id }}, '{{ addslashes($p->nama_produk) }}', {{ $p->harga_jual }}, {{ $p->stok }})">
                    <div class="product-img-wrap mb-2 text-center">
                        <img src="/images/products/{{ $slug }}.jpg?v={{ time() }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($p->nama_produk) }}&background=6f4e37&color=fff&size=150'" class="img-fluid rounded-3 w-100" style="object-fit:cover; aspect-ratio:1/1; border: 1px solid #f0e8e0;" alt="{{ $p->nama_produk }}">
                    </div>
                    <div class="product-name" style="line-height: 1.2; height: 2.4em; overflow: hidden;">{{ $p->nama_produk }}</div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div class="product-price">Rp {{ number_format($p->harga_jual,0,',','.') }}</div>
                        <span class="badge bg-light text-muted border stok-badge">Sisa: {{ $p->stok }}</span>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

    <!-- Cart Panel -->
    <div class="col-md-4">
        <div class="cart-panel">
            <div class="cart-header">
                <h6 class="mb-0"><i class="bi bi-cart3 me-2"></i>Keranjang Belanja</h6>
            </div>

            <div class="cart-items" id="cartItems">
                <div class="text-center text-muted py-4" id="emptyCart">
                    <i class="bi bi-cart-x" style="font-size:2rem;opacity:0.3;"></i>
                    <p class="mt-2 small">Pilih produk untuk ditambahkan</p>
                </div>
            </div>

            <div class="cart-total">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted fw-semibold">TOTAL</span>
                    <div class="total-amount">Rp <span id="totalAmount">0</span></div>
                </div>
                <button class="btn btn-coffee w-100 py-2" onclick="bukaModalPembayaran()" id="btnProses" disabled>
                    <i class="bi bi-credit-card me-2"></i>Pilih Pembayaran
                </button>
                <button class="btn btn-outline-danger w-100 mt-2" onclick="clearCart()">
                    <i class="bi bi-trash me-1"></i>Kosongkan
                </button>
            </div>
        </div>
    </div>
</div>



<!-- ===================== MODAL PEMBAYARAN ===================== -->
<div class="modal fade" id="modalPembayaran" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:20px; overflow:hidden; border:none;">

            <!-- Header -->
            <div style="background: linear-gradient(135deg, #1a0e05, #3d1f0d); padding: 20px 24px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="text-white mb-1 fw-bold">☕ Pembayaran</h5>
                        <small class="text-warning" id="modalInvoiceLabel"></small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
            </div>

            <div class="modal-body p-4">

                <!-- Struk ringkas -->
                <div class="struk-preview" id="strukPreview">
                    <div id="strukItems"></div>
                    <div class="struk-row total">
                        <span>TOTAL BAYAR</span>
                        <span id="modalTotal" class="text-coffee fw-bold"></span>
                    </div>
                </div>

                <!-- Pilih Metode -->
                <p class="fw-bold mb-3" style="color: var(--coffee-dark);">
                    <i class="bi bi-wallet2 me-2"></i>Pilih Metode Pembayaran
                </p>
                <div class="metode-grid">
                    <label class="metode-card selected" id="card-cash" onclick="pilihMetode('cash')">
                        <input type="radio" name="metode" value="cash" checked>
                        <div class="metode-icon">💵</div>
                        <div class="metode-label">Cash</div>
                        <div class="metode-desc">Bayar tunai</div>
                    </label>
                    <label class="metode-card" id="card-qris" onclick="pilihMetode('qris')">
                        <input type="radio" name="metode" value="qris">
                        <div class="metode-icon">📱</div>
                        <div class="metode-label">QRIS</div>
                        <div class="metode-desc">Scan QR code</div>
                    </label>
                    <label class="metode-card" id="card-transfer" onclick="pilihMetode('transfer')">
                        <input type="radio" name="metode" value="transfer">
                        <div class="metode-icon">🏦</div>
                        <div class="metode-label">Transfer</div>
                        <div class="metode-desc">Transfer bank</div>
                    </label>
                    <label class="metode-card" id="card-kartu" onclick="pilihMetode('kartu')">
                        <input type="radio" name="metode" value="kartu">
                        <div class="metode-icon">💳</div>
                        <div class="metode-label">Kartu</div>
                        <div class="metode-desc">Debit / Kredit</div>
                    </label>
                </div>

                <!-- Section Cash -->
                <div class="cash-section" id="cashSection">
                    <hr>
                    <p class="fw-bold mb-2 small" style="color: var(--coffee-dark);">
                        <i class="bi bi-cash-coin me-1"></i>Nominal Uang Diterima
                    </p>

                    <!-- Quick amount buttons -->
                    <div class="d-flex flex-wrap gap-2 mb-3" id="quickAmounts"></div>

                    <div class="input-group mb-3">
                        <span class="input-group-text fw-bold">Rp</span>
                        <input type="number" id="uangBayar" class="form-control form-control-lg"
                               placeholder="0" oninput="hitungKembali()" style="font-weight:700; font-size:1.2rem;">
                    </div>

                    <div id="kembaliBox" class="p-3 rounded-3 mb-3" style="background:#e8f5e9; display:none;">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold" style="color:#2e7d32;">💰 Kembalian</span>
                            <span class="fw-bold fs-5" id="kembaliAmount" style="color:#2e7d32;">Rp 0</span>
                        </div>
                    </div>

                    <div id="kurangBox" class="p-3 rounded-3 mb-3" style="background:#ffebee; display:none;">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold text-danger">⚠️ Kurang</span>
                            <span class="fw-bold fs-5 text-danger" id="kurangAmount">Rp 0</span>
                        </div>
                    </div>
                </div>

                <!-- Section QRIS -->
                <div id="qrisSection" style="display:none;">
                    <hr>
                    <div class="text-center">
                        <p class="fw-bold mb-2" style="color:var(--coffee-dark);">📱 Scan QR Code untuk Membayar</p>
                        <div id="qrisBox" style="display:inline-block; padding:12px; background:white; border-radius:16px; box-shadow:0 4px 20px rgba(0,0,0,0.12); border: 3px solid var(--coffee-accent);"></div>
                        <div class="mt-3 p-2 rounded-3" style="background:#fff3cd;">
                            <div class="fw-bold" style="color:#856404; font-size:0.85rem;">⏱️ Total yang harus dibayar</div>
                            <div id="qrisTotalDisplay" class="fw-bold" style="font-size:1.4rem; color:var(--coffee-dark);"></div>
                        </div>
                        <p class="text-muted mt-2" style="font-size:0.75rem;">Gunakan aplikasi GoPay, OVO, Dana, ShopeePay,<br>atau aplikasi bank yang mendukung QRIS</p>
                    </div>
                </div>

                <!-- Section Transfer -->
                <div id="transferSection" style="display:none;">
                    <hr>
                    <p class="fw-bold mb-3" style="color:var(--coffee-dark);">🏦 Info Transfer Bank</p>
                    <div style="background:#f0f8ff; border-radius:14px; padding:16px; border:1px solid #b3d7ff;">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Bank</span>
                            <span class="fw-bold">BCA / Mandiri / BRI</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">No. Rekening</span>
                            <span class="fw-bold" id="noRekDisplay">1234567890</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Atas Nama</span>
                            <span class="fw-bold">Blok Barat Coffee</span>
                        </div>
                        <hr style="border-color:#b3d7ff;">
                        <div class="d-flex justify-content-between">
                            <span class="fw-semibold">Jumlah Transfer</span>
                            <span class="fw-bold text-primary" id="transferTotalDisplay" style="font-size:1.1rem;"></span>
                        </div>
                    </div>
                    <div class="mt-3 p-2 rounded-3 text-center" style="background:#e8f5e9;">
                        <small class="text-success fw-semibold">✅ Tunjukkan bukti transfer ke kasir sebelum konfirmasi</small>
                    </div>
                </div>

                <!-- Section Kartu -->
                <div id="kartuSection" style="display:none;">
                    <hr>
                    <p class="fw-bold mb-3" style="color:var(--coffee-dark);">💳 Pembayaran Kartu</p>
                    <div style="background:linear-gradient(135deg,#1a237e,#283593); border-radius:14px; padding:20px; color:white; position:relative; overflow:hidden;">
                        <div style="position:absolute;top:-20px;right:-20px;width:100px;height:100px;background:rgba(255,255,255,0.05);border-radius:50%;"></div>
                        <div style="position:absolute;bottom:-30px;left:-10px;width:120px;height:120px;background:rgba(255,255,255,0.03);border-radius:50%;"></div>
                        <div style="font-size:2rem; margin-bottom:12px;">💳</div>
                        <div style="font-size:0.75rem; opacity:0.7; margin-bottom:4px;">DEBIT / KREDIT</div>
                        <div class="fw-bold" style="font-size:1.3rem; letter-spacing:2px;">•••• •••• •••• ••••</div>
                        <div class="mt-3" style="font-size:0.8rem; opacity:0.8;">Blok Barat Coffee</div>
                    </div>
                    <div class="mt-3 p-3 rounded-3" style="background:#f3e5f5; border:1px solid #ce93d8;">
                        <div class="fw-bold mb-1" style="color:#6a1b9a;">📋 Langkah Pembayaran:</div>
                        <ol class="mb-0 ps-3" style="font-size:0.82rem; color:#6a1b9a;">
                            <li>Masukkan atau tap kartu pada mesin EDC</li>
                            <li>Masukkan PIN kartu (jika diminta)</li>
                            <li>Tunggu konfirmasi dari mesin EDC</li>
                            <li>Klik Konfirmasi setelah approved</li>
                        </ol>
                    </div>
                    <div class="mt-2 p-2 text-center" style="background:#e8f5e9; border-radius:8px;">
                        <span class="fw-bold text-success">Total: </span>
                        <span class="fw-bold text-success" id="kartuTotalDisplay" style="font-size:1.1rem;"></span>
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <div class="modal-footer px-4 pb-4 pt-0 border-0">
                <button type="button" class="btn btn-light w-100 mb-2" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Keranjang
                </button>
                <button type="button" class="btn btn-coffee w-100 py-3" id="btnKonfirmasi"
                        onclick="konfirmasiTransaksi()" style="font-size:1rem; font-weight:700; border-radius:12px;">
                    <i class="bi bi-check-circle me-2"></i>Konfirmasi Transaksi
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Form Submit -->
<form id="formTransaksi" action="/kasir/transaksi" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="bayar" id="inputBayar">
    <input type="hidden" name="items" id="inputItems">
    <input type="hidden" name="metode_pembayaran" id="inputMetode">
</form>

<!-- Modal Tambah Produk -->
<div class="modal fade" id="modalTambahProduk" tabindex="-1">
    <div class="modal-dialog"><div class="modal-content" style="border-radius:16px;">
        <div class="modal-header" style="border-bottom: 1px solid #f0e8e0; background: var(--coffee-cream); border-radius: 16px 16px 0 0;">
            <h5 class="modal-title fw-bold" style="color: var(--coffee-dark);"><i class="bi bi-plus-circle me-2"></i>Tambah Menu Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="/produk" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kode Produk</label>
                    <input type="text" name="kode_produk" class="form-control" placeholder="Contoh: MK001 / COF01" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Menu</label>
                    <input type="text" name="nama_produk" class="form-control" placeholder="Nama makanan / minuman" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="makanan">Makanan</option>
                        <option value="minuman_coffee">Minuman Coffee</option>
                        <option value="minuman_non_coffee">Minuman Non-Coffee</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Harga Beli</label>
                        <input type="number" name="harga_beli" class="form-control" placeholder="0" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Harga Jual</label>
                        <input type="number" name="harga_jual" class="form-control" placeholder="0" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Stok Awal</label>
                    <input type="number" name="stok" class="form-control" value="0" required>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #f0e8e0;">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-coffee"><i class="bi bi-check-lg me-1"></i> Simpan</button>
            </div>
        </form>
    </div></div>
</div>

@endsection

@push('scripts')
<script>
let cart = {};
let stokLimit = {};
let metodeAktif = 'cash';

// ─── Cart Functions ──────────────────────────────────────
function tambahKeCart(id, nama, harga, stok) {
    stokLimit[id] = stok;
    if (!cart[id]) cart[id] = { id, nama, harga, qty: 0 };
    if (cart[id].qty >= stokLimit[id]) {
        showToast('⚠️ Stok tidak mencukupi!', 'warning'); return;
    }
    cart[id].qty++;
    renderCart();
}

function kurangiCart(id) {
    if (!cart[id]) return;
    cart[id].qty--;
    if (cart[id].qty <= 0) delete cart[id];
    renderCart();
}

function renderCart() {
    const container = document.getElementById('cartItems');
    const btnProses  = document.getElementById('btnProses');
    const keys = Object.keys(cart);
    let total = 0, html = '';

    if (keys.length === 0) {
        container.innerHTML = '<div class="text-center text-muted py-4"><i class="bi bi-cart-x" style="font-size:2rem;opacity:0.3;"></i><p class="mt-2 small">Pilih produk untuk ditambahkan</p></div>';
        document.getElementById('totalAmount').textContent = '0';
        btnProses.disabled = true;
        return;
    }

    keys.forEach(id => {
        const item = cart[id];
        const sub = item.harga * item.qty;
        total += sub;
        html += `<div class="cart-item">
            <div style="flex:1">
                <div class="cart-item-name">${item.nama}</div>
                <div class="cart-item-price">Rp ${fmtRp(item.harga)} × ${item.qty} = <strong>Rp ${fmtRp(sub)}</strong></div>
            </div>
            <button class="qty-btn" onclick="kurangiCart(${id})">−</button>
            <span style="min-width:22px;text-align:center;font-weight:700;">${item.qty}</span>
            <button class="qty-btn" onclick="tambahKeCart(${id}, '${item.nama}', ${item.harga}, ${stokLimit[id]})">+</button>
        </div>`;
    });

    container.innerHTML = html;
    document.getElementById('totalAmount').textContent = fmtRp(total);
    btnProses.disabled = false;
}

function clearCart() {
    if (Object.keys(cart).length === 0) return;
    if (!confirm('Kosongkan keranjang?')) return;
    cart = {};
    renderCart();
}

function getTotal() {
    return Object.values(cart).reduce((s, i) => s + i.harga * i.qty, 0);
}

// ─── Modal Pembayaran ─────────────────────────────────────
function bukaModalPembayaran() {
    if (Object.keys(cart).length === 0) return;

    const total = getTotal();

    // Isi struk
    let strukHtml = '';
    Object.values(cart).forEach(i => {
        strukHtml += `<div class="struk-row">
            <span>${i.nama} ×${i.qty}</span>
            <span>Rp ${fmtRp(i.harga * i.qty)}</span>
        </div>`;
    });
    document.getElementById('strukItems').innerHTML = strukHtml;
    document.getElementById('modalTotal').textContent = 'Rp ' + fmtRp(total);

    // Quick amount buttons
    const quickAmounts = [total, Math.ceil(total/10000)*10000, Math.ceil(total/50000)*50000, Math.ceil(total/100000)*100000];
    const unique = [...new Set(quickAmounts)].filter(v => v >= total).slice(0, 4);
    document.getElementById('quickAmounts').innerHTML = unique.map(v =>
        `<button type="button" class="btn btn-sm btn-outline-secondary" onclick="setQuick(${v})">
            Rp ${fmtRp(v)}
        </button>`
    ).join('');

    // Reset
    document.getElementById('uangBayar').value = '';
    document.getElementById('kembaliBox').style.display = 'none';
    document.getElementById('kurangBox').style.display = 'none';
    pilihMetode('cash');

    const modal = new bootstrap.Modal(document.getElementById('modalPembayaran'));
    modal.show();
}

function pilihMetode(metode) {
    metodeAktif = metode;
    ['cash','qris','transfer','kartu'].forEach(m => {
        document.getElementById('card-' + m).classList.remove('selected');
    });
    document.getElementById('card-' + metode).classList.add('selected');

    // Sembunyikan semua section
    document.getElementById('cashSection').style.display    = 'none';
    document.getElementById('qrisSection').style.display    = 'none';
    document.getElementById('transferSection').style.display = 'none';
    document.getElementById('kartuSection').style.display   = 'none';

    const total = getTotal();

    if (metode === 'cash') {
        document.getElementById('cashSection').style.display = 'block';

    } else if (metode === 'qris') {
        document.getElementById('qrisSection').style.display = 'block';
        document.getElementById('qrisTotalDisplay').textContent = 'Rp ' + fmtRp(total);

        // Generate QR Code QRIS
        const qrisBox = document.getElementById('qrisBox');
        qrisBox.innerHTML = '';
        // String QRIS demo (format standar QRIS Indonesia)
        const qrisString = `00020101021226670016COM.NOBUBANK.WWW01189360050300000878930215ID20260000${String(total).padStart(10,'0')}303UMI51440014ID.CO.QRIS.WWW0215ID20260000000000030303UMI5204599553033605802ID5917Blok Barat Coffee6013Bekasi Selatan610515243540703A0163040B3D`;
        new QRCode(qrisBox, {
            text: qrisString,
            width: 200,
            height: 200,
            colorDark: '#1a0e05',
            colorLight: '#ffffff',
            correctLevel: QRCode.CorrectLevel.M
        });

    } else if (metode === 'transfer') {
        document.getElementById('transferSection').style.display = 'block';
        document.getElementById('transferTotalDisplay').textContent = 'Rp ' + fmtRp(total);

    } else if (metode === 'kartu') {
        document.getElementById('kartuSection').style.display = 'block';
        document.getElementById('kartuTotalDisplay').textContent = 'Rp ' + fmtRp(total);
    }
}

function setQuick(val) {
    document.getElementById('uangBayar').value = val;
    hitungKembali();
}

function hitungKembali() {
    const total  = getTotal();
    const bayar  = parseFloat(document.getElementById('uangBayar').value) || 0;
    const selisih = bayar - total;
    const boxKembali = document.getElementById('kembaliBox');
    const boxKurang  = document.getElementById('kurangBox');

    if (bayar <= 0) {
        boxKembali.style.display = 'none';
        boxKurang.style.display  = 'none';
        return;
    }
    if (selisih >= 0) {
        boxKembali.style.display = 'block';
        boxKurang.style.display  = 'none';
        document.getElementById('kembaliAmount').textContent = 'Rp ' + fmtRp(selisih);
    } else {
        boxKembali.style.display = 'none';
        boxKurang.style.display  = 'block';
        document.getElementById('kurangAmount').textContent  = 'Rp ' + fmtRp(Math.abs(selisih));
    }
}

function konfirmasiTransaksi() {
    const total = getTotal();
    let bayar = total;

    if (metodeAktif === 'cash') {
        bayar = parseFloat(document.getElementById('uangBayar').value) || 0;
        if (bayar <= 0) { showToast('⚠️ Masukkan nominal uang bayar!', 'warning'); return; }
        if (bayar < total) { showToast('❌ Uang bayar kurang dari total!', 'danger'); return; }
    }

    document.getElementById('inputBayar').value  = bayar;
    document.getElementById('inputItems').value  = JSON.stringify(Object.values(cart));
    document.getElementById('inputMetode').value = metodeAktif;
    document.getElementById('formTransaksi').submit();
}

// ─── Utils ───────────────────────────────────────────────
function fmtRp(n) {
    return parseInt(n).toLocaleString('id-ID');
}

function showToast(msg, type = 'info') {
    const t = document.createElement('div');
    t.className = `alert alert-${type} position-fixed bottom-0 end-0 m-3 shadow`;
    t.style.cssText = 'z-index:9999; min-width:220px; border-radius:12px; animation: fadeIn 0.3s;';
    t.textContent = msg;
    document.body.appendChild(t);
    setTimeout(() => t.remove(), 2500);
}

// Search produk
let currentCategory = 'minuman';

document.getElementById('searchProduk').addEventListener('input', filterProducts);

const tabBtns = document.querySelectorAll('#categoryTabs .nav-link');
tabBtns.forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        tabBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        currentCategory = this.dataset.filter;
        filterProducts();
    });
});

function filterProducts() {
    const q = document.getElementById('searchProduk').value.toLowerCase();
    document.querySelectorAll('.produk-item').forEach(el => {
        const matchSearch = el.dataset.nama.includes(q);
        const matchCategory = el.dataset.kategori === currentCategory;
        el.style.display = (matchSearch && matchCategory) ? '' : 'none';
    });
}

@if(session('print_id'))
    // Buka jendela popup cetak struk otomatis
    const printUrl = "{{ route('transaksi.print', session('print_id')) }}";
    window.open(printUrl, '_blank', 'width=350,height=600,menubar=no,status=no,toolbar=no');
@endif
</script>
@endpush
