<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payment Receipt</title>
    <style>
        @page { size: A4; margin: 18px; }
        * { box-sizing: border-box; }
        body {
            background: #f3f6f4;
            color: #111827;
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10.5px;
            margin: 0;
        }
        .sheet {
            background: #ffffff;
            border: 1px solid #cbded2;
            min-height: 1040px;
            overflow: hidden;
            position: relative;
        }
        .top-band {
            background: #f5f7f6;
            height: 124px;
            position: relative;
        }
        .top-dark {
            background: #111827;
            height: 70px;
            left: 0;
            position: absolute;
            top: 0;
            width: 62%;
        }
        .top-green {
            background: #0f7a45;
            height: 124px;
            position: absolute;
            right: -42px;
            top: 0;
            transform: skewX(-30deg);
            width: 48%;
        }
        .top-accent {
            background: #f59e0b;
            height: 124px;
            position: absolute;
            right: 182px;
            top: 0;
            transform: skewX(-30deg);
            width: 36px;
        }
        .brand {
            left: 34px;
            position: absolute;
            top: 24px;
            width: 48%;
        }
        .logo-cell {
            background: #ffffff;
            border-radius: 7px;
            height: 54px;
            text-align: center;
            vertical-align: middle;
            width: 78px;
        }
        .logo {
            max-height: 46px;
            max-width: 70px;
        }
        .brand-name {
            color: #ffffff;
            font-size: 21px;
            font-weight: bold;
            letter-spacing: .2px;
            line-height: 1.1;
            padding-left: 12px;
        }
        .brand-meta {
            color: #d1d5db;
            font-size: 8.5px;
            line-height: 1.4;
            padding-left: 12px;
            padding-top: 4px;
        }
        .receipt-title {
            color: #ffffff;
            font-size: 31px;
            font-weight: bold;
            letter-spacing: 1px;
            position: absolute;
            right: 34px;
            text-align: right;
            text-transform: uppercase;
            top: 48px;
            width: 260px;
        }
        .content {
            padding: 26px 34px 24px;
        }
        .info-table,
        .items,
        .totals-table,
        .footer-table {
            border-collapse: collapse;
            width: 100%;
        }
        .panel {
            border: 1px solid #d8eadf;
            vertical-align: top;
        }
        .panel-title {
            background: #0f7a45;
            color: #ffffff;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: .3px;
            padding: 7px 10px;
            text-transform: uppercase;
        }
        .panel-body {
            padding: 9px 10px;
        }
        .line {
            margin-bottom: 5px;
        }
        .label {
            color: #6b7280;
            display: inline-block;
            font-size: 9px;
            font-weight: bold;
            min-width: 92px;
            text-transform: uppercase;
        }
        .value {
            color: #111827;
            font-weight: bold;
        }
        .receipt-no {
            color: #0f7a45;
            font-size: 14px;
        }
        .section-title {
            color: #111827;
            font-size: 13px;
            font-weight: bold;
            margin: 22px 0 9px;
            text-transform: uppercase;
        }
        .section-title span {
            background: #f59e0b;
            display: inline-block;
            height: 9px;
            margin-right: 7px;
            width: 28px;
        }
        .items th {
            background: #111827;
            color: #ffffff;
            font-size: 10px;
            padding: 9px 8px;
            text-align: left;
            text-transform: uppercase;
        }
        .items td {
            border: 1px solid #d1d5db;
            padding: 8px;
            vertical-align: top;
        }
        .items .muted {
            color: #6b7280;
            display: block;
            font-size: 8.5px;
            margin-top: 3px;
        }
        .right { text-align: right; }
        .center { text-align: center; }
        .amount {
            color: #0f7a45;
            font-weight: bold;
        }
        .totals-wrap {
            margin-top: 18px;
        }
        .terms {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            line-height: 1.55;
            padding: 12px;
            vertical-align: top;
            width: 55%;
        }
        .totals {
            vertical-align: top;
            width: 45%;
        }
        .totals-table td {
            border: 1px solid #d1d5db;
            padding: 8px 10px;
        }
        .totals-table .grand td {
            background: #0f7a45;
            color: #ffffff;
            font-size: 13px;
            font-weight: bold;
        }
        .words {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #7c2d12;
            font-size: 10px;
            font-weight: bold;
            line-height: 1.45;
            margin-top: 12px;
            padding: 9px 10px;
        }
        .bottom {
            bottom: 0;
            left: 0;
            position: absolute;
            right: 0;
        }
        .signature {
            padding: 24px 34px 16px;
            text-align: right;
        }
        .signature span {
            border-top: 1px solid #111827;
            display: inline-block;
            font-weight: bold;
            padding-top: 8px;
            width: 170px;
        }
        .footer-bar {
            background: #111827;
            border-top: 5px solid #0f7a45;
            color: #ffffff;
            font-size: 9px;
            padding: 10px 34px;
        }
        .watermark {
            color: #0f7a45;
            font-size: 66px;
            font-weight: bold;
            opacity: .055;
            position: absolute;
            right: 22px;
            top: 430px;
            transform: rotate(-28deg);
        }
    </style>
