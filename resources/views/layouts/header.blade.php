<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="#" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown user-menu">

                <!-- TRIGGER -->
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">

                    <img src="{{ asset('assets/images/user2-160x160.jpg') }}" class="rounded-circle shadow-sm me-2"
                        width="34" height="34" alt="User Image">

                    <div class="d-none d-md-block text-start">
                        <div class="fw-semibold text-dark">{{ auth()->user()->name }}</div>
                        {{-- <small class="text-muted" style="font-size: 12px;">Administrator</small> --}}
                    </div>

                </a>

                <!-- DROPDOWN -->
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-0"
                    style="min-width: 260px; border-radius: 12px; overflow: hidden;">

                    <!-- HEADER -->
                    <li class="bg-light text-center p-3 border-bottom">
                        <img src="{{ asset('assets/images/user2-160x160.jpg') }}" class="rounded-circle mb-2 shadow-sm"
                            width="60" height="60">

                        <div class="fw-bold">{{ auth()->user()->name }}</div>
                        <small class="text-muted">{{ auth()->user()->email }}</small>
                    </li>

                    <!-- BODY -->
                    <li>
                        <a href="#" class="dropdown-item py-2 d-flex align-items-center">
                            <i class="bi bi-person me-2"></i> Profile
                        </a>
                    </li>

                    <li>
                        <a href="#" class="dropdown-item py-2 d-flex align-items-center">
                            <i class="bi bi-gear me-2"></i> Settings
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider m-0">
                    </li>

                    <!-- LOGOUT -->
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="dropdown-item text-danger py-2 d-flex align-items-center">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Sign out
                            </button>
                        </form>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
</nav>
