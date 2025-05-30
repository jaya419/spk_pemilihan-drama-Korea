@extends('layouts.app')

@section('content')
<div class="container py-5">
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 text-primary fw-bold">
            <i class="bi bi-calculator-fill me-2"></i>Hasil Perhitungan SAW
        </h2>
        {{-- This button is optional; enable it if you have a route to go back to score input --}}
        {{-- <a href="{{ route('score.input') }}" class="btn btn-outline-primary rounded-pill px-4 py-2">
            <i class="bi bi-pencil-square me-2"></i> Input Penilaian
        </a> --}}
    </div>

    @if(empty($results) || count($results) === 0)
        <div class="alert alert-info alert-dismissible fade show rounded-3 shadow-sm" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i>
            Belum ada data penilaian untuk ditampilkan atau dihitung. Silakan <a href="{{ route('score.index') }}" class="alert-link">input penilaian drama</a> terlebih dahulu.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-lg-5 p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="text-nowrap text-dark fw-bold text-center">Peringkat</th>
                                <th scope="col" class="text-nowrap text-dark fw-bold">Drama</th>
                                <th scope="col" class="text-nowrap text-dark fw-bold text-center">Skor SAW</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $index => $result)
                                <tr class="{{ ($index === 0) ? 'table-primary highlight-row' : '' }}">
                                    <td class="text-center" data-label="Peringkat">
                                        @if($index === 0)
                                            <span class="badge bg-primary fs-5 px-3 py-2 rounded-pill shadow-sm animate__animated animate__pulse animate__infinite">
                                                <i class="bi bi-award-fill me-1"></i> {{ $index + 1 }}
                                            </span>
                                        @elseif($index === 1)
                                            <span class="badge bg-secondary fs-6 px-3 py-2 rounded-pill">
                                                {{ $index + 1 }}
                                            </span>
                                        @elseif($index === 2)
                                            <span class="badge bg-info fs-6 px-3 py-2 rounded-pill">
                                                {{ $index + 1 }}
                                            </span>
                                        @else
                                            <span class="text-muted">{{ $index + 1 }}</span>
                                        @endif
                                    </td>
                                    <td class="fw-medium text-dark" data-label="Drama">{{ $result['drama'] }}</td>
                                    <td class="text-center" data-label="Skor SAW">
                                        <span class="score-display {{ ($index === 0) ? 'text-primary fw-bold fs-4' : 'text-dark fw-bold' }}">
                                            {{ number_format($result['score'], 2) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
{{-- Add Animate.css for subtle animations --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    /* General container padding */
    .container {
        max-width: 900px; /* Limit container width for focus on results */
    }

    /* Page Header */
    h2 .bi {
        color: #6c757d; /* Muted icon color for header */
    }

    /* Info Alert Styling */
    .alert-info {
        background-color: #d1ecf1;
        color: #0c5460;
        border-color: #bee5eb;
    }
    .alert-info .bi {
        font-size: 1.25rem;
        vertical-align: middle;
    }
    .alert-link {
        font-weight: bold;
        color: #0c5460;
        text-decoration: underline;
    }
    .alert-link:hover {
        color: #073a43;
    }

    /* Card holding the table */
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.12) !important;
    }

    /* Table Styling */
    .table {
        border-collapse: separate;
        border-spacing: 0;
    }
    .table thead th {
        background-color: #e9ecef; /* Light gray for header background */
        border-bottom: 2px solid #dee2e6;
        padding: 1rem 1rem; /* More padding in header cells */
        font-size: 0.85rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: #495057; /* Darker text for header */
    }
    .table tbody tr {
        transition: background-color 0.2s ease;
    }
    .table tbody tr:hover {
        background-color: #f8f9fa; /* Light background on hover */
    }
    .table tbody td {
        padding: 0.9rem 1rem; /* Consistent padding for body cells */
        vertical-align: middle;
        border-top: 1px solid #e9ecef; /* Lighter border between rows */
    }
    .table tbody tr:first-child td {
        border-top: none; /* No top border for the first row */
    }

    /* Highlight for the top-ranked drama */
    .highlight-row {
        background-color: #e7f0fa !important; /* Lighter blue for top row */
        font-weight: bold;
    }
    .highlight-row:hover {
        background-color: #dbeaff !important; /* Slightly darker on hover */
    }

    /* Styling for Rank Badges */
    .badge {
        min-width: 40px; /* Ensure badges have a consistent width */
        font-weight: 700;
        vertical-align: middle;
    }
    .badge .bi {
        vertical-align: text-bottom;
    }

    /* Score display styling */
    .score-display {
        font-family: 'Segoe UI', 'Roboto', sans-serif; /* Modern font for scores */
    }

    /* Button styling (if uncommented) */
    .btn-lg {
        font-size: 1.1rem;
        padding: 0.75rem 2rem;
        border-radius: 2rem; /* More rounded pills */
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
    }
    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }

    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .table thead {
            display: none; /* Hide header on small screens */
        }
        .table tbody tr {
            display: block;
            border: 1px solid #dee2e6;
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            padding: 1rem;
            background-color: #fff;
        }
        .table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-top: none;
        }
        .table tbody td:first-child {
            font-size: 1.1rem;
            font-weight: bold;
            color: #343a40;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 0.5rem;
            padding-bottom: 0.75rem;
        }
        .table tbody td:not(:first-child)::before {
            content: attr(data-label);
            font-weight: 600;
            color: #6c757d;
            flex-basis: 50%;
            text-align: left;
            padding-right: 1rem;
        }
        .d-flex.justify-content-between.align-items-center.mb-4 {
            flex-direction: column;
            align-items: flex-start !important;
        }
        .d-flex.justify-content-between.align-items-center.mb-4 .btn {
            width: 100%;
            margin-top: 1rem;
            text-align: center;
        }
    }
</style>
@endpush