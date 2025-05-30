@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center">
        {{-- You might want to add a back button here if applicable --}}
        {{-- <a href="{{ route('some.previous.page') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a> --}}
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Error Messages (for validation) --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
            <h5 class="alert-heading fw-bold d-flex align-items-center mb-2">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Ada kesalahan dalam input Anda!
            </h5>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Score Input Form Card --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-lg-5 p-4">
            <form action="{{ route('score.store') }}" method="POST">
                @csrf

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-4"> {{-- table-hover for rows, align-middle for vertical alignment --}}
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="text-nowrap text-dark fw-bold">Drama</th>
                                @foreach($genres as $genre)
                                    <th scope="col" class="text-nowrap text-dark fw-bold text-center">
                                        {{ $genre->nama_genre }} <br>
                                        <span class="fw-normal text-muted small">({{ ucfirst($genre->tipe) }})</span>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dramas as $drama)
                                <tr>
                                    <td class="fw-medium text-dark">
                                        <input type="hidden" name="drama_ids[]" value="{{ $drama->id }}">
                                        {{ $drama->nama_drama }}
                                    </td>
                                    @foreach($genres as $genre)
                                        <td class="text-center">
                                            <input type="number"
                                                   name="value[{{ $drama->id }}][{{ $genre->id }}]"
                                                   class="form-control form-control-sm text-center score-input-field"
                                                   min="0" max="100" step="1"
                                                   value="{{ old('value.' . $drama->id . '.' . $genre->id, $scores[$drama->id . '-' . $genre->id]->skor ?? '') }}"
                                                   placeholder="0-100">
                                            {{-- Add error feedback for individual score if needed --}}
                                            @error('value.' . $drama->id . '.' . $genre->id)
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ 1 + count($genres) }}" class="text-center text-muted py-4">
                                        <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                                        Belum ada drama atau kriteria untuk diinput.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary btn-sm shadow-sm rounded-pill px-5">
                        <i class="bi bi-save me-2"></i>Simpan Penilaian
                    </button>
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
        max-width: 1200px; /* Wider container for the table */
    }

    /* Page Header */
    h2 .bi {
        color: #6c757d; /* Muted icon color for header */
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
    .alert-danger .alert-heading {
        color: #721c24;
    }
    .alert-danger .bi {
        font-size: 1.5rem;
    }

    /* Card holding the form */
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
        padding: 1rem 0.75rem; /* Adjusted padding for header cells */
        font-size: 0.9rem;
        letter-spacing: 0.03em;
        text-transform: uppercase;
        color: #495057; /* Darker text for header */
        vertical-align: middle; /* Center header content vertically */
    }
    .table tbody tr {
        transition: background-color 0.2s ease;
    }
    .table tbody tr:hover {
        background-color: #f8f9fa; /* Light background on hover */
    }
    .table tbody td {
        padding: 0.75rem; /* Consistent padding for body cells */
        vertical-align: middle;
        border-top: 1px solid #e9ecef; /* Lighter border between rows */
    }
    .table tbody tr:first-child td {
        border-top: none; /* No top border for the first row */
    }

    /* Score Input Field */
    .score-input-field {
        width: 80px; /* Fixed width for score inputs */
        display: inline-block; /* Allows width to apply */
        border-radius: 0.5rem; /* Rounded corners */
        font-weight: 600; /* Bolder text */
        background-color: #fdfdfd; /* Off-white background */
        border: 1px solid #dee2e6;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .score-input-field:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        outline: 0;
        background-color: #fff;
    }
    .score-input-field.is-invalid {
        border-color: #dc3545;
    }
    .score-input-field + .invalid-feedback {
        font-size: 0.8rem;
        text-align: center;
        margin-top: 0.25rem;
    }

    /* Button Styling */
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
    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
    }
    .btn-outline-secondary:hover {
        background-color: #6c757d;
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
            flex-basis: 50%; /* Give label half space */
            text-align: left;
            padding-right: 1rem;
        }
        /* Add data-label attributes to your TDs if you want the responsiveness for all cells */
        /* For example: <td data-label="Nama Kriteria">...</td> */
        .score-input-field {
            width: 100px; /* Adjust width for mobile */
        }
        .score-input-field + .invalid-feedback {
            text-align: right; /* Align feedback to the right for mobile */
        }
        .d-flex.justify-content-end.mt-4 {
            justify-content: center !important; /* Center button on small screens */
        }
    }
</style>
@endpush