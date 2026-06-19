@extends('layouts.app')

@section('content')
    @php
        $primary = $customer->primaryDetail;
        $contact = $primary?->correspondenceDetail;

        $customerName = $primary?->name ?? $customer->customer_name ?? 'Customer';
        $email = $contact?->email ?? 'N/A';
        $mobile = $contact?->mobile_number ? '+91 ' . $contact->mobile_number : 'N/A';
        $address = $primary?->permanent_address ?? 'N/A';
    @endphp

    <div class="container-fluid customer-panel-page">
        <div class="customer-page-header">
            <div>
                <h4 class="mb-1">
                    <i class="bi bi-person-circle text-success me-2"></i>
                    My Profile
                </h4>
                <p class="mb-0">Customer personal information, booking summary and payment details.</p>
            </div>
            <span class="badge bg-success rounded-pill px-3 py-2">Customer</span>
        </div>

        <div class="customer-section-card">
            <div class="customer-section-body">
                <div class="d-flex align-items-center gap-3 pb-4 mb-4 border-bottom flex-wrap">
                    <div class="customer-avatar">
                        {{ strtoupper(substr($customerName, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">{{ $customerName }}</h4>
                        <p class="text-muted mb-2">
                            Customer Code:
                            <strong class="text-dark">{{ $customer->customer_code ?? 'N/A' }}</strong>
                        </p>
                        <span class="badge bg-light text-success border rounded-pill px-3 py-2">
                            {{ ucwords(str_replace('_', ' ', $customer->customer_type ?? 'Customer')) }}
                        </span>
                    </div>
                </div>

                <h5 class="fw-bold mb-3">Personal Information</h5>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="customer-info-card">
                            <small>Name</small>
                            <strong>{{ $customerName }}</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="customer-info-card">
                            <small>Customer Code</small>
                            <strong>{{ $customer->customer_code ?? 'N/A' }}</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="customer-info-card">
                            <small>Email</small>
                            <strong>{{ $email }}</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="customer-info-card">
                            <small>Mobile</small>
                            <strong>{{ $mobile }}</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="customer-info-card">
                            <small>Customer Type</small>
                            <strong>{{ ucwords(str_replace('_', ' ', $customer->customer_type ?? 'N/A')) }}</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="customer-info-card">
                            <small>Joined Date</small>
                            <strong>{{ $customer->created_at?->format('d M Y') ?? 'N/A' }}</strong>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="customer-info-card">
                            <small>Address</small>
                            <strong>{{ $address }}</strong>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold mb-3">Account Summary</h5>
                <div class="border rounded-4 overflow-hidden">
                    <div class="customer-summary-row">
                        <span class="text-muted fw-semibold">Total Bookings</span>
                        <strong>{{ $totalBooking }}</strong>
                    </div>
                    <div class="customer-summary-row">
                        <span class="text-muted fw-semibold">Total Plot Cost</span>
                        <strong>&#8377;{{ number_format($totalPlotCost, 2) }}</strong>
                    </div>
                    <div class="customer-summary-row">
                        <span class="text-muted fw-semibold">Total Paid Amount</span>
                        <strong class="text-success">&#8377;{{ number_format($totalPaid, 2) }}</strong>
                    </div>
                    <div class="customer-summary-row">
                        <span class="text-muted fw-semibold">Remaining Due Amount</span>
                        <strong class="text-danger">&#8377;{{ number_format($dueAmount, 2) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
