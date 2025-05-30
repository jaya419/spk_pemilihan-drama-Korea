@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center fw-bold text-primary">Daftar Drama</h1>

    <div class="row mb-5 justify-content-center">
        <div class="col-md-7 col-lg-6">
            <form method="GET" action="{{ route('drama.index') }}" class="input-group shadow-sm rounded-pill overflow-hidden">
                <input 
                    type="text" 
                    name="q" 
                    value="{{ request('q') }}" 
                    placeholder="Cari berdasarkan nama, deskripsi, dan tahun" 
                    class="form-control border-0 px-4" 
                    aria-label="Cari Drama"
                    autocomplete="off"
                    style="height: 50px;"
                >
                <button class="btn btn-primary px-4" type="submit" style="border-radius: 0 50px 50px 0;">
                    <i class="bi bi-search fs-5"></i>
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($dramas->isEmpty())
        <div class="alert alert-info text-center py-5 shadow-sm rounded">
            <i class="bi bi-info-circle-fill me-2 fs-3"></i>
            Belum ada daftar drama. Silakan tambahkan data terlebih dahulu!
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($dramas as $drama)
            <div class="col">
                <div class="card h-100 shadow rounded-4 border-0 hover-shadow">
                    <div class="row g-0 h-100">
                        <div class="col-md-4 d-flex align-items-center justify-content-center p-3 bg-light rounded-start">
                            @if($drama->poster)
                                <img src="{{ asset($drama->poster) }}" alt="{{ $drama->nama_drama }} Poster" class="employee-poster shadow-sm rounded">
                            @else
                                <div class="employee-poster-placeholder d-flex align-items-center justify-content-center rounded">
                                    <i class="bi bi-film fs-1 text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8 d-flex flex-column">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-primary fw-semibold mb-2">{{ $drama->nama_drama }}</h5>
                                <p class="card-text text-muted mb-3 flex-grow-1" style="font-size: 0.9rem;">
                                    {{ Str::limit($drama->deskripsi, 100, '...') }}
                                </p>
                                <p class="card-text mb-3">
                                    <small class="text-secondary">Tahun Rilis: <strong class="text-dark">{{ $drama->tahun }}</strong></small>
                                </p>
                                <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                                    <a href="{{ route('drama.edit', $drama->id) }}" class="btn btn-outline-warning btn-sm d-flex align-items-center gap-1 shadow-sm" title="Edit Drama">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('drama.destroy', $drama->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus drama ini? Aksi ini tidak dapat dibatalkan.');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1 shadow-sm" title="Hapus Drama">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    <hr class="my-5">

    <div class="d-flex justify-content-center gap-3">
        <a href="{{ route('drama.create') }}" class="btn btn-lg btn-primary d-flex align-items-center gap-2 shadow-sm" style="min-width: 180px;">
            <i class="bi bi-plus-circle"></i> Tambah Drama
        </a>
        <a href="{{ route('score.index') }}" class="btn btn-lg btn-outline-secondary d-flex align-items-center gap-2 shadow-sm" style="min-width: 180px;">
            <i class="bi bi-calculator"></i> Lakukan Penilaian
        </a>
    </div>
</div>

<style>
    .employee-poster {
        max-width: 110px;
        max-height: 140px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgb(0 0 0 / 0.1);
        transition: transform 0.3s ease;
    }
    .employee-poster:hover {
        transform: scale(1.05);
    }
    .employee-poster-placeholder {
        width: 110px;
        height: 140px;
        background-color: #f8f9fa;
        border-radius: 12px;
    }
    .card.hover-shadow:hover {
        transform: translateY(-8px);
        box-shadow: 0 0.75rem 1.5rem rgb(0 0 0 / 0.15) !important;
        transition: all 0.3s ease;
    }
    .btn:focus {
        box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 0.5);
    }
</style>
@endsection
