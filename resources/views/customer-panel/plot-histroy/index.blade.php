@extends('layouts.app')

@section('content')
    <div class="container-fluid customer-panel-page">
        <div class="customer-page-header">
            <div>
                <h4 class="mb-1">
                    <i class="bi bi-house-check text-success me-2"></i>
                    My Plot Booking
                </h4>
                <p class="mb-0">View all your booked plots and related details.</p>
            </div>
            <span class="badge bg-success rounded-pill px-3 py-2">
                Total Plots: {{ $plots->count() }}
            </span>
        </div>

        <div class="row g-4">
            @forelse($plots as $plot)
                <div class="col-lg-6 col-xl-4">
                    <div class="customer-plot-card">
                        <div class="customer-plot-card-header">
                            <div class="d-flex justify-content-between align-items-center gap-3">
                                <div>
                                    <small class="text-muted d-block">Booking Code</small>
                                    <h6 class="fw-bold mb-0">{{ $plot->booking_code ?? 'N/A' }}</h6>
                                </div>
                                <span class="badge bg-success rounded-pill">Booked</span>
                            </div>
                        </div>

                        <div class="customer-plot-card-body">
                            <div class="mb-3">
                                <small class="text-muted">Project</small>
                                <div class="fw-semibold">{{ $plot->project?->name ?? 'N/A' }}</div>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted">Block</small>
                                <div class="fw-semibold">{{ $plot->block?->block ?? ($plot->block?->name ?? 'N/A') }}</div>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted">Plot Number</small>
                                <div class="fw-semibold text-success">
                                    {{ $plot->plotDetail?->plot_number ?? ($plot->plotDetail?->plot_no ?? 'N/A') }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <small class="text-muted">Plot Area</small>
                                    <div class="fw-semibold">{{ $plot->plot_area ?? 'N/A' }}</div>
                                </div>

                                <div class="col-6 mb-3">
                                    <small class="text-muted">Plot Rate</small>
                                    <div class="fw-semibold">&#8377;{{ number_format($plot->plot_rate ?? 0, 2) }}</div>
                                </div>

                                <div class="col-12">
                                    <small class="text-muted">Total Plot Cost</small>
                                    <div class="fw-bold fs-5 text-primary">
                                        &#8377;{{ number_format($plot->total_plot_cost ?? 0, 2) }}
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between gap-3">
                                <span class="text-muted">Booking Date</span>
                                <strong>
                                    {{ $plot->booking_date
                                        ? \Carbon\Carbon::parse($plot->booking_date)->format('d M Y')
                                        : ($plot->created_at ? $plot->created_at->format('d M Y') : 'N/A') }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="customer-empty-state">
                        <i class="bi bi-house-x fs-1 text-muted"></i>
                        <h5 class="mt-3">No Plot Booking Found</h5>
                        <p class="text-muted mb-0">You don't have any plot bookings yet.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
