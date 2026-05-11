<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
/* Common Styles for Header, Navigation, Footer */
/*
    To update the header/footer logos:
    - Put the top header logo at public/images/logo-vohisix.png
    - Put the student footer logo at public/images/logo-vohisix-white.png
    - If you rename files, update the asset() paths in:
        resources/views/layouts/partials/navbar.blade.php
        resources/views/siswa/partials/footer.blade.php
*/

:root {
    --primary: #003056;
    --primary-dark: #002542;
    --primary-soft: #e6f0fa;
    --white: #ffffff;
    --gray-100: #f8fafc;
    --gray-200: #e2e8f0;
    --gray-300: #cbd5e0;
    --gray-500: #64748b;
    --gray-700: #334155;
    --danger: #dc2626;
    --success: #28a745;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--gray-100);
    color: var(--gray-700);
    min-height: 100vh;
}

a {
    color: inherit;
    text-decoration: none;
}

button {
    font: inherit;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}

/* Header/Navbar */
.navbar {
    background: linear-gradient(135deg, var(--primary) 0%, #00457d 100%);
    box-shadow: 0 2px 12px rgba(0, 48, 86, 0.12);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    height: 72px;
}

.nav-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 100%;
}

.nav-left {
    display: flex;
    align-items: center;
    gap: 18px;
}

.hamburger-btn {
    background: rgba(255, 255, 255, 0.12);
    border: none;
    color: white;
    font-size: 1.15rem;
    cursor: pointer;
    padding: 10px;
    border-radius: 12px;
    transition: background-color 0.25s ease;
}

.hamburger-btn:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

.nav-logo-container {
    display: flex;
    align-items: center;
}

.nav-logo-img {
    height: 44px;
    width: auto;
}

.nav-title {
    color: white;
    font-size: 0.95rem;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
}

.nav-right {
    display: flex;
    align-items: center;
    gap: 16px;
}

.user-greeting {
    display: flex;
    align-items: center;
    gap: 12px;
    color: white;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.18);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1rem;
}

.logout-btn {
    background: var(--danger);
    color: var(--white);
    border: none;
    border-radius: 14px;
    padding: 11px 18px;
    font-weight: 700;
    cursor: pointer;
    transition: background-color 0.25s ease;
}

.logout-btn:hover {
    background: #b91c1c;
}

/* Sidebar */
.sidebar-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.25s ease;
}

.sidebar-overlay.active {
    opacity: 1;
    visibility: visible;
}

.sidebar {
    position: fixed;
    top: 0;
    left: -340px;
    width: 340px;
    height: 100vh;
    background: white;
    box-shadow: 2px 0 20px rgba(15, 23, 42, 0.12);
    transition: left 0.25s ease;
    z-index: 1000;
    display: flex;
    flex-direction: column;
}

.sidebar.active {
    left: 0;
}

.sidebar-header {
    padding: 34px 28px;
    background: linear-gradient(135deg, var(--primary) 0%, #00457d 100%);
    color: white;
    text-align: center;
}

.sidebar-user-avatar {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 1.5rem;
    margin: 0 auto 16px;
    border: 3px solid rgba(255, 255, 255, 0.24);
}

.sidebar-user-name {
    font-weight: 700;
    font-size: 1.05rem;
    margin-bottom: 4px;
}

.sidebar-user-role {
    font-size: 0.9rem;
    opacity: 0.92;
}

.sidebar-nav {
    flex: 1;
    padding: 30px 24px;
}

.sidebar-nav-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 15px 18px;
    margin-bottom: 10px;
    border-radius: 18px;
    text-decoration: none;
    color: #64748b;
    font-weight: 600;
    transition: all 0.25s ease;
    border: 1px solid transparent;
}

.sidebar-nav-item:hover {
    background: rgba(0, 48, 86, 0.06);
    color: var(--primary);
}

.sidebar-nav-item.active {
    background: white;
    color: var(--primary);
    border-color: rgba(0, 48, 86, 0.12);
    box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
}

.sidebar-nav-item i {
    width: 22px;
    text-align: center;
    font-size: 1.1rem;
}

.sidebar-footer {
    padding: 24px;
    border-top: 1px solid rgba(15, 23, 42, 0.08);
}

/* Main Content */
.main-content {
    margin-top: 72px;
    padding: 24px 20px;
    min-height: calc(100vh - 72px);
    transition: margin-left 0.25s ease;
}

@media (min-width: 1200px) {
    .sidebar.active ~ .main-content {
        margin-left: 340px;
    }
}

.page-header {
    margin-bottom: 28px;
}

.page-header h1 {
    color: var(--primary);
    font-size: 2.2rem;
    margin-bottom: 0.75rem;
}

.page-header p {
    color: var(--gray-500);
    font-size: 1rem;
}

.card {
    background: white;
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 14px 34px rgba(15, 23, 42, 0.08);
    margin-bottom: 24px;
}

.card-header {
    border-bottom: 1px solid rgba(15, 23, 42, 0.08);
    padding-bottom: 18px;
    margin-bottom: 22px;
}

.card-header h2 {
    color: var(--primary);
    font-size: 1.15rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 22px;
    margin-bottom: 28px;
}

.stat-card {
    background: white;
    padding: 22px;
    border-radius: 20px;
    border-left: 4px solid var(--primary);
    box-shadow: 0 14px 28px rgba(15, 23, 42, 0.06);
}

