@extends('auth.app')

@section('content')
    <div class="customer-login-wrapper">

        <div class="customer-login-bg"></div>
        <div class="customer-login-overlay"></div>
        <div class="customer-login-glow customer-login-glow-1"></div>
        <div class="customer-login-glow customer-login-glow-2"></div>

        <div class="container-fluid position-relative customer-login-container">
            <div class="row min-vh-100 align-items-center">

                {{-- LEFT CONTENT --}}
                <div class="col-lg-7 d-none d-lg-block">
                    <div class="customer-left-content">

                        <div class="brand-pill">
                            <i class="bi bi-buildings-fill"></i>
                            <span>Real Estate CRM</span>
                        </div>

                        <h1>
                            Manage Your Plot <br>
                            Booking Details
                        </h1>

                        <p>
                            Track your booked plot, payment history, due amount,
                            EMI status and complete customer ledger securely.
                        </p>

                    </div>
                </div>

                {{-- RIGHT LOGIN --}}
                <div class="col-12 col-lg-5">
                    <div class="login-box-dark">

                        <div class="login-card-glow"></div>

                        <div class="text-center mb-4 position-relative">
                            <img src="{{ asset('assets/images/admin.png') }}"
                                alt="Logo"
                                class="login-logo-dark">

                            <h2 class="fw-bold text-white mt-3 mb-1">
                                Customer Login
                            </h2>

                            <p class="text-white-50 small mb-0">
                                Sign in using your customer code
                            </p>
                        </div>

                        <form method="POST" action="{{ route('customer-panel.login.submit') }}" class="position-relative">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label text-white-50 small">
                                    Customer Code
                                </label>

                                <div class="dark-input-group">
                                    <i class="bi bi-person-badge"></i>

                                    <input type="text"
                                        name="customer_code"
                                        value="{{ old('customer_code') }}"
                                        class="form-control @error('customer_code') is-invalid @enderror"
                                        placeholder="Enter Customer Code"
                                        autofocus>
                                </div>

                                @error('customer_code')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label class="form-label text-white-50 small">
                                    Password
                                </label>

                                <div class="dark-input-group">
                                    <i class="bi bi-lock"></i>

                                    <input type="password"
                                        name="password"
                                        id="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Enter Password">

                                    <button type="button"
                                        class="password-toggle-dark"
                                        onclick="togglePassword()">
                                        <i class="bi bi-eye" id="toggleIcon"></i>
                                    </button>
                                </div>

                                @error('password')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="remember"
                                        id="remember">

                                    <label class="form-check-label small text-white-50" for="remember">
                                        Remember me
                                    </label>
                                </div>

                                <a href="#"
                                    class="small text-success text-decoration-none fw-semibold">
                                    Forgot password?
                                </a>
                            </div>

                            <button type="submit" class="btn login-btn-dark w-100">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Secure Login
                            </button>
                        </form>

                        <div class="text-center mt-4 position-relative">
                            <small class="text-white-50">
                                © {{ date('Y') }} Signature IT Software Designers
                            </small>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <style>
        .customer-login-wrapper {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            background: #020617;
            font-family: 'Source Sans 3', sans-serif;
        }

        .customer-login-bg {
            position: absolute;
            inset: 0;
            background: url('{{ asset('assets/images/customer.jpg') }}') center center / cover no-repeat;
            opacity: 0.42;
            transform: scale(1.02);
        }

        .customer-login-overlay {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 12% 15%, rgba(34, 197, 94, 0.36), transparent 28%),
                radial-gradient(circle at 78% 25%, rgba(16, 185, 129, 0.12), transparent 25%),
                linear-gradient(90deg, rgba(2, 6, 23, 0.98) 0%, rgba(2, 6, 23, 0.83) 48%, rgba(2, 6, 23, 0.97) 100%);
        }

        .customer-login-glow {
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            filter: blur(90px);
            opacity: .28;
        }

        .customer-login-glow-1 {
            background: #22c55e;
            top: 8%;
            left: 10%;
        }

        .customer-login-glow-2 {
            background: #14b8a6;
            right: 15%;
            bottom: 12%;
        }

        .customer-login-container {
            z-index: 2;
        }

        .customer-left-content {
            padding-left: 70px;
            max-width: 760px;
            color: #ffffff;
        }

        .brand-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 11px 22px;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(18px);
            color: #bbf7d0;
            font-weight: 800;
            margin-bottom: 34px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, .18);
        }

        .customer-left-content h1 {
            font-size: 60px;
            line-height: 1.06;
            font-weight: 900;
            letter-spacing: -1.6px;
            margin-bottom: 26px;
            text-shadow: 0 10px 30px rgba(0, 0, 0, .35);
        }

        .customer-left-content p {
            font-size: 18px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.78);
            max-width: 585px;
            margin-bottom: 42px;
        }

        .login-box-dark {
            position: relative;
            width: 100%;
            max-width: 430px;
            margin: auto;
            padding: 44px 36px 36px;
            border-radius: 30px;
            background:
                linear-gradient(180deg, rgba(15, 23, 42, 0.92), rgba(15, 23, 42, 0.78));
            border: 1px solid rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(28px);
            box-shadow:
                0 30px 80px rgba(0, 0, 0, 0.46),
                inset 0 1px 0 rgba(255, 255, 255, 0.08);
            overflow: hidden;
        }

        .login-card-glow {
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(34, 197, 94, .22);
            filter: blur(65px);
            top: -70px;
            right: -60px;
            pointer-events: none;
        }

        .login-logo-dark {
            max-width: 155px;
            max-height: 82px;
            object-fit: contain;
            filter: drop-shadow(0 12px 24px rgba(0, 0, 0, .38));
        }

        .dark-input-group {
            height: 54px;
            display: flex;
            align-items: center;
            padding: 0 15px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.105);
            border: 1px solid rgba(255, 255, 255, 0.17);
            transition: 0.25s ease;
        }

        .dark-input-group:focus-within {
            border-color: rgba(34, 197, 94, 0.85);
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.13);
            background: rgba(255, 255, 255, 0.13);
        }

        .dark-input-group i {
            color: #86efac;
            font-size: 18px;
            margin-right: 12px;
        }

        .dark-input-group .form-control {
            border: 0;
            outline: 0;
            box-shadow: none;
            background: transparent;
            color: #ffffff;
            padding-left: 0;
            font-size: 15px;
        }

        .dark-input-group .form-control::placeholder {
            color: rgba(255, 255, 255, 0.42);
        }

        .password-toggle-dark {
            border: 0;
            background: transparent;
            color: rgba(255, 255, 255, 0.65);
            padding: 0;
        }

        .password-toggle-dark i {
            margin: 0;
            color: rgba(255, 255, 255, 0.65);
        }

        .login-btn-dark {
            height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, #22c55e, #15803d);
            border: 1px solid rgba(134, 239, 172, 0.35);
            color: #ffffff;
            font-weight: 900;
            box-shadow: 0 16px 35px rgba(34, 197, 94, 0.28);
            transition: .25s ease;
        }

        .login-btn-dark:hover {
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 20px 45px rgba(34, 197, 94, 0.40);
        }

        .form-check-input {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.25);
        }

        .form-check-input:checked {
            background-color: #198754;
            border-color: #198754;
        }

        @media (max-width: 991px) {
            .customer-login-bg {
                opacity: 0.34;
            }

            .customer-login-overlay {
                background:
                    radial-gradient(circle at 20% 20%, rgba(34, 197, 94, 0.25), transparent 32%),
                    linear-gradient(180deg, rgba(2, 6, 23, 0.96), rgba(2, 6, 23, 0.92));
            }

            .login-box-dark {
                max-width: 440px;
                padding: 36px 24px;
            }
        }

        @media (max-width: 576px) {
            .login-box-dark {
                margin: 16px;
                border-radius: 24px;
            }
        }
    </style>

    <script>
        function togglePassword() {
            let passwordInput = document.getElementById('password');
            let toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>
@endsection