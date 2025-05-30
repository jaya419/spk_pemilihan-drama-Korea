@extends('layouts.app')

@section('content')
<div class="container py-4">
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <h5 class="alert-heading"><i class="bi bi-exclamation-triangle-fill me-2"></i> Terjadi Kesalahan!</h5>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('drama.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="nama_drama" class="form-label fw-semibold text-dark d-flex align-items-center">
                        <i class="bi bi-film me-2 text-primary"></i> Nama Drama <span class="text-danger ms-1">*</span>
                    </label>
                    <input type="text" name="nama_drama" id="nama_drama" class="form-control form-control-lg rounded-pill @error('nama_drama') is-invalid @enderror" value="{{ old('nama_drama') }}" placeholder="Masukkan judul drama" required>
                    @error('nama_drama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-semibold text-dark d-flex align-items-center">
                        <i class="bi bi-card-text me-2 text-primary"></i> Deskripsi <span class="text-danger ms-1">*</span>
                    </label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control rounded-3 @error('deskripsi') is-invalid @enderror" rows="4" placeholder="Masukkan deskripsi singkat tentang drama" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tahun" class="form-label fw-semibold text-dark d-flex align-items-center">
                        <i class="bi bi-calendar-check me-2 text-primary"></i> Tahun <span class="text-danger ms-1">*</span>
                    </label>
                    <input type="number" name="tahun" id="tahun" class="form-control rounded-pill @error('tahun') is-invalid @enderror" value="{{ old('tahun') }}" placeholder="Contoh: 2024" required min="1900" max="{{ date('Y') }}">
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="poster" class="form-label fw-semibold text-dark d-flex align-items-center mb-3">
                        <i class="bi bi-image me-2 text-primary"></i> Poster (Opsional)
                    </label>
                    <input type="file" name="poster" id="poster" class="form-control rounded-pill @error('poster') is-invalid @enderror" accept="image/*" onchange="previewPoster(event)">
                    <small class="form-text text-muted mt-2 ms-2">Ukuran file maksimal 2MB. Format: JPG, PNG.</small>
                    @error('poster')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <!-- Preview Poster -->
                    <div class="mt-3">
                        <img id="poster-preview" src="#" alt="Preview Poster" class="img-fluid rounded shadow-sm d-none" style="max-height: 300px;">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-5">
                    <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center px-4">
                        <i class="bi bi-save me-2"></i> Simpan
                    </button>
                    <a href="{{ route('drama.index') }}" class="btn btn-secondary btn-sm d-flex align-items-center px-4">
                        <i class="bi bi-x-circle me-2"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script for image preview -->
<script>
    function previewPoster(event) {
        const input = event.target;
        const preview = document.getElementById('poster-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<!-- Custom Styles -->
<style>
    .form-label {
        font-size: 1rem;
        margin-bottom: 0.75rem;
    }

    .form-control-lg {
        padding: 0.75rem 1.25rem;
        font-size: 1.1rem;
    }

    .form-control.rounded-pill {
        border-radius: 2rem !important;
    }

    .form-control.rounded-3 {
        border-radius: 0.75rem !important;
    }

    .alert.alert-danger {
        border-left: 5px solid #dc3545;
        background-color: #f8d7da;
        color: #721c24;
    }

    .alert.alert-danger .alert-heading {
        color: #721c24;
    }

    .alert.alert-danger ul {
        margin-left: 1rem;
        list-style-type: disc;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        font-size: 0.875em;
        color: #dc3545;
        margin-top: 0.25rem;
        margin-left: 1rem;
    }
</style>
@endsection
