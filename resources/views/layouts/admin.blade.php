<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
        }
        .nav-link {
            color: #e0e0e0;
            transition: all 0.3s;
        }
        .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 px-0 sidebar">
                <div class="p-4">
                    <h1 class="h4 text-white fw-bold">
                        <i class="fas fa-user-shield"></i> Admin Panel
                    </h1>
                </div>
                <nav class="nav flex-column mt-4">
                    <a href="{{ route('admin.universities.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.universities.*') ? 'active' : '' }}">
                        <i class="fas fa-university"></i> Universities
                    </a>
                    <a href="{{ route('admin.comments.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                        <i class="fas fa-comments"></i> Comments
                        @php
                            $pendingCount = \App\Models\Comment::pending()->count();
                        @endphp
                        @if($pendingCount > 0)
                            <span class="badge bg-warning ms-2">{{ $pendingCount }}</span>
                        @endif
                    </a>
                    <hr class="bg-light">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="fas fa-home"></i> View Site
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link border-0 bg-transparent text-start w-100">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">
                <header class="bg-white shadow-sm py-3 px-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">@yield('header')</h2>
                        <div class="d-flex align-items-center gap-3">
                            <span class="text-muted">
                                <i class="fas fa-user"></i> {{ auth()->user()->name }}
                                @if(auth()->user()->hasRole('admin'))
                                    <span class="badge bg-danger">Admin</span>
                                @elseif(auth()->user()->hasRole('author'))
                                    <span class="badge bg-primary">Author</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </header>

                <main class="px-4 pb-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (for convenience) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    @stack('scripts')
</body>
</html>