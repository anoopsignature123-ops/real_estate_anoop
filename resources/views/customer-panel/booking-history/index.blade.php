@extends('layouts.app')

@section('content')
    <div class="container-fluid customer-panel-page">
        <div class="customer-page-header">
            <div>
                <h4 class="mb-1">
                    <i class="bi bi-journal-bookmark text-success me-2"></i>
                    My Booking History
                </h4>
                <p class="mb-0">View your complete plot booking history.</p>
            </div>
            <span class="badge bg-success rounded-pill px-3 py-2">
                Total Booking: {{ $bookings->count() }}
            </span>
        </div>

        <div class="customer-section-card">
            <div class="customer-section-header">
                <h5 class="mb-0">Booking Records</h5>
            </div>

            <div class="customer-section-body">
                <div class="table-responsive">
                    <table id="bookingHistoryTable" class="table table-hover align-middle nowrap w-100 customer-table">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Booking Code</th>
                                <th>Project</th>
                                <th>Block</th>
                                <th>Plot No</th>
                                <th>Plot Area</th>
                                <th>Plot Rate</th>
                                <th>Total Cost</th>
                                <th>Booking Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $key => $booking)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><strong>{{ $booking->booking_code ?? 'N/A' }}</strong></td>
                                    <td>{{ $booking->project?->name ?? 'N/A' }}</td>
                                    <td>{{ $booking->block?->block ?? $booking->block?->name ?? 'N/A' }}</td>
                                    <td>
                                        <strong class="text-success">
                                            {{ $booking->plotDetail?->plot_number ?? $booking->plotDetail?->plot_no ?? 'N/A' }}
                                        </strong>
                                    </td>
                                    <td>{{ $booking->plot_area ?? $booking->plotDetail?->plot_area ?? 'N/A' }}</td>
                                    <td>&#8377;{{ number_format((float) ($booking->plot_rate ?? $booking->rate ?? 0), 2) }}</td>
                                    <td>
                                        <strong>
                                            &#8377;{{ number_format((float) ($booking->total_plot_cost ?? $booking->total_amount ?? 0), 2) }}
                                        </strong>
                                    </td>
                                    <td>
                                        {{ $booking->booking_date
                                            ? \Carbon\Carbon::parse($booking->booking_date)->format('d M Y')
                                            : ($booking->created_at ? $booking->created_at->format('d M Y') : 'N/A') }}
                                    </td>
                                    <td>
                                        <span class="badge bg-success rounded-pill px-3 py-2">Booked</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted py-4">
                                        No booking history found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#bookingHistoryTable').DataTable({
                pageLength: 10,
                ordering: true,
                searching: true,
                responsive: false,
                scrollX: true
            });
        });
    </script>
@endpush