</head>
<body>
@php
    $booking = $payment->customerBooking;
    $plotSale = $payment->plotSaleDetail;
    $paidAmount = (float) ($payment->paid_amount ?? $payment->booking_amount ?? 0);
    $totalCost = (float) ($plotSale?->total_plot_cost ?? $plotSale?->final_payable ?? 0);
    $dueAmount = (float) ($payment->due_amount ?? max(0, $totalCost - $paidAmount));
    $paymentAs = match ($payment->transaction_category) {
        'booking_fee' => 'Booking Amount',
        'emi_payment' => 'EMI Payment',
        'one_time' => 'One Time Payment',
        default => 'Payment',
    };
    $logoPath = isset($company->logo) ? public_path('storage/' . $company->logo) : public_path('assets/images/admin.png');
@endphp

<div class="sheet">
    <div class="watermark">REAL ESTATE</div>

    <div class="top-band">
        <div class="top-dark"></div>
        <div class="top-accent"></div>
        <div class="top-green"></div>

        <table class="brand">
            <tr>
                <td class="logo-cell">
                    <img src="{{ $logoPath }}" class="logo">
                </td>
                <td>
                    <div class="brand-name">{{ $company->name ?? 'Real Estate Company' }}</div>
                    <div class="brand-meta">
                        {{ $company->address ?? 'Company Address' }}<br>
                        {{ $company->email ?? 'N/A' }} | {{ $company->contact_no ?? 'N/A' }}
                    </div>
                </td>
            </tr>
        </table>

        <div class="receipt-title">Receipt</div>
    </div>

    <div class="content">
        <table class="info-table">
            <tr>
                <td class="panel" width="58%">
                    <div class="panel-title">Receipt To</div>
                    <div class="panel-body">
                        <div class="line"><span class="label">Customer</span><span class="value">{{ $booking?->primaryDetail?->name ?? $booking?->customer_name ?? 'N/A' }}</span></div>
                        <div class="line"><span class="label">Customer ID</span><span class="value">{{ $booking?->customer_code ?? 'N/A' }}</span></div>
                        <div class="line"><span class="label">Phone</span><span class="value">{{ $booking?->primaryDetail?->phone ?? $booking?->mobile ?? 'N/A' }}</span></div>
                        <div class="line"><span class="label">Address</span><span class="value">{{ $booking?->primaryDetail?->permanent_address ?? 'N/A' }}</span></div>
                    </div>
                </td>
                <td width="4%"></td>
                <td class="panel" width="38%">
                    <div class="panel-title">Receipt Detail</div>
                    <div class="panel-body">
                        <div class="line"><span class="label">Receipt No</span><span class="value receipt-no">{{ $payment->receipt_number ?? 'N/A' }}</span></div>
                        <div class="line"><span class="label">Manual No</span><span class="value">{{ $payment->manual_receipt_number ?? '-' }}</span></div>
                        <div class="line"><span class="label">Date</span><span class="value">{{ $payment->created_at?->format('d-M-Y') ?? 'N/A' }}</span></div>
                        <div class="line"><span class="label">Status</span><span class="value">{{ ucfirst($payment->payment_status ?? 'N/A') }}</span></div>
                    </div>
                </td>
            </tr>
        </table>

        <div class="section-title"><span></span>Plot & Payment Description</div>
        <table class="items">
            <thead>
                <tr>
                    <th width="34%">Description</th>
                    <th width="15%" class="center">Area</th>
                    <th width="15%" class="right">Rate</th>
                    <th width="18%" class="right">Total Cost</th>
                    <th width="18%" class="right">Paid Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $plotSale?->project?->name ?? 'Project N/A' }}</strong>
                        <span class="muted">
                            Booking: {{ $plotSale?->booking_code ?? $booking?->booking_code ?? 'N/A' }} |
                            Block: {{ $plotSale?->block?->block ?? 'N/A' }} |
                            Plot: {{ $plotSale?->plotDetail?->plot_number ?? 'N/A' }}
                        </span>
                    </td>
                    <td class="center">{{ number_format((float) ($plotSale?->plot_area ?? 0), 2) }} Sq.Ft.</td>
                    <td class="right">Rs. {{ number_format((float) ($plotSale?->plot_rate ?? 0), 2) }}</td>
                    <td class="right">Rs. {{ number_format($totalCost, 2) }}</td>
                    <td class="right amount">Rs. {{ number_format($paidAmount, 2) }}</td>
                </tr>
                <tr>
                    <td>
                        <strong>{{ $paymentAs }}</strong>
                        <span class="muted">
                            Plan: {{ $payment->plan_type === 'emi_plan' ? 'EMI Plan' : 'Full Payment' }}
                        </span>
                    </td>
                    <td class="center">-</td>
                    <td class="right">-</td>
                    <td class="right">Due</td>
                    <td class="right">Rs. {{ number_format($dueAmount, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="section-title"><span></span>Payment Method</div>
        <table class="info-table">
            <tr>
                <td class="panel" width="33%">
                    <div class="panel-body">
                        <span class="label">Mode</span>
                        <div class="value">{{ strtoupper(str_replace('_', ' / ', $payment->payment_mode ?? 'N/A')) }}</div>
                    </div>
                </td>
                <td class="panel" width="34%">
                    <div class="panel-body">
                        <span class="label">Bank / Branch</span>
                        <div class="value">{{ $payment->bank_name ?? 'N/A' }} {{ $payment->branch_name ? ' / '.$payment->branch_name : '' }}</div>
                    </div>
                </td>
                <td class="panel" width="33%">
                    <div class="panel-body">
                        <span class="label">Reference No</span>
                        <div class="value">{{ $payment->transaction_number ?? $payment->cheque_number ?? $payment->dd_number ?? 'N/A' }}</div>
                    </div>
                </td>
            </tr>
        </table>

        <table class="totals-wrap">
            <tr>
                <td class="terms">
                    <strong>Terms And Conditions</strong><br>
                    1. Receipt is subject to realization of cheque/DD.<br>
                    2. Booking/token amount is not refundable and not transferable.<br>
                    3. All disputes are subject to Lucknow jurisdiction only.
                    <div class="words">
                        Amount In Words: {{ amountInWords($paidAmount) }} Only
                    </div>
                </td>
                <td width="4%"></td>
                <td class="totals">
                    <table class="totals-table">
                        <tr>
                            <td>Total Plot Cost</td>
                            <td class="right">Rs. {{ number_format($totalCost, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Paid Amount</td>
                            <td class="right">Rs. {{ number_format($paidAmount, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Due Amount</td>
                            <td class="right">Rs. {{ number_format($dueAmount, 2) }}</td>
                        </tr>
                        <tr class="grand">
                            <td>Receipt Total</td>
                            <td class="right">Rs. {{ number_format($paidAmount, 2) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="bottom">
        <div class="signature">
            <span>Authorised Signature</span>
        </div>
        <div class="footer-bar">
            Thank you for your business. This is a computer generated receipt.
        </div>
    </div>
</div>
</body>
</html>
