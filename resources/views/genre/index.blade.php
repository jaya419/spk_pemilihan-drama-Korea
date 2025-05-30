@extends('layouts.app')

@section('content')
<div class="container py-5">
    {{-- Page Header and Action Button --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('genre.create') }}" class="btn btn-primary btn-sm shadow-sm rounded-pill px-4 py-2">
            <i class="bi bi-plus-circle me-2"></i> Tambah Kriteria Baru
        </a>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            <i class="bi bi-x-circle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Genre List Table --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0"> {{-- table-hover for row highlight, align-middle for vertical alignment --}}
                    <thead class="bg-light"> {{-- Lighter background for header --}}
                        <tr>
                            <th scope="col" class="text-nowrap text-dark fw-bold">No.</th> {{-- Added No. column --}}
                            <th scope="col" class="text-nowrap text-dark fw-bold">Nama Kriteria</th>
                            <th scope="col" class="text-nowrap text-dark fw-bold">Bobot</th>
                            <th scope="col" class="text-nowrap text-dark fw-bold">Tipe</th>
                            <th scope="col" class="text-nowrap text-dark fw-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($genres as $index => $genre)
                        <tr>
                            <td data-label="No.">{{ $index + 1 }}</td> {{-- Added data-label for responsiveness --}}
                            <td data-label="Nama Kriteria">{{ $genre->nama_genre }}</td> {{-- Added data-label for responsiveness --}}
                            <td data-label="Bobot"><span class="badge bg-secondary-subtle text-secondary px-3 py-2 fw-bold">{{ $genre->bobot }}</span></td> {{-- Added data-label for responsiveness --}}
                            <td data-label="Tipe"> {{-- Added data-label for responsiveness --}}
                                @if($genre->tipe == 'benefit')
                                    <span class="badge bg-success-subtle text-success px-2 py-1">Benefit</span>
                                @elseif($genre->tipe == 'cost')
                                    <span class="badge bg-danger-subtle text-danger px-2 py-1">Cost</span>
                                @else
                                    <span class="badge bg-info-subtle text-info px-2 py-1">{{ ucfirst($genre->tipe) }}</span>
                                @endif
                            </td>
                            <td data-label="Aksi" class="text-center text-nowrap"> {{-- Added data-label for responsiveness --}}
                                <a href="{{ route('genre.edit', $genre->id) }}" class="btn btn-sm btn-warning me-2 action-btn" title="Edit">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('genre.destroy', $genre->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger action-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus kriteria ini?')" title="Hapus">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                                Belum ada data kriteria yang tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{--
                IF YOU ARE USING PAGINATION (e.g., $genres = Genre::paginate(10); in your controller):
                Uncomment the following block to display pagination links.
            --}}
            {{-- @if ($genres->lastPage() > 1)
                <div class="d-flex justify-content-center mt-4">
                    {{ $genres->links() }}
                </div>
            @endif --}}

            {{-- Alternatively, if you want a simple message for no pagination: --}}
            {{-- @if ($genres->isEmpty())
                <div class="text-center mt-3 text-muted">
                    Tidak ada kriteria lain untuk ditampilkan.
                </div>
            @endif --}}
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* General container padding */
    .container {
        max-width: 1000px; /* Max width for better readability on large screens */
    }

    /* Page Header */
    h2 .bi {
        color: #6c757d; /* Slightly muted icon color for header */
    }

    /* Alert Messages */
    .alert {
        padding: 1rem 1.5rem;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
    }
    .alert .bi {
        font-size: 1.25rem;
        vertical-align: middle;
    }
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }

    /* Card holding the table */
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.8rem 1.6rem rgba(0, 0, 0, 0.1) !important;
    }

    /* Table Styling */
    .table {
        border-collapse: separate; /* Allows border-radius on cells */
        border-spacing: 0;
    }
    .table thead th {
        background-color: #e9ecef; /* Light gray for header background */
        border-bottom: 2px solid #dee2e6;
        padding: 1rem 1.5rem; /* More padding in header cells */
        font-size: 0.85rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: #495057; /* Darker text for header */
    }
    .table tbody tr {
        transition: background-color 0.2s ease;
    }
    .table tbody tr:hover {
        background-color: #f2f2f2; /* Light background on hover */
    }
    .table tbody td {
        padding: 0.9rem 1.5rem; /* Consistent padding for body cells */
        vertical-align: middle;
        border-top: 1px solid #e9ecef; /* Lighter border between rows */
    }
    .table tbody tr:first-child td {
        border-top: none; /* No top border for the first row */
    }

    /* Badge styling for Bobot */
    .badge.bg-secondary-subtle {
        background-color: #e2e6ea !important;
        color: #5c636a !important;
    }

    /* Badge styling for Tipe */
    .badge.bg-success-subtle {
        background-color: #d1e7dd !important;
        color: #0f5132 !important;
    }
    .badge.bg-danger-subtle {
        background-color: #f8d7da !important;
        color: #842029 !important;
    }
    .badge.bg-info-subtle {
        background-color: #cff4fc !important;
        color: #055160 !important;
    }

    /* Action Buttons */
    .action-btn {
        width: 38px; /* Fixed width for consistent button size */
        height: 38px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        border-radius: 0.5rem; /* Slightly rounded for softness */
        transition: background-color 0.2s ease, transform 0.1s ease;
    }
    .action-btn:hover {
        transform: translateY(-1px);
        opacity: 0.9;
    }
    .action-btn i {
        font-size: 0.9rem; /* Icon size */
    }
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529; /* Darker text for warning */
    }
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    /* Responsiveness for table */
    @media (max-width: 767.98px) {
        .table thead {
            display: none; /* Hide header on small screens */
        }
        .table tbody td {
            display: block; /* Make table cells block elements */
            text-align: right !important; /* Align content to right */
            padding-left: 50%; /* Make space for pseudo-elements */
            position: relative;
        }
        .table tbody td::before {
            content: attr(data-label); /* Use data-label for content */
            position: absolute;
            left: 15px;
            width: calc(50% - 30px);
            text-align: left;
            font-weight: bold;
            color: #495057;
        }
        .table tbody td:last-child {
            text-align: center !important; /* Center actions */
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .action-btn {
            margin: 0 5px; /* Spacing between buttons on small screens */
        }
    }
</style>
@endpush