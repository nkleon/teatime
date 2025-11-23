<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home') - {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        :root {
            /* Agricultural theme colors */
            --primary-bg: #3C6E47;
            --primary-text: #FFFFFF;

            --secondary-bg: #F2E8C9;
            --secondary-text: #2F2F2F;

            --accent: #A67B5B;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            font-family: "Inter", Arial, sans-serif;
            background: var(--secondary-bg);
            color: var(--secondary-text);
        }

        /* NAVBAR */
        nav {
            background: var(--primary-bg);
            color: var(--primary-text);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            flex-wrap: wrap;
        }

        nav .logo {
            font-size: 1.4rem;
            font-weight: bold;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 1.2rem;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
        }

        nav ul li a {
            color: var(--primary-text);
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        /* MAIN CONTENT */
        main.content {
            flex: 1;
            padding: 2rem;
        }

        /* ===========================
           TABLE STYLING
        ============================ */

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table thead {
            background: var(--primary-bg);
            color: var(--primary-text);
        }

        table th,
        table td {
            padding: 0.85rem 1rem;
            text-align: left;
            border-bottom: 1px solid #d8d8d8;
        }

        table tbody tr:nth-child(even) {
            background: #f9f5e9;
            /* light agricultural tone */
        }

        table tbody tr:hover {
            background: #e8e0c9;
            /* slightly darker wheat shade */
        }

        table th {
            font-weight: 600;
        }

        /* Make table scrollable on small screens */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* FOOTER */
        footer {
            background: var(--primary-bg);
            color: var(--primary-text);
            padding: 1.5rem;
            text-align: center;
        }

        footer a {
            color: var(--primary-text);
            text-decoration: underline;
        }

        /* RESPONSIVE NAV */
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            nav ul {
                justify-content: center;
                margin-top: 1rem;
            }
        }
    </style>
</head>

<body>

    <!-- NAVIGATION BAR -->
    <nav>
        <div class="logo-container" style="display: flex; align-items: center; gap: 0.75rem;">
            <!-- Logo -->
            <a href="{{ url('/') }}">
                <img src="{{ asset('logo.png') }}" alt="{{ env('APP_NAME') }} Logo"
                    style="width: 40px; height: 40px; object-fit: contain;">
            </a>
            <!-- App Name -->
            <a href="{{ url('/') }}"
                style="color: inherit; text-decoration: none; font-weight: bold; font-size: 1.4rem;">
                {{ env('APP_NAME') }}
            </a>
        </div>

        <ul>
            <li><a href="{{ route('roles.index') }}">Roles</a></li>
            <li><a href="{{ route('users.index') }}">Users</a></li>
            <li><a href="{{ route('farms.index') }}">Farms</a></li>
            <li><a href="{{ route('payment-methods.index') }}">Payment Methods</a></li>
            <li><a href="{{ route('collections.index') }}">Collections</a></li>
            <li><a href="{{ route('payments.index') }}">Payments</a></li>
        </ul>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="content">

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer>
        <div>
            &copy; {{ date('Y') }} {{ env('APP_NAME') }} — All Rights Reserved.
            &nbsp;|&nbsp;
            <a href="{{-- route('about') --}}#">About Us</a>
        </div>
    </footer>

</body>

</html>
