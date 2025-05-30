<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            /* Latar belakang yang sama dengan halaman login (gambar biliar) */
            background: url('foto/billiard.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex; /* Untuk memusatkan konten secara vertikal dan horizontal */
            align-items: center;
            justify-content: center;
        }

        .overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Overlay untuk kontras teks */
            z-index: 1;
        }

        /* Mengganti .register-card agar sesuai dengan .login-card */
        .register-card {
            position: relative; /* Penting agar di atas overlay */
            z-index: 2;
            background-color: rgba(255, 255, 255, 0.98); /* Sedikit transparan */
            padding: 2.25rem; /* Mengurangi padding */
            border-radius: 1rem; /* Mengurangi border-radius */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.18); /* Mengurangi bayangan */
            width: 100%;
            max-width: 380px; /* Mengurangi lebar maksimum */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .register-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.22); /* Mengurangi bayangan saat hover */
        }

        .register-title {
            font-size: 1.6rem; /* Mengurangi ukuran font judul */
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #4a90e2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-title i {
            font-size: 1.8rem; /* Mengurangi ukuran ikon */
            margin-right: 0.6rem; /* Mengurangi margin kanan ikon */
        }

        .form-label {
            font-weight: 500;
            color: #343a40;
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
            border-color: #4a90e2;
            box-shadow: 0 0 0 0.15rem rgba(74, 144, 226, 0.15); /* Mengurangi ukuran bayangan fokus */
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

        .text-muted {
            color: #6c757d !important;
            font-size: 0.875rem; /* Mengurangi ukuran font muted text */
        }

        /* Media queries untuk responsivitas disesuaikan */
        @media (max-width: 576px) { /* Mengubah breakpoint agar sesuai dengan login card */
            .register-card {
                padding: 1.75rem 1.25rem; /* Mengurangi padding lebih lanjut untuk layar kecil */
                border-radius: 0.65rem; /* Mengurangi border-radius */
                box-shadow: none;
                transform: none;
            }
            .register-card:hover {
                transform: none;
                box-shadow: none;
            }
            .register-title {
                font-size: 1.4rem; /* Sesuaikan ukuran font judul untuk layar kecil */
            }
            .register-title i {
                font-size: 1.6rem; /* Sesuaikan ukuran ikon untuk layar kecil */
            }
            .text-muted {
                font-size: 0.8rem; /* Sesuaikan ukuran font muted text untuk layar kecil */
            }
            .form-label, .form-control, .btn-primary, .text-link {
                font-size: 0.85rem; /* Sesuaikan ukuran font untuk elemen form pada layar kecil */
            }
            .btn-primary {
                padding: 0.6rem 1rem; /* Sesuaikan padding tombol untuk layar kecil */
            }
        }
    </style>
</head>
<body>

<div class="overlay"></div>

<div class="register-card">
    <div class="register-title">
        <i class="bi bi-person-plus-fill"></i>Buat Akun Baru
    </div>
    <p class="text-muted text-center mb-4">Silakan daftar untuk membuat akun baru.</p>

    <form action="{{ route('register.process') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" required placeholder="Masukkan nama lengkap Anda">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required placeholder="Masukkan email Anda">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Buat password Anda">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="Konfirmasi password Anda">
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary btn-lg">
                Daftar Sekarang
            </button>
        </div>

        <div class="text-center mt-4 text-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>