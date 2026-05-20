@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">

        {{-- Header --}}
        <div class="mb-4">
            <h4 class="fw-bold mb-1">
                Edit Payment Details
            </h4>

            <small class="text-muted">
                Manage and update customer payment details
            </small>
        </div>


        {{-- Search Panel --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body p-4">

                <form method="GET" action="{{ route('edit-payment-details.index') }}" id="bookingFilterForm">

                    <div class="row g-3">

                        {{-- Customer --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Customer ID
                            </label>

                            <select name="selected_booking" id="customerSelect" class="form-select">

                                <option value="">
                                    Select Customer
                                </option>

                                @foreach ($bookings as $booking)
                                    <option value="{{ $booking->id }}"
                                        {{ request('selected_booking') == $booking->id ? 'selected' : '' }}>

                                        {{ $booking->customer_code }}
                                        -
                                        {{ $booking->primaryDetail?->name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>


                        {{-- Plot --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Plot No.
                            </label>

                            <input type="text" readonly class="form-control"
                                value="{{ $selectedBooking?->plotSaleDetail?->plotDetail?->plot_number }}">

                        </div>


                        {{-- Booking --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Booking ID
                            </label>

                            <input type="text" readonly class="form-control"
                                value="{{ $selectedBooking?->booking_code }}">

                        </div>

                    </div>

                </form>

            </div>

        </div>



        {{-- Edit Form --}}
        @if ($selectedBooking)
            @include('plot-payment.form')
        @endif



        {{-- Payment Listing --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>
                                    Booking ID
                                </th>

                                <th>
                                    Customer ID
                                </th>

                                <th>
                                    Customer Name
                                </th>

                                <th>
                                    Payment Type
                                </th>

                                <th>
                                    Paid Amount
                                </th>

                                <th>
                                    Pay Mode
                                </th>

                                <th>
                                    Date
                                </th>

                                <th>
                                    Receipt No
                                </th>

                                <th width="100">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($bookings as $booking)
                                @php
                                    $payment = $booking->payment;
                                @endphp

                                <tr>

                                    <td>
                                        {{ $booking->booking_code }}
                                    </td>

                                    <td>
                                        {{ $booking->customer_code }}
                                    </td>

                                    <td>
                                        {{ $booking->primaryDetail?->name }}
                                    </td>

                                    <td>
                                        {{ $payment?->plan_type == 'emi_plan' ? 'EMI Plan' : 'Full Payment' }}
                                    </td>

                                    <td>
                                        ₹{{ number_format($payment?->booking_amount ?? 0, 2) }}
                                    </td>

                                    <td>
                                        {{ strtoupper($payment?->payment_mode ?? '-') }}
                                    </td>

                                    <td>
                                        {{ $payment?->created_at?->format('d-M-Y') }}
                                    </td>

                                    <td>
                                        {{ $payment?->receipt_number }}
                                    </td>

                                    <td>

                                        <a href="{{ route('edit-payment-details.index', ['selected_booking' => $booking->id]) }}"
                                            class="btn btn-sm btn-success">

                                            <i class="fa fa-edit"></i>

                                        </a>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
@endsection


@include('plot-payment.script')
