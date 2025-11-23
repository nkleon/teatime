<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home') - {{ env('APP_NAME') }}</title>

    <!-- Stylesheets and scripts for BootStrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Stylesheets and scripts for select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    
</head>

<body>

    <!-- NAVIGATION BAR -->
    <nav class="navbar navbar-expand-lg" style="background: var(--primary-bg); color: var(--primary-text); padding: 0.75rem 1.5rem;">
    <div class="container-fluid" style="display: flex; justify-content: space-between; align-items: center;">

        <!-- Logo + App Name -->
        <div class="logo-container d-flex align-items-center gap-2">
            <a href="{{ url('/') }}">
                <img src="{{ asset('logo.png') }}" alt="{{ env('APP_NAME') }} Logo"
                     style="width: 40px; height: 40px; object-fit: contain;">
            </a>
            <a href="{{ url('/') }}" style="color: inherit; text-decoration: none; font-weight: bold; font-size: 1.4rem;">
                {{ env('APP_NAME') }}
            </a>
        </div>

        <!-- Links + User Dropdown -->
        <div class="d-flex align-items-center gap-3">

            <!-- Navbar links -->
            <ul class="navbar-nav flex-row gap-3 mb-0">
                @can('viewAny', App\Models\Role::class)
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('roles.index') }}">Roles</a></li>
                @endcan
                @can('viewAny', App\Models\User::class)
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('users.index') }}">Users</a></li>
                @endcan
                @can('viewAny', App\Models\Farm::class)
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('farms.index') }}">Farms</a></li>
                @endcan
                @can('viewAny', App\Models\PaymentMethod::class)
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('payment-methods.index') }}">Payment Methods</a></li>
                @endcan
                @can('viewAny', App\Models\Collection::class)
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('collections.index') }}">Collections</a></li>
                @endcan
                @can('viewAny', App\Models\Payment::class)
                    <li class="nav-item"><a class="nav-link text-white" href="{{ route('payments.index') }}">Payments</a></li>
                @endcan
            </ul>

            <!-- User Dropdown -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" 
                   id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ Auth::check() && Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('user.png') }}" 
                         alt="Profile" width="32" height="32" class="rounded-circle me-2">
                    <span>{{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    @if(Auth::check())
                        <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                    @endif
                </ul>
            </div>

        </div>
    </div>
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
            <a href="{{ route('about') }}">About Us</a>
        </div>
    </footer>

</body>

</html>
