<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Website Booking PKL</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #003056;
            --secondary-color: #004e8c;
            --white: #ffffff;
            --gray-light: #f8f9fa;
            --gray-dark: #333333;
            --border-color: #e0e0e0;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--gray-light);
            color: var(--gray-dark);
            transition: margin-left 0.3s ease;
        }

        /* Navbar */
        .navbar {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .hamburger {
            background: none;
            border: none;
            color: var(--white);
            font-size: 24px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .hamburger:hover {
            transform: scale(1.1);
        }

        .navbar-title {
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-right a {
            color: var(--white);
            text-decoration: none;
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.2s;
        }

        .navbar-right a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background-color: var(--white);
            position: fixed;
            left: 0;
            top: 60px;
            bottom: 0;
            overflow-y: auto;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            text-align: center;
        }

        .sidebar-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .profile-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 24px;
            font-weight: 600;
        }

        .profile-name {
            font-weight: 600;
            color: var(--gray-dark);
            font-size: 14px;
        }

        .profile-role {
            font-size: 12px;
            color: #999;
            background: var(--gray-light);
            padding: 3px 8px;
            border-radius: 3px;
        }

        .sidebar-menu {
            padding: 20px 0;
            list-style: none;
        }

        .sidebar-menu li {
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-menu a {
            display: block;
            padding: 15px 20px;
            color: var(--gray-dark);
            text-decoration: none;
            transition: all 0.2s;
            font-size: 14px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: var(--gray-light);
            color: var(--primary-color);
            border-left: 4px solid var(--primary-color);
            padding-left: 16px;
        }

        /* Main Content */
        .main-content {
            margin-top: 60px;
            padding: 20px;
            min-height: calc(100vh - 60px);
            transition: margin-left 0.3s ease;
        }

        .sidebar.active ~ .main-content {
            margin-left: 280px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 30px;
        }

        .page-header h1 {
            color: var(--primary-color);
            font-size: 28px;
            margin-bottom: 5px;
        }

        .page-header p {
            color: #999;
            font-size: 14px;
        }

        /* Cards */
        .card {
            background: var(--white);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
            transition: box-shadow 0.2s;
        }

        .card:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .card-header h2 {
            color: var(--primary-color);
            font-size: 20px;
        }

        /* Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--white);
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .stat-label {
            color: #999;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-number {
            color: var(--primary-color);
            font-size: 32px;
            font-weight: 700;
            margin-top: 10px;
        }

        /* Tables */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            background-color: #003056;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            border-bottom: 2px solid var(--border-color);
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
            max-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        table td:first-child,
        table td:last-child {
            max-width: none;
            overflow: visible;
            white-space: normal;
        }

        table tr:hover {
            background-color: var(--gray-light);
        }

        /* Buttons */
        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
            font-weight: 500;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 48, 86, 0.3);
        }

        .btn-secondary {
            background-color: #6c757d;
            color: var(--white);
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: var(--white);
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-success {
            background-color: var(--success-color);
            color: var(--white);
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-sm {
            padding: 6px 10px;
            font-size: 12px;
        }

        /* Forms */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--gray-dark);
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 48, 86, 0.1);
        }

        .form-card {
            background: var(--white);
            border-radius: 24px;
            padding: 26px;
            border: 1px solid rgba(0, 48, 86, 0.08);
            box-shadow: 0 24px 60px rgba(0, 48, 86, 0.08);
            margin-bottom: 24px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .form-row .form-group {
            flex: 1;
            min-width: 220px;
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 18px;
        }

        .form-helper {
            color: #6c757d;
            font-size: 13px;
            margin-top: 6px;
            display: block;
        }

        .form-error {
            color: var(--danger-color);
            font-size: 13px;
            margin-top: 6px;
        }

        .upload-zone {
            border: 2px dashed rgba(0, 48, 86, 0.25);
            background: #f8fbff;
            border-radius: 20px;
            padding: 24px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .upload-zone:hover {
            border-color: var(--primary-color);
            background: #eff6ff;
        }

        .upload-zone input {
            display: none;
        }

        .upload-zone .upload-title {
            margin-bottom: 10px;
            color: var(--primary-color);
            font-weight: 700;
            font-size: 14px;
        }

        .upload-zone .upload-help {
            color: #64748b;
            font-size: 13px;
        }

        /* Alerts */
        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left-color: #28a745;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left-color: #dc3545;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border-left-color: #ffc107;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border-left-color: #17a2b8;
        }

        /* Pagination */
        .pagination {
            display: flex;
            gap: 5px;
            margin-top: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            text-decoration: none;
            color: var(--primary-color);
            font-size: 13px;
            transition: all 0.2s;
        }

        .pagination a:hover {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .pagination .active span {
            background-color: var(--primary-color);
            color: var(--white);
            border-color: var(--primary-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 250px;
            }

            .sidebar.active ~ .main-content {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 12px 15px;
            }

            .navbar-title {
                font-size: 16px;
            }

            table {
                font-size: 12px;
            }

            table th,
            table td {
                padding: 8px;
            }

            .btn {
                padding: 8px 12px;
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 15px 10px;
            }

            .page-header h1 {
                font-size: 22px;
            }

            .card {
                padding: 15px;
            }

            .btn {
                width: 100%;
                margin-bottom: 5px;
            }
        }

        /* Overlay untuk sidebar */
        .sidebar-overlay {
            position: fixed;
            top: 60px;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 998;
        }

        .sidebar-overlay.active {
            display: block;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/layout-shared.css') }}">
    @stack('styles')
</head>
<body>
    @include('layouts.partials.navbar')
    @include('layouts.partials.sidebar')

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            @if($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            @if($message = Session::get('error'))
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    @include('layouts.partials.footer')
    <button id="backToTop" class="back-to-top" title="Kembali ke atas">↑</button>
    @include('layouts.partials.scripts')
    @stack('scripts')
</body>
</html>
