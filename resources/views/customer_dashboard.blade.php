@extends('layouts.app')

@section('content')
    @php
        $primary = $customer->primaryDetail;
        $customerName = $primary?->name ?? $customer->customer_name ?? 'Customer';
    @endphp

    <div class="container-fluid customer-panel-page customer-dashboard">
        <div class="customer-hero mb-4">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge rounded-pill bg-white text-success px-3 py-2 mb-3">
                        Active Customer
                    </span>
                    <h2 class="fw-bold text-white mb-2">
                        Welcome Back, {{ $customerName }}
                    </h2>
                    <p class="text-white-75 mb-0">
                        Customer ID: <strong>{{ $customer->customer_code ?? 'N/A' }}</strong> &nbsp; | &nbsp;
                        Manage booking, plot details and payment history.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <div class="hero-mini-card">
                        <small>Total Plot Cost</small>
                        <h4>&#8377;{{ number_format($totalPlotCost, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="dash-card">
                    <div>
                        <small>Total Bookings</small>
                        <h3>{{ $totalBooking }}</h3>
                    </div>
                    <div class="dash-icon bg-success-subtle text-success">
                        <i class="bi bi-house-check"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="dash-card">
                    <div>
                        <small>Total Paid</small>
                        <h3 class="text-success">&#8377;{{ number_format($totalPaid, 2) }}</h3>
                    </div>
                    <div class="dash-icon bg-primary-subtle text-primary">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="dash-card">
                    <div>
                        <small>Due Amount</small>
                        <h3 class="text-danger">&#8377;{{ number_format($dueAmount, 2) }}</h3>
                    </div>
                    <div class="dash-icon bg-danger-subtle text-danger">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="dash-card">
                    <div>
                        <small>Pending Payments</small>
                        <h3 class="text-warning">{{ $pendingPayments }}</h3>
                    </div>
                    <div class="dash-icon bg-warning-subtle text-warning">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('customer-panel.profile') }}" class="quick-card">
                    <i class="bi bi-person-circle"></i>
                    <span>My Profile</span>
                </a>
            </div>

            <div class="col-xl-3 col-md-6">
                <a href="{{ route('customer-panel.booking-history') }}" class="quick-card">
                    <i class="bi bi-journal-bookmark"></i>
                    <span>Booking History</span>
                </a>
            </div>

            <div class="col-xl-3 col-md-6">
                <a href="{{ route('customer-panel.payment-history') }}" class="quick-card">
                    <i class="bi bi-wallet2"></i>
                    <span>Payment History</span>
                </a>
            </div>

            <div class="col-xl-3 col-md-6">
                <a href="{{ route('customer-panel.my-plot-booking') }}" class="quick-card">
                    <i class="bi bi-house-check"></i>
                    <span>My Plot Booking</span>
                </a>
            </div>
        </div>

        <div class="customer-section-card">
            <div class="customer-section-header">
                <div>
                    <h5 class="mb-1">Recent Plot Bookings</h5>
                    <p class="mb-0">Latest plot bookings linked with your account.</p>
                </div>
                <a href="{{ route('customer-panel.my-plot-booking') }}" class="btn btn-success btn-sm rounded-pill px-3">
                    View All
                </a>
            </div>

            <div class="table-responsive">
                <table class="table customer-table mb-0">
                    <thead>
                        <tr>
                            <th>Booking Code</th>
                            <th>Project</th>
                            <th>Plot No</th>
                            <th>Total Cost</th>
                            <th>Booking Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latestPlots as $plot)
                            <tr>
                                <td><strong>{{ $plot->booking_code ?? 'N/A' }}</strong></td>
                                <td>{{ $plot->project?->name ?? 'N/A' }}</td>
                                <td class="text-success fw-bold">
                                    {{ $plot->plotDetail?->plot_number ?? $plot->plotDetail?->plot_no ?? 'N/A' }}
                                </td>
                                <td>&#8377;{{ number_format($plot->total_plot_cost ?? $plot->final_payable ?? 0, 2) }}</td>
                                <td>
                                    {{ $plot->booking_date
                                        ? \Carbon\Carbon::parse($plot->booking_date)->format('d M Y')
                                        : ($plot->created_at ? $plot->created_at->format('d M Y') : 'N/A') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No recent plot booking found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
