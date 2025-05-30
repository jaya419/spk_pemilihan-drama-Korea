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
            <h4 class="mb-4 fw-bold text-primary"><i class="bi bi-pencil-square me-2"></i> Edit Data Drama</h4>

            <form action="{{ route('drama.update', $drama->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nama_drama" class="form-label fw-semibold text-dark d-flex align-items-center">
                        <i class="bi bi-film me-2 text-primary"></i> Nama Drama <span class="text-danger ms-1">*</span>
                    </label>
                    <input type="text" name="nama_drama" id="nama_drama" class="form-control form-control-lg rounded-pill @error('nama_drama') is-invalid @enderror" value="{{ old('nama_drama', $drama->nama_drama) }}" placeholder="Masukkan judul drama" required>
                    @error('nama_drama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-semibold text-dark d-flex align-items-center">
                        <i class="bi bi-card-text me-2 text-primary"></i> Deskripsi <span class="text-danger ms-1">*</span>
                    </label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control rounded-3 @error('deskripsi') is-invalid @enderror" rows="4" placeholder="Masukkan deskripsi singkat tentang drama" required>{{ old('deskripsi', $drama->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tahun" class="form-label fw-semibold text-dark d-flex align-items-center">
                        <i class="bi bi-calendar-check me-2 text-primary"></i> Tahun <span class="text-danger ms-1">*</span>
                    </label>
                    <input type="number" name="tahun" id="tahun" class="form-control rounded-pill @error('tahun') is-invalid @enderror" value="{{ old('tahun', $drama->tahun) }}" placeholder="Contoh: 2024" required min="1900" max="{{ date('Y') }}">
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="poster" class="form-label fw-semibold text-dark d-flex align-items-center mb-3">
                        <i class="bi bi-image me-2 text-primary"></i> Poster (Opsional)
                    </label>
                    <input type="file" name="poster" id="poster" class="form-control rounded-pill @error('poster') is-invalid @enderror" accept="image/*" onchange="previewPoster(event)">
                    <small class="form-text text-muted mt-2 ms-2">Ukuran file maksimal 2MB. Format: JPG, PNG. (Biarkan kosong jika tidak ingin mengubah poster)</small>
                    @error('poster')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    {{-- Current Poster Display --}}
                    <div class="mt-3">
                        @if($drama->poster)
                            <p class="form-label text-muted mb-2">Poster Saat Ini:</p>
                            <img src="{{ asset('storage/' . $drama->poster) }}" alt="Poster {{ $drama->nama_drama }}" class="img-fluid rounded shadow-sm poster-preview-style">
                        @else
                            <p class="form-label text-muted mb-2">Belum Ada Poster Saat Ini.</p>
                            <div class="bg-light text-muted d-flex flex-column align-items-center justify-content-center rounded-3 poster-placeholder-style">
                                <i class="bi bi-image fs-2 mb-1"></i>
                                <small>Tidak ada poster</small>
                            </div>
                        @endif
                    </div>

                    {{-- New Poster Preview (initially hidden) --}}
                    <div class="mt-3 d-none" id="new-poster-preview-container">
                        <p class="form-label text-muted mb-2">Preview Poster Baru:</p>
                        <img id="poster-preview" src="#" alt="Preview Poster Baru" class="img-fluid rounded shadow-sm poster-preview-style">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-5">
                    <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center px-4">
                        <i class="bi bi-save me-2"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('drama.index') }}" class="btn btn-secondary btn-sm d-flex align-items-center px-4">
                        <i class="bi bi-x-circle me-2"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewPoster(event) {
        const input = event.target;
        const newPreview = document.getElementById('poster-preview');
        const newPreviewContainer = document.getElementById('new-poster-preview-container');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                newPreview.src = e.target.result;
                newPreviewContainer.classList.remove('d-none'); // Show the new preview
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            // If no file is selected (e.g., user clears selection), hide the new preview container
            newPreviewContainer.classList.add('d-none');
            newPreview.src = '#'; // Clear the image source
        }
    }
</script>

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

    /* Styles for poster previews (consistent with create page's preview) */
    .poster-preview-style {
        max-width: 250px; /* Adjust as needed */
        height: auto; /* Maintain aspect ratio */
        border: 3px solid #007bff;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
    }

    .poster-placeholder-style {
        width: 250px;
        height: 150px; /* Example height for placeholder */
        background-color: #e2f0ff;
        color: #007bff;
        border: 2px dashed #007bff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 0.75rem;
    }
</style>
@endsection