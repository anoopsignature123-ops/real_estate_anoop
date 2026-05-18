@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/report.css') }}">
@endpush

@section('content')
    <div class="container-fluid mt-4">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold report-title mb-0">
                    <i class="bi bi-calendar-event me-2"></i>
                    EMI Due Date Report
                </h3>
                <small class="text-muted">
                    Search and export EMI due reports
                </small>
            </div>
            <span class="badge badge-report">Total : {{ count($emis) }}</span>
        </div>
        {{-- Filter Card --}}
        <div class="card report-card mb-4">
            <div class="report-header">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-funnel me-2"></i>Filter Report
                </h5>
            </div>
            <div class="card-body">
                <form method="GET">
                    <div class="row g-3">
                        {{-- Customer Name --}}
                        <div class="col-md-3">
                            <label class="fw-semibold mb-1">Customer Name
                            </label>
                            <input type="text" name="customer_name" value="{{ request('customer_name') }}"
                                class="form-control" placeholder="Enter customer name">
                        </div>
                        {{-- Mobile --}}
                        <div class="col-md-3">
                            <label class="fw-semibold mb-1"> Mobile Number
                            </label>
                            <input type="text" name="mobile" value="{{ request('mobile') }}" class="form-control"
                                placeholder="Enter mobile">
                        </div>
                        {{-- Due Date --}}
                        <div class="col-md-3">
                            <label class="fw-semibold mb-1">Due Date</label>
                            <input type="date" name="due_date" value="{{ request('due_date') }}" class="form-control">
                        </div>
                        {{-- Buttons --}}
                        <div class="col-md-3 d-flex align-items-end gap-2">

                            <button type="submit" class="btn btn-primary">

                                <i class="bi bi-search me-1"></i>

                                Search

                            </button>


                            <a href="{{ route('admin.emi-due-date-report.index') }}" class="btn btn-secondary">

                                <i class="bi bi-arrow-clockwise me-1"></i>

                                Reset

                            </a>


                            <a href="{{ route('admin.emi-due-date-report.export', request()->all()) }}"
                                class="btn btn-success">

                                <i class="bi bi-file-earmark-excel me-1"></i>

                                Export

                            </a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- Report Table --}}
        <div class="card report-card">
            <div class="report-header">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-table me-2"></i>EMI Due Records
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="emiDueTable" class="table table-hover align-middle nowrap w-100">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Booking ID</th>
                                <th>Customer Name</th>
                                <th>Project Name</th>
                                <th>Plot No</th>
                                <th>Paid Amount</th>
                                <th>Payable Amount</th>
                                <th>Due Amount</th>
                                <th>Inst Paid/Unpaid</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($emis as $key => $emi)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        {{ $emi->customerBooking?->booking_code }}
                                    </td>
                                    <td>
                                        {{ $emi->customerBooking?->primaryDetail?->name ?? 'N/A' }}
                                    </td>
                                    <td>
                                        {{ $emi->plotSaleDetail?->project?->name ?? 'N/A' }}
                                    </td>
                                    <td>
                                        {{ $emi->plotSaleDetail?->plotDetail?->plot_number ?? 'N/A' }}
                                    </td>
                                    <td>
                                        ₹{{ number_format($emi->booking_amount, 2) }}
                                    </td>
                                    <td class="fw-semibold text-success">
                                        ₹{{ number_format($emi->net_payable_amount ?? 0, 2) }}
                                    </td>
                                    <td class="fw-semibold text-danger">
                                        ₹{{ number_format($emi->due_amount ?? 0, 2) }}
                                    </td>
                                    <td>
                                        {{ $emi->paid_installment }}/{{ $emi->emi_months }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        No Record Found
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
            $('#emiReportTable').DataTable({
                pageLength: 10,
                ordering: true,
                responsive: true
            });
        });
    </script>
@endpush
