@extends('layouts.app')

@section('content')
    <div class="container-fluid customer-panel-page">
        <div class="customer-page-header">
            <div>
                <h4 class="mb-1">
                    <i class="bi bi-cash-stack text-success me-2"></i>
                    My Payment History
                </h4>
                <p class="mb-0">View your complete payment transaction history.</p>
            </div>
            <span class="badge bg-success rounded-pill px-3 py-2">
                Total Payments: {{ $payments->count() }}
            </span>
        </div>

        <div class="customer-section-card">
            <div class="customer-section-header">
                <h5 class="mb-0">Payment Records</h5>
            </div>

            <div class="customer-section-body">
                <div class="table-responsive">
                    <table id="paymentHistoryTable" class="table table-hover align-middle nowrap w-100 customer-table">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Receipt No</th>
                                <th>Project</th>
                                <th>Plot No</th>
                                <th>Payment Type</th>
                                <th>Mode</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $key => $payment)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><strong>{{ $payment->receipt_number ?? 'N/A' }}</strong></td>
                                    <td>{{ $payment->plotSaleDetail?->project?->name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="fw-semibold text-success">
                                            {{ $payment->plotSaleDetail?->plotDetail?->plot_number
                                                ?? $payment->plotSaleDetail?->plotDetail?->plot_no
                                                ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>{{ ucwords(str_replace('_', ' ', $payment->plan_type ?? 'N/A')) }}</td>
                                    <td>{{ ucfirst($payment->payment_mode ?? 'N/A') }}</td>
                                    <td>
                                        <strong class="text-success">
                                            &#8377;{{ number_format($payment->paid_amount ?? 0, 2) }}
                                        </strong>
                                    </td>
                                    <td>
                                        {{ $payment->payment_date
                                            ? \Carbon\Carbon::parse($payment->payment_date)->format('d M Y')
                                            : $payment->created_at->format('d M Y') }}
                                    </td>
                                    <td>
                                        @if (($payment->payment_status ?? '') == 'cleared')
                                            <span class="badge bg-success rounded-pill">Cleared</span>
                                        @elseif(($payment->payment_status ?? '') == 'pending')
                                            <span class="badge bg-warning rounded-pill">Pending</span>
                                        @elseif(($payment->payment_status ?? '') == 'bounced')
                                            <span class="badge bg-danger rounded-pill">Bounced</span>
                                        @else
                                            <span class="badge bg-secondary rounded-pill">
                                                {{ ucfirst($payment->payment_status ?? 'N/A') }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted py-4">
                                        No payment history found.
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
            $('#paymentHistoryTable').DataTable({
                pageLength: 10,
                ordering: true,
                searching: true,
                responsive: false,
                scrollX: true
            });
        });
    </script>
@endpush
