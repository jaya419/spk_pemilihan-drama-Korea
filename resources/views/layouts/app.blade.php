<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistem Pemilihan Drama Terbaik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa; /* Very light gray background */
            font-size: 0.9rem;
            color: #343a40; /* Default text color for body */
        }
        main {
            flex: 1;
            padding-top: 2rem; /* Slightly more padding for main content */
            padding-bottom: 2rem;
        }

        /* --- Navbar Styles (kept from previous iteration) --- */
        .navbar {
            background-color: #e2f0ff; /* Light blue for navbar background */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); /* Softer, modern shadow */
            padding: 0.5rem 1rem; /* Slightly less vertical padding (smaller) */
            border-bottom: 1px solid #e9ecef; /* Subtle light gray border */
            transition: all 0.3s ease-in-out;
        }

        .navbar-brand {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 700;
            font-size: 1.4rem; /* Slightly smaller brand text */
            color: #343a40 !important;
            display: flex;
            align-items: center;
            gap: 0.4rem; /* Slightly less gap */
            transition: color 0.2s ease;
            letter-spacing: 0;
        }

        .navbar-brand i {
            font-size: 1.6rem; /* Slightly smaller icon */
            color: #007bff;
            transition: color 0.2s ease;
        }

        .navbar-brand:hover {
            color: #0056b3 !important;
            text-decoration: none;
        }

        .navbar-brand:hover i {
            color: #0056b3;
        }

        .navbar-toggler {
            border-color: rgba(0, 0, 0, 0.1) !important;
            padding: 0.25rem 0.45rem; /* Slightly smaller padding */
            font-size: 0.95rem; /* Slightly smaller font */
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.5%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        .nav-link {
            color: #6c757d !important;
            font-weight: 500;
            padding: 0.4rem 0.7rem !important; /* Slightly less padding (smaller) */
            transition: background-color 0.2s ease, color 0.2s ease, border-radius 0.2s ease;
            border-radius: 0.3rem;
            display: flex;
            align-items: center;
            gap: 0.3rem; /* Slightly less gap */
            font-size: 0.85rem; /* Slightly smaller font for links */
        }

        .nav-link:hover,
        .nav-link:focus {
            color: #007bff !important;
            background-color: #e2f0ff !important;
        }

        .nav-link.active {
            background-color: #007bff !important;
            color: #fff !important;
            box-shadow: 0 1px 3px rgba(0, 123, 255, 0.2); /* Softer shadow for active link */
        }

        .nav-link.active i {
            color: #fff !important;
        }

        .nav-link i {
            font-size: 1rem; /* Slightly smaller icon size */
            color: #9da6ad;
            transition: color 0.2s ease;
        }

        .nav-link:hover i {
            color: #007bff;
        }

        /* Adjusted user profile icon styling for the new look */
        .user-profile-icon {
            font-size: 1.4rem; /* Slightly smaller icon */
            color: #007bff;
            border: 2px solid #007bff;
            border-radius: 50%;
            padding: 0.05rem 0.25rem; /* Reduced padding */
            width: 32px; /* Smaller fixed width/height */
            height: 32px;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25); /* Softer glow */
            transition: color 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .nav-item.dropdown:hover .user-profile-icon {
            color: #0056b3;
            border-color: #0056b3;
            box-shadow: 0 0 7px rgba(0, 123, 255, 0.4);
        }

        /* Dropdown menu styling (updated to match new palette) */
        .dropdown-menu {
            background-color: #ffffff !important;
            border: 1px solid #ced4da;
            border-radius: 0.4rem;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12); /* Slightly softer shadow */
            min-width: 180px; /* Slightly narrower */
            padding: 0.4rem 0; /* Reduced padding */
            animation: fadeInScale 0.2s ease-out;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.97) translateY(-3px); /* Slightly smaller scale/movement */
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .dropdown-item,
        .dropdown-item-text {
            color: #343a40 !important;
            padding: 0.5rem 0.9rem; /* Reduced padding */
            transition: background-color 0.2s ease, color 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem; /* Reduced gap */
            font-size: 0.85rem; /* Smaller font */
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #f1f1f1 !important;
            color: #007bff !important;
        }

        .dropdown-divider {
            border-color: #e9ecef !important;
            margin: 0.4rem 0; /* Reduced margin */
        }

        .dropdown-item .btn-link {
            color: #dc3545 !important;
            font-weight: 500;
            text-decoration: none;
        }

        .dropdown-item .btn-link:hover {
            color: #c82333 !important;
            text-decoration: underline;
        }

        /* --- New, Improved Footer Styles --- */
        .footer-modern {
            background-color: #343a40; /* Dark gray background */
            color: #adb5bd; /* Light gray text */
            padding: 1.5rem 0; /* Balanced padding for a small-but-not-tiny footer */
            font-size: 0.85rem; /* Slightly larger base font for readability */
            border-top: 3px solid #007bff; /* Primary blue top border */
            box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.15); /* Soft shadow */
        }

        .footer-modern .container {
            display: flex;
            flex-direction: column; /* Stack vertically by default */
            align-items: center; /* Center items horizontally */
            text-align: center;
        }

        .footer-modern .footer-brand-section {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem; /* Space below brand */
            color: #ffffff; /* White color for the brand text */
            font-weight: 700;
            font-size: 1rem; /* Slightly larger brand text */
        }

        .footer-modern .footer-brand-section i {
            font-size: 1.3rem; /* Larger icon for brand */
            color: #007bff; /* Primary blue for icon */
        }

        .footer-modern .footer-links-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex; /* Make links horizontal */
            flex-wrap: wrap; /* Allow wrapping */
            justify-content: center; /* Center links */
            gap: 0.75rem 1.2rem; /* Vertical and horizontal gap between links */
            margin-bottom: 0.75rem; /* Space below links */
        }

        .footer-modern .footer-links-list a {
            color: #e9ecef; /* Lighter color for links */
            text-decoration: none;
            transition: color 0.2s ease;
            font-weight: 500;
            font-size: 0.85rem; /* Readable link font size */
        }

        .footer-modern .footer-links-list a:hover {
            color: #007bff;
            text-decoration: underline;
        }

        .footer-modern .footer-copyright {
            color: #adb5bd;
            font-size: 0.75rem; /* Clear copyright font size */
        }

        /* --- Responsive adjustments --- */
        @media (min-width: 768px) {
            .footer-modern .container {
                flex-direction: row; /* Horizontal on medium screens and up */
                justify-content: space-between; /* Space out items */
                text-align: left; /* Align text to start */
            }

            .footer-modern .footer-brand-section {
                margin-bottom: 0; /* Remove bottom margin when horizontal */
            }

            .footer-modern .footer-links-list {
                margin-bottom: 0; /* Remove bottom margin when horizontal */
                flex-basis: auto; /* Don't force full width */
            }
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                padding: 0.7rem 0;
                background-color: #f8f9fa;
                border-top: 1px solid #dee2e6;
            }

            .nav-item {
                margin: 0.2rem 0;
            }

            .nav-link {
                padding-left: 1.25rem !important;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-award-fill"></i> <span class="d-none d-sm-inline">Pemilihan drama</span> <span class="d-inline d-sm-none">Drama</span>
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-house-door-fill"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('drama.*') ? 'active' : '' }}" href="{{ route('drama.index') }}">
                            <i class="bi bi-film"></i> Daftar drama
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('genre.*') ? 'active' : '' }}" href="{{ route('genre.index') }}">
                            <i class="bi bi-tags-fill"></i> Kriteria
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('score.result') ? 'active' : '' }}" href="{{ route('score.result') }}">
                            <i class="bi bi-bar-chart-line-fill"></i> Hasil penilaian
                        </a>
                    </li>

                    @auth
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle d-flex align-items-center"
                            href="#"
                            id="userDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="bi bi-person-circle user-profile-icon me-2"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li class="dropdown-item-text text-center">
                                <strong>{{ auth()->user()->name }}</strong><br />
                                <small class="text-muted">{{ auth()->user()->email }}</small>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0 m-0">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="btn btn-link text-danger w-100 text-start px-3 py-2 d-flex align-items-center"
                                    >
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>

    <footer class="footer-modern">
        <div class="container">
            <div class="footer-brand-section">
                <i class="bi bi-award-fill"></i>
                <span>Sistem pemilihan drama</span>
            </div>
            <ul class="footer-links-list">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('drama.index') }}">Daftar drama</a></li>
                <li><a href="{{ route('genre.index') }}">Kriteria</a></li>
                <li><a href="{{ route('score.result') }}">Hasil penilaian</a></li>
            </ul>
            <p class="footer-copyright mb-0">
                &copy; 2025. All rights reserved.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>