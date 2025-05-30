@extends('layouts.app')

@section('content')
<div class="container py-5"> {{-- Increased vertical padding for more breathing room --}}
    {{-- Page Header and Optional Action Button --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center"> {{-- More margin-bottom, better alignment --}}
        {{-- Add New Drama Button (Uncomment to activate) --}}
        {{--
        <a href="{{ route('drama.create') }}" class="btn btn-primary btn-lg shadow-sm"> {{-- Larger button --}}
            {{-- <i class="bi bi-plus-circle me-2"></i> Tambah Drama Baru
        </a>
        --}}
    </div>

    {{-- Welcome Message --}}
    <div class="alert alert-info border-0 rounded-4 shadow-sm p-4 mb-5" role="alert"> {{-- Info alert for welcome message --}}
        <h4 class="alert-heading fw-bold mb-2">Selamat Datang Kembali, Admin!</h4>
        <p class="mb-0">Di sini Anda dapat mengelola data drama, genre, skor, dan melihat ringkasan aktivitas terkini dengan mudah.</p>
    </div>


    {{-- Summary Cards Section --}}
    <div class="row mb-5 g-4"> {{-- Increased margin-bottom and gutter spacing --}}
        <div class="col-md-4">
            <div class="card card-custom h-100"> {{-- Custom card class for unified styling --}}
                <div class="card-body text-center p-4">
                    <div class="icon-circle mb-3 bg-primary-subtle text-primary"> {{-- Styled icon circle --}}
                        <i class="bi bi-film"></i>
                    </div>
                    <h5 class="card-title fw-bold text-dark mb-2">Total Drama</h5>
                    <p class="card-text display-4 fw-bold text-primary">{{ $dramaCount }}</p> {{-- Use display-4 for larger number --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-circle mb-3 bg-success-subtle text-success">
                        <i class="bi bi-tags-fill"></i>
                    </div>
                    <h5 class="card-title fw-bold text-dark mb-2">Total Kriteria (Genre)</h5> {{-- Changed to Kriteria --}}
                    <p class="card-text display-4 fw-bold text-success">{{ $genreCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-circle mb-3 bg-warning-subtle text-warning">
                        <i class="bi bi-star-half"></i>
                    </div>
                    <h5 class="card-title fw-bold text-dark mb-2">Total Entri Penilaian</h5> {{-- Changed to Penilaian --}}
                    <p class="card-text display-4 fw-bold text-warning">{{ $scoreCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4"> {{-- Consistent gutter spacing --}}
        {{-- Top 3 Ranked Dramas --}}
        <div class="col-lg-6">
            <div class="card card-custom h-100">
                <div class="card-header bg-dark text-white rounded-top-3 p-3 d-flex align-items-center"> {{-- Darker header, rounded top, aligned icon --}}
                    <i class="bi bi-trophy-fill me-2 fs-4 text-warning"></i> {{-- Prominent icon --}}
                    <h4 class="mb-0 fs-5 fw-bold">3 Drama Teratas</h4>
                </div>
                <div class="card-body p-0">
                    @if($top3RankedDramas && count($top3RankedDramas) > 0)
                    <ul class="list-group list-group-flush list-group-hover"> {{-- Added hover effect --}}
                        @foreach($top3RankedDramas as $index => $drama)
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4"> {{-- More vertical padding --}}
                                <div class="d-flex align-items-center">
                                    <span class="rank-badge me-3">{{ $index + 1 }}</span> {{-- Styled rank badge --}}
                                    <span class="text-dark fw-medium">{{ $drama['drama'] }}</span>
                                </div>
                                <span class="badge bg-primary rounded-pill px-3 py-2 fs-6">Skor: {{ number_format($drama['score'], 1) }}</span> {{-- Larger, more padded badge --}}
                            </li>
                        @endforeach
                    </ul>
                    @else
                    <div class="p-5 text-center text-muted"> {{-- More padding for empty state --}}
                        <i class="bi bi-bar-chart-line fs-1 d-block mb-3"></i>
                        <p class="mb-0">Belum ada data peringkat drama untuk ditampilkan.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Newly Added Dramas --}}
        <div class="col-lg-6">
            <div class="card card-custom h-100">
                <div class="card-header bg-info text-white rounded-top-3 p-3 d-flex align-items-center"> {{-- Info color header, rounded top, aligned icon --}}
                    <i class="bi bi-calendar-plus-fill me-2 fs-4 text-light"></i> {{-- Prominent icon --}}
                    <h4 class="mb-0 fs-5 fw-bold">Drama Terbaru</h4>
                </div>
                <div class="card-body p-0">
                    @if($newlyAddedDramas && $newlyAddedDramas->count() > 0)
                    <ul class="list-group list-group-flush list-group-hover"> {{-- Added hover effect --}}
                        @foreach($newlyAddedDramas as $drama)
                            <li class="list-group-item py-3 px-4"> {{-- More vertical padding --}}
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-arrow-right-short text-primary me-2 fs-5"></i><span class="text-dark fw-medium">{{ $drama->nama_drama }}</span></span>
                                    <small class="text-muted">{{ $drama->created_at->format('d M Y') }}</small>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    @else
                    <div class="p-5 text-center text-muted"> {{-- More padding for empty state --}}
                        <i class="bi bi-journal-plus fs-1 d-block mb-3"></i>
                        <p class="mb-0">Belum ada drama yang baru ditambahkan.</p>
                    </div>
                    @endif
                </div>
                @if($newlyAddedDramas && $newlyAddedDramas->count() > 0)
                <div class="card-footer text-center bg-light border-0 py-3 rounded-bottom-3"> {{-- Lighter footer, no border, rounded bottom --}}
                    <a href="{{ route('drama.index') }}" class="btn btn-outline-info px-4 py-2 rounded-pill shadow-sm"> {{-- Rounded button, more padding --}}
                        Lihat Semua Drama <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    /* General styles for the dashboard */
    .container {
        max-width: 1200px; /* Limit container width for better readability */
    }

    /* Custom Card Styling */
    .card-custom {
        border: none; /* Remove default border */
        border-radius: 1rem; /* More rounded corners */
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.08); /* Softer, larger shadow */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card-custom:hover {
        transform: translateY(-0.5rem); /* Lift on hover */
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15) !important; /* More pronounced shadow on hover */
    }

    /* Icon Circle for Summary Cards */
    .icon-circle {
        width: 70px; /* Larger circle */
        height: 70px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 2.5rem; /* Larger icon inside circle */
        margin: 0 auto 1rem auto; /* Center the circle and add bottom margin */
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.05); /* Subtle shadow for the circle */
    }

    /* List Group Item Styling */
    .list-group-item {
        border-color: rgba(0, 0, 0, 0.07); /* Slightly stronger separator */
        padding: 1rem 1.5rem; /* More generous padding */
    }

    .list-group-hover .list-group-item:hover {
        background-color: #f8f9fa; /* Light background on hover */
        cursor: pointer;
    }

    /* Rank Badge for Top Dramas */
    .rank-badge {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 30px; /* Fixed width for consistent alignment */
        height: 30px;
        background-color: #007bff; /* Primary blue background */
        color: white;
        border-radius: 50%;
        font-weight: bold;
        font-size: 0.9rem;
        box-shadow: 0 2px 5px rgba(0, 123, 255, 0.2); /* Subtle shadow */
    }

    /* Custom colors for card headers */
    .card-header.bg-dark {
        background-color: #212529 !important; /* Ensure a true dark */
        border-bottom: none; /* No border for seamless look */
    }

    .card-header.bg-info {
        background-color: #0dcaf0 !important; /* Ensure Bootstrap's info color */
        border-bottom: none;
    }

    /* Responsive adjustments for headings */
    @media (max-width: 767.98px) {
        .display-6 {
            font-size: 2rem; /* Adjust heading size on smaller screens */
        }
        .icon-circle {
            font-size: 2rem; /* Adjust icon size */
            width: 60px;
            height: 60px;
        }
        .card-text.display-4 {
            font-size: 2.5rem !important; /* Adjust count number size */
        }
        .badge.fs-6 {
            font-size: 0.85rem !important; /* Adjust badge font size */
        }
    }
</style>
@endpush