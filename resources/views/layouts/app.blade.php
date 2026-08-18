<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blok Barat Coffee') — POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --coffee-dark: #1a0e05;
            --coffee-brown: #3d1f0d;
            --coffee-medium: #6F4E37;
            --coffee-light: #a07850;
            --coffee-cream: #f5ede3;
            --coffee-accent: #d4a853;
            --sidebar-width: 260px;
        }
        * { font-family: 'Inter', sans-serif; }
        body { background: #f4f0eb; min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--coffee-dark) 0%, var(--coffee-brown) 100%);
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(0,0,0,0.3);
        }
        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }
        .sidebar-brand .brand-icon { font-size: 2rem; }
        .sidebar-brand h5 {
            color: var(--coffee-accent);
            font-weight: 700;
            font-size: 1rem;
            margin: 8px 0 2px;
            letter-spacing: 1px;
        }
        .sidebar-brand small { color: rgba(255,255,255,0.4); font-size: 0.7rem; }
        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
        .nav-section-title {
            color: rgba(255,255,255,0.3);
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 16px 12px 8px;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.65);
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 2px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(3px);
        }
        .sidebar .nav-link.active {
            background: var(--coffee-accent);
            color: var(--coffee-dark);
            font-weight: 600;
        }
        .sidebar .nav-link i { font-size: 1rem; width: 18px; }
        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-footer .user-info {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px;
            background: rgba(255,255,255,0.05);
            border-radius: 10px;
            margin-bottom: 8px;
        }
        .sidebar-footer .user-avatar {
            width: 36px; height: 36px;
            background: var(--coffee-accent);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: var(--coffee-dark); font-size: 0.8rem;
        }
        .sidebar-footer .user-name { color: white; font-size: 0.8rem; font-weight: 600; }
        .sidebar-footer .user-role { color: rgba(255,255,255,0.4); font-size: 0.7rem; }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }
        .topbar {
            background: white;
            padding: 14px 28px;
            border-bottom: 1px solid #e8ddd5;
            display: flex;
            align-items: center;
            justify-content: between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            position: sticky; top: 0; z-index: 100;
        }
        .topbar-title { font-weight: 700; font-size: 1.1rem; color: var(--coffee-dark); flex: 1; }
        .topbar-time { color: #888; font-size: 0.8rem; }
        .page-content { padding: 28px; }

        /* Cards */
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            border: none;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.1); }
        .stat-card .stat-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; margin-bottom: 16px;
        }
        .stat-card .stat-value { font-size: 1.8rem; font-weight: 700; color: var(--coffee-dark); }
        .stat-card .stat-label { color: #888; font-size: 0.8rem; font-weight: 500; margin-top: 4px; }

        /* Table */
        .content-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .content-card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f0e8e0;
            display: flex; align-items: center; justify-content: space-between;
        }
        .content-card-header h6 { font-weight: 700; color: var(--coffee-dark); margin: 0; }
        .table { margin: 0; }
        .table thead th {
            background: #faf6f2;
            color: #666;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            padding: 12px 16px;
        }
        .table tbody td { padding: 12px 16px; vertical-align: middle; border-color: #f5ede3; font-size: 0.875rem; }
        .table tbody tr:hover { background: #faf6f2; }

        /* Buttons */
        .btn-coffee { background: var(--coffee-medium); color: white; border: none; font-weight: 600; }
        .btn-coffee:hover { background: var(--coffee-brown); color: white; }
        .btn-coffee-outline { border: 2px solid var(--coffee-medium); color: var(--coffee-medium); font-weight: 600; }
        .btn-coffee-outline:hover { background: var(--coffee-medium); color: white; }

        /* Badge */
        .badge-coffee { background: var(--coffee-cream); color: var(--coffee-medium); font-weight: 600; }

        /* Form */
        .form-control:focus, .form-select:focus {
            border-color: var(--coffee-medium);
            box-shadow: 0 0 0 0.2rem rgba(111,78,55,0.15);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">☕</div>
        <h5>BLOK BARAT</h5>
        <small>COFFEE POS SYSTEM</small>
    </div>

    <div class="sidebar-nav">
        @if(Auth::user()->role == 'admin')
        <div class="nav-section-title">Menu Admin</div>
        <a href="/dashboard-admin" class="nav-link {{ request()->is('dashboard-admin') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="/admin/bahan-baku" class="nav-link {{ request()->is('admin/bahan-baku*') ? 'active' : '' }}">
            <i class="bi bi-basket2"></i> Bahan Baku
        </a>
        <a href="/admin/suplier-barang-masuk" class="nav-link {{ request()->is('admin/suplier-barang-masuk*') ? 'active' : '' }}">
            <i class="bi bi-box-arrow-in-down"></i> Supplier & Barang Masuk
        </a>
        <div class="nav-section-title">Laporan</div>
        <a href="/admin/transaksi" class="nav-link {{ request()->is('admin/transaksi*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i> Laporan Transaksi
        </a>
        <div class="nav-section-title">Transaksi</div>
        <a href="/kasir/transaksi" class="nav-link {{ request()->is('kasir/transaksi*') ? 'active' : '' }}">
            <i class="bi bi-cart3"></i> Kasir POS (Input Transaksi)
        </a>
        @endif

        @if(Auth::user()->role == 'kasir')
        <div class="nav-section-title">Menu Kasir</div>
        <a href="/dashboard-kasir" class="nav-link {{ request()->is('dashboard-kasir') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="/kasir/transaksi" class="nav-link {{ request()->is('kasir/transaksi*') ? 'active' : '' }}">
            <i class="bi bi-cart3"></i> Transaksi Baru
        </a>
        @endif
    </div>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
            <div>
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">{{ ucfirst(Auth::user()->role) }}</div>
            </div>
        </div>
        <a href="/logout" class="nav-link text-danger" style="justify-content: center;">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="topbar">
        <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
        <div class="topbar-time" id="clock"></div>
    </div>
    <div class="page-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 border-0" role="alert"
                 style="background:#d4edda; color:#155724;">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>
    function updateClock() {
        const now = new Date();
        document.getElementById('clock').textContent = now.toLocaleTimeString('id-ID', {hour:'2-digit',minute:'2-digit',second:'2-digit'}) + ' — ' + now.toLocaleDateString('id-ID', {weekday:'long', day:'numeric', month:'long', year:'numeric'});
    }
    updateClock(); setInterval(updateClock, 1000);
</script>
@stack('scripts')
</body>
</html>
