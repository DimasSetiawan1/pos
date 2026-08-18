<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blok Barat Coffee — Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            /* Background image with a dark overlay */
            background: linear-gradient(rgba(26, 14, 5, 0.75), rgba(26, 14, 5, 0.75)), 
                        url('https://images.unsplash.com/photo-1497935586351-b67a49e012bf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
            padding: 40px;
            transition: transform 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
        }

        .brand-icon {
            font-size: 3.5rem;
            text-align: center;
            margin-bottom: 10px;
            display: block;
            text-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .brand-title {
            text-align: center;
            font-weight: 800;
            color: #3d1f0d;
            letter-spacing: 1.5px;
            margin-bottom: 5px;
            font-size: 1.5rem;
        }

        .brand-subtitle {
            text-align: center;
            color: #888;
            font-size: 0.85rem;
            margin-bottom: 40px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .form-label {
            font-weight: 600;
            color: #3d1f0d;
            font-size: 0.9rem;
        }

        .form-control {
            background: #f4f0eb;
            border: 2px solid transparent;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s;
            color: #1a0e05;
        }

        .form-control:focus {
            background: white;
            border-color: #a07850;
            box-shadow: 0 0 0 0.2rem rgba(160, 120, 80, 0.2);
            outline: none;
        }

        .input-group-text {
            background: #f4f0eb;
            border: 2px solid transparent;
            border-right: none;
            color: #a07850;
            border-radius: 12px 0 0 12px;
        }

        .form-control.with-icon {
            border-left: none;
            border-radius: 0 12px 12px 0;
            padding-left: 0;
        }

        .btn-coffee {
            background: linear-gradient(135deg, #6F4E37 0%, #3d1f0d 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            margin-top: 20px;
            box-shadow: 0 8px 20px rgba(111, 78, 55, 0.3);
        }

        .btn-coffee:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(111, 78, 55, 0.4);
            color: white;
        }

        .btn-coffee:active {
            transform: translateY(1px);
        }

        .alert-danger {
            background-color: #fdf2f2;
            color: #d9534f;
            border: 1px solid #f9d6d5;
            border-radius: 12px;
            font-size: 0.9rem;
            padding: 12px;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="login-card">
        <span class="brand-icon">☕</span>
        <h2 class="brand-title">BLOK BARAT</h2>
        <div class="brand-subtitle">Coffee POS System</div>

        @if(session('error'))
        <div class="alert alert-danger d-flex align-items-center">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}
        </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" class="form-control with-icon" placeholder="Masukkan username" required autocomplete="off">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control with-icon" placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-coffee w-100">
                MASUK SEKARANG <i class="bi bi-arrow-right ms-2"></i>
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>