.stat-label {
    color: var(--gray-500);
    font-size: 0.85rem;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.stat-number {
    color: var(--primary);
    font-size: 2rem;
    font-weight: 700;
    margin-top: 0.9rem;
}

.table-responsive {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 18px;
}

table th,
table td {
    padding: 14px 16px;
    text-align: left;
}

table th {
    background: var(--primary);
    color: white;
    font-size: 0.9rem;
    font-weight: 700;
}

table td {
    border-bottom: 1px solid rgba(15, 23, 42, 0.08);
    font-size: 0.95rem;
}

table tr:hover {
    background: var(--gray-100);
}

.btn {
    padding: 12px 18px;
    border-radius: 14px;
    text-decoration: none;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 0.95rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-primary {
    background: var(--primary);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
}

.btn-danger {
    background: var(--danger);
    color: white;
}

.btn-danger:hover {
    background: #b91c1c;
}

.btn-success {
    background: var(--success);
    color: white;
}

.btn-sm {
    padding: 8px 14px;
    font-size: 0.85rem;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: var(--gray-700);
    font-weight: 700;
    font-size: 0.95rem;
}

.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 12px 14px;
    border-radius: 14px;
    border: 1px solid rgba(15, 23, 42, 0.12);
    background: white;
    font-size: 0.95rem;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(0, 48, 86, 0.1);
}

.form-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 18px;
}

.upload-zone {
    border: 2px dashed rgba(0, 48, 86, 0.18);
    border-radius: 20px;
    padding: 24px;
    text-align: center;
    background: #f8fbff;
}

.upload-zone:hover {
    background: #eff6ff;
    border-color: var(--primary);
}

.alert {
    padding: 16px 20px;
    border-radius: 14px;
    margin-bottom: 20px;
    border-left: 5px solid transparent;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border-left-color: var(--success);
}

.alert-danger {
    background: #f8d7da;
    color: #842029;
    border-left-color: var(--danger);
}

.alert-warning {
    background: #fff3cd;
    color: #664d03;
    border-left-color: #ffc107;
}

.alert-info {
    background: #cff4fc;
    color: #055160;
    border-left-color: #0dcaf0;
}

.pagination {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 22px;
}

.pagination a,
.pagination span {
    padding: 10px 14px;
    border-radius: 12px;
    border: 1px solid rgba(15, 23, 42, 0.12);
    color: var(--primary);
    font-size: 0.9rem;
}

.pagination a:hover {
    background: var(--primary);
    color: white;
}

.pagination .active span {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.footer-admin {
    background: var(--gray-200);
    color: var(--gray-700);
    padding: 24px 0;
    border-top: 1px solid rgba(15, 23, 42, 0.08);
}

.footer-admin p {
    margin: 0;
    text-align: center;
    font-size: 0.95rem;
}

footer {
    background: linear-gradient(135deg, var(--primary) 0%, #00457d 100%);
    color: white;
    padding: 40px 0;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer-top {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-bottom: 32px;
}

.footer-logo-container {
    display: flex;
    align-items: center;
    gap: 14px;
}

.footer-logo-img {
    height: 44px;
    width: auto;
}

.footer-subtitle {
    max-width: 680px;
    line-height: 1.75;
    opacity: 0.9;
}

.footer-middle {
    display: grid;
    grid-template-columns: repeat(4, minmax(180px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.footer-section {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.footer-title {
    font-size: 1rem;
    font-weight: 700;
}

.footer-links,
.pembuat-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: grid;
    gap: 10px;
}

.footer-links li a,
.pembuat-list li {
    color: rgba(255, 255, 255, 0.88);
    font-size: 0.95rem;
}

.footer-links li a:hover {
    color: white;
}

.social-vertical {
    display: grid;
    gap: 12px;
}

.social-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    border-radius: 16px;
    background: rgba(255, 255, 255, 0.12);
    color: white;
}

.social-item:hover {
    background: rgba(255, 255, 255, 0.2);
}

.social-icon-small {
    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.16);
}

.copyright {
    margin: 0;
    font-size: 0.95rem;
    opacity: 0.85;
}

.scroll-to-top {
    position: fixed;
    right: 22px;
    bottom: 24px;
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: var(--primary);
    color: white;
    display: grid;
    place-items: center;
    border: none;
    cursor: pointer;
    box-shadow: 0 14px 30px rgba(0, 48, 86, 0.18);
    opacity: 0;
    visibility: hidden;
    transition: transform 0.2s ease, opacity 0.2s ease;
    z-index: 1100;
}

.scroll-to-top.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(-6px);
}

.scroll-to-top i {
    font-size: 1rem;
}

@media (max-width: 1024px) {
    .sidebar {
        width: 300px;
    }

    .footer-middle {
        grid-template-columns: repeat(2, minmax(180px, 1fr));
    }
}

@media (max-width: 768px) {
    .sidebar {
        width: 280px;
    }

    .main-content {
        padding: 20px 14px;
    }

    .footer-middle {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 640px) {
    .nav-container,
    .footer-container {
        padding: 0 16px;
    }

    .nav-title {
        display: none;
    }

    .footer-top,
    .footer-middle {
        gap: 18px;
    }

    .footer-logo-img {
        height: 36px;
    }
}
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('head')
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

    <button id="scrollToTop" class="scroll-to-top" title="Kembali ke atas">
        <i class="fas fa-arrow-up"></i>
    </button>

    @include('layouts.partials.scripts')
    @stack('scripts')
</body>
</html>
