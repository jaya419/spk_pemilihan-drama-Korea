@extends('layouts.app')

@section('content')
<div class="container py-5">    
    {{-- Error Messages --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
            <h5 class="alert-heading fw-bold d-flex align-items-center mb-2">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Terjadi Kesalahan Input!
            </h5>
            <ul class="mb-0 ps-3"> {{-- Add ps-3 for left padding --}}
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Form Card --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-lg-5 p-4"> {{-- More padding for larger screens --}}
            <form action="{{ route('genre.update', $genre->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4"> {{-- Increased margin-bottom for form groups --}}
                    <label for="nama_genre" class="form-label fw-bold text-dark">Nama Kriteria</label>
                    <input type="text" name="nama_genre" id="nama_genre"
                           class="form-control form-control-lg @error('nama_genre') is-invalid @enderror"
                           value="{{ old('nama_genre', $genre->nama_genre) }}"
                           placeholder="Masukkan nama kriteria, misal: Akting, Plot, OST">
                    @error('nama_genre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="bobot" class="form-label fw-bold text-dark">Bobot Kriteria</label>
                    <input type="number" name="bobot" id="bobot" step="0.01"
                           class="form-control form-control-lg @error('bobot') is-invalid @enderror"
                           value="{{ old('bobot', $genre->bobot) }}"
                           placeholder="Masukkan bobot (misal: 0.25 untuk 25%)">
                    @error('bobot')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tipe" class="form-label fw-bold text-dark">Tipe Kriteria</label>
                    <select name="tipe" id="tipe"
                            class="form-select form-select-lg @error('tipe') is-invalid @enderror">
                        <option value="benefit" {{ old('tipe', $genre->tipe) == 'benefit' ? 'selected' : '' }}>Benefit (Semakin tinggi, semakin baik)</option>
                        <option value="cost" {{ old('tipe', $genre->tipe) == 'cost' ? 'selected' : '' }}>Cost (Semakin rendah, semakin baik)</option>
                    </select>
                    @error('tipe')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4"> {{-- Use gap-3 for spacing --}}
                    <button type="submit" class="btn btn-primary btn-sm shadow-sm rounded-pill px-5">
                        <i class="bi bi-save me-2"></i>Update Kriteria
                    </button>
                    <a href="{{ route('genre.index') }}" class="btn btn-secondary btn-sm rounded-pill px-5">
                        <i class="bi bi-x-circle me-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* General container padding */
    .container {
        max-width: 800px; /* Limit container width for better form readability */
    }

    /* Page Header */
    h2 .bi {
        color: #6c757d; /* Muted icon color for header */
    }

    /* Error Alert Styling */
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }
    .alert-danger .alert-heading {
        color: #721c24;
    }
    .alert-danger .bi {
        font-size: 1.5rem; /* Larger icon for warning */
    }
    .alert ul {
        list-style-type: disc; /* Ensure bullet points for list */
    }

    /* Card holding the form */
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.12) !important;
    }

    /* Form control styling */
    .form-control-lg, .form-select-lg {
        padding: 0.75rem 1.25rem; /* Larger padding for input fields */
        font-size: 1.1rem; /* Slightly larger font size */
        border-radius: 0.75rem; /* More rounded corners */
        border: 1px solid #ced4da;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .form-control-lg:focus, .form-select-lg:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        outline: 0;
    }

    /* Invalid feedback styling */
    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + 0.75rem); /* Space for validation icon */
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.3rem) center;
        background-size: calc(0.75em + 0.6rem) calc(0.75em + 0.6rem);
    }
    .invalid-feedback {
        font-size: 0.875rem;
        color: #dc3545;
        margin-top: 0.25rem;
    }

    /* Button styling */
    .btn-lg {
        font-size: 1.1rem;
        padding: 0.75rem 2rem;
        border-radius: 2rem; /* More rounded pills */
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 123, 255, 0.25) !important;
    }
    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(108, 117, 125, 0.25) !important;
    }
    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
    }
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }
</style>
@endpush