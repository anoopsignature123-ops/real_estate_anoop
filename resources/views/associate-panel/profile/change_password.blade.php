@extends('layouts.app')

@push('title')
    Associate Panel |  Change Password
@endpush
@section('content')
    <div class="container-fluid mt-4 transaction-page">
        <form method="POST" action="{{ route('associate-panel.update-password') }}">
            @csrf

            <div class="transaction-hero mb-4">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <span class="transaction-icon"><i class="bi bi-shield-lock"></i></span>
                        <div>
                            <span class="text-success fw-bold text-uppercase small">Account Security</span>
                            <h3 class="fw-bold mb-1 text-dark">Change Password</h3>
                            <p class="text-muted mb-0 small">Update your password securely and keep your associate account protected.</p>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('associate-panel.view-profile') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-1"></i> Update Password
                        </button>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success border-0 shadow-sm">
                    <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm">
                    <strong>Please fix the following:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-4">
                <div class="col-xl-5">
                    <div class="transaction-card h-100">
                        <div class="transaction-card-body">
                            <div class="transaction-section-title">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="transaction-section-title-icon"><i class="bi bi-info-circle"></i></span>
                                    <div>
                                        <h5 class="fw-bold mb-1">Security Guidelines</h5>
                                        <small class="text-muted">Use a strong password and keep it private.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="customer-receipt-line">
                                <span>Minimum Length</span>
                                <strong>8 characters</strong>
                            </div>
                            <div class="customer-receipt-line">
                                <span>Recommended Mix</span>
                                <strong>Letters, numbers and symbols</strong>
                            </div>
                            <div class="customer-receipt-line">
                                <span>Avoid</span>
                                <strong>Name, mobile number, date of birth</strong>
                            </div>

                            <div class="alert alert-warning border-0 mt-4 mb-0">
                                <i class="bi bi-exclamation-triangle me-1"></i>
                                After changing your password, you will be logged out and must sign in again.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7">
                    <div class="transaction-card">
                        <div class="transaction-card-body">
                            <div class="transaction-section-title">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="transaction-section-title-icon"><i class="bi bi-key"></i></span>
                                    <div>
                                        <h5 class="fw-bold mb-1">Update Password</h5>
                                        <small class="text-muted">Enter current password and set a new password.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Current Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="current_password" id="current_password"
                                            class="form-control @error('current_password') is-invalid @enderror"
                                            placeholder="Enter current password" required>
                                        <button class="btn btn-outline-success toggle-password" type="button" data-target="current_password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">New Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="new_password" id="new_password"
                                            class="form-control @error('new_password') is-invalid @enderror"
                                            placeholder="Enter new password" required>
                                        <button class="btn btn-outline-success toggle-password" type="button" data-target="new_password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted">Minimum 8 characters.</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Confirm New Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                            class="form-control" placeholder="Re-enter new password" required>
                                        <button class="btn btn-outline-success toggle-password" type="button" data-target="new_password_confirmation">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="transaction-card mt-4">
                        <div class="transaction-card-body">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div>
                                    <h5 class="fw-bold mb-1">Save Password Changes</h5>
                                    <small class="text-muted">Your session will end after a successful password update.</small>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('associate-panel.view-profile') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                                    <button type="submit" class="btn btn-success px-5">
                                        <i class="bi bi-check-circle me-1"></i> Update Password
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = document.getElementById(this.dataset.target);
                const icon = this.querySelector('i');

                input.type = input.type === 'password' ? 'text' : 'password';
                icon.classList.toggle('bi-eye');
                icon.classList.toggle('bi-eye-slash');
            });
        });
    </script>
@endpush
