<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            /* Latar belakang biliar terpusat dan menutupi seluruh halaman */
            background: url('foto/billiard.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center; /* Memusatkan secara vertikal */
            justify-content: center; /* Memusatkan secara horizontal */
        }

        .overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Overlay untuk kontras teks */
            z-index: 1;
        }

        .login-card {
            position: relative;
            z-index: 2; /* Pastikan kartu di atas overlay */
            background-color: rgba(255, 255, 255, 0.98); /* Sedikit transparan untuk efek modern */
            padding: 2.25rem; /* Mengurangi padding */
            border-radius: 1rem; /* Mengurangi border-radius */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.18); /* Mengurangi bayangan */
            width: 100%;
            max-width: 380px; /* Mengurangi lebar maksimum */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .login-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.22); /* Mengurangi bayangan saat hover */
        }

        .login-card h3 {
            font-size: 1.6rem; /* Mengurangi ukuran font judul */
        }

        .login-card p {
            font-size: 0.875rem; /* Mengurangi ukuran font paragraf */
        }

        .form-label {
            font-size: 0.9rem; /* Mengurangi ukuran font label */
        }

        .form-control {
            border-radius: 0.5rem; /* Mengurangi border-radius */
            padding: 0.65rem 0.9rem; /* Mengurangi padding */
            font-size: 0.9rem; /* Mengurangi ukuran font input */
            border: 1px solid #ced4da;
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.15rem rgba(74, 144, 226, 0.15); /* Mengurangi ukuran bayangan fokus */
            border-color: #4a90e2;
        }

        .btn-primary {
            background-color: #4a90e2;
            border: none;
            border-radius: 0.5rem; /* Mengurangi border-radius */
            padding: 0.65rem 1.15rem; /* Mengurangi padding */
            font-weight: 600;
            font-size: 0.95rem; /* Mengurangi ukuran font tombol */
            transition: background-color 0.2s ease-in-out, transform 0.1s ease-in-out, box-shadow 0.2s ease-in-out;
            letter-spacing: 0.1px; /* Mengurangi letter spacing */
        }

        .btn-primary:hover {
            background-color: #357ABD;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Mengurangi bayangan saat hover */
        }

        .btn-primary:active {
            transform: translateY(0);
            box-shadow: none;
        }

        .text-link {
            font-size: 0.85rem; /* Mengurangi ukuran font teks link */
        }

        .text-link a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease-in-out, text-decoration 0.2s ease-in-out;
        }

        .text-link a:hover {
            color: #357ABD;
            text-decoration: underline;
        }

        .alert {
            border-radius: 0.5rem; /* Mengurangi border-radius */
            font-size: 0.8rem; /* Mengurangi ukuran font */
            padding: 0.5rem 0.9rem; /* Mengurangi padding */
            margin-bottom: 1rem; /* Mengurangi margin bawah */
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 1.75rem 1.25rem; /* Mengurangi padding lebih lanjut untuk layar kecil */
                border-radius: 0.65rem; /* Mengurangi border-radius */
                box-shadow: none;
            }
            body {
                padding: 0.5rem; /* Menambahkan padding ke body pada layar kecil */
            }
            .login-card h3 {
                font-size: 1.4rem; /* Sesuaikan ukuran font judul untuk layar kecil */
            }
            .login-card p {
                font-size: 0.8rem; /* Sesuaikan ukuran font paragraf untuk layar kecil */
            }
            .form-label, .form-control, .btn-primary, .text-link {
                font-size: 0.85rem; /* Sesuaikan ukuran font untuk elemen form pada layar kecil */
            }
        }
    </style>
</head>
<body>

    <div class="overlay"></div>

    <div class="login-card">
        <h3 class="mb-3 text-center fw-bold" style="color: #4a90e2;">Selamat Datang Kembali!</h3>
        <p class="text-muted text-center mb-4">Silakan login terlebih dahulu untuk masuk ke sistem.</p>

        @if (session('status'))
            <div class="alert alert-success text-center">{{ session('status') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        <form action="{{ route('loginproccess') }}" method="POST" class="mt-3">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}" placeholder="Masukkan email Anda">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Masukkan kata sandi Anda">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-lg">Masuk</button>
            </div>
        </form>

        <div class="text-center mt-4 text-link">
            Belum punya akun? <a href="{{ route('auth.register') }}">Daftar Sekarang</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>