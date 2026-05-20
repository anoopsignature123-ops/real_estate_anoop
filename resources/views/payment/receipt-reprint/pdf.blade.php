<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Payment Receipt</title>

    <style>
        /* CSS Reset for PDF rendering */
        * {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }

        @page {
            size: A4;
            margin: 0;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 9px;
            color: #000;
            background-color: #fff;
        }

        .page-container {
            width: 100%;
            height: 100%;
            border-collapse: 10px;
            margin: 0;
            padding: 0;
        }

        .receipt-row>td {
            padding: 0 4%;
            vertical-align: middle;
            height: 48%;
        }

        .receipt-wrapper {
            border: 1px solid #000;
            /* padding: 12px 10px; */
            padding: 10px;
            width: 100%;
            display: block;

        }

        .copy-title {

            text-align: right;
            font-size: 8.5px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: top;
        }

        .logo {
            width: 65px;
        }

        .company-section {
            text-align: right;
            line-height: 11px;
        }

        .company-name {
            font-size: 15px;
            font-weight: bold;
            line-height: 16px;
        }

        .reg-row {
            font-weight: bold;
            margin-top: 2px;
            font-size: 10px;
        }

        .receipt-title {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            text-decoration: underline;
            margin: 3px 0;
            letter-spacing: 0.5px;
            line-height: 12px;
        }

        .top-row {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        .top-row td {
            font-weight: bold;
            font-size: 9px;
            line-height: 11px;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
        }

        .details-table td {
            padding: 1.5px 0;
            vertical-align: top;
            font-size: 9px;
        }

        .label {
            font-weight: bold;
            width: 110px;
            font-size: 8.5px;
        }

        .value-bold {
            font-weight: bold;
        }

        .space {
            width: 25px;
        }

        .note-box {
            border-top: 1px solid #000;
            margin-top: 6px;
            padding-top: 4px;
            font-size: 8.5px;
            line-height: 11px;
            font-weight: bold;
        }

        .signature {
            text-align: right;
            margin-top: 1px;
            font-weight: bold;
            font-size: 8.5px;
        }

        .divider-row {
            height: 2% !important;
        }

        .divider-row td {
            padding: 0 4% !important;
        }

        .divider {
            border-top: 1px dashed #000;
            width: 100%;
            height: 1px;
        }
    </style>
</head>

<body>

    @php
        $booking = $payment->customerBooking;
        $plotSale = $booking?->plotSaleDetail;
    @endphp

    <table class="page-container">
        @foreach (['Customer Copy', 'Office Copy'] as $index => $copy)
            <tr class="receipt-row">
                <td>
                    <div class="receipt-wrapper">

                        <div class="copy-title">
                            {{ $copy }}
                        </div>

                        <table class="header-table">
                            <tr>
                                <td width="30%">
                                    <img src="{{ public_path('assets/images/admin.png') }}" class="logo">
                                </td>
                                <td width="70%" class="company-section">
                                    <div class="company-name">Sani Infra Height</div>
                                    <div style="margin-top: 4px;"><strong>Email Id:</strong> SaniInfra@gmail.com</div>
                                    <div><strong>Website:</strong> www.abc.com</div>
                                    <div><strong>Mob:</strong> +91 9878789786</div>
                                </td>
                            </tr>
                        </table>

                        <div class="reg-row">
                            Registration No. : {{ $booking->customer_code ?? 'U70200UP2020PTC127030' }}
                        </div>

                        <div class="receipt-title">
                            PAYMENT RECEIPT
                        </div>

                        <table class="top-row">
                            <tr>
                                <td>
                                    Receipt No : {{ $payment->receipt_number ?? 'PRS0000003' }}<br>
                                    S.No : {{ $payment->id ?? '3' }}
                                </td>
                                <td align="right" valign="top">
                                    Receipt Date :
                                    {{ $payment->created_at ? $payment->created_at->format('d/m/Y') : '20/03/2026' }}
                                </td>
                            </tr>
                        </table>

                        <table class="details-table">
                            <tr>
                                <td class="label">Booking Id :</td>
                                <td class="value-bold" width="35%">{{ $booking->booking_code ?? 'PRS0000003' }}</td>
                                <td class="space"></td>
                                <td class="label">Aadhar No. :</td>
                                <td class="value-bold" width="35%">N/A</td>
                            </tr>
                            <tr>
                                <td class="label">Project :</td>
                                <td class="value-bold">{{ $plotSale?->project?->name ?? 'Rajgharana' }}</td>
                                <td class="space"></td>
                                <td class="label">Plot No. :</td>
                                <td class="value-bold">{{ $plotSale?->plotDetail?->plot_number ?? 'A-1' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Block :</td>
                                <td class="value-bold">{{ $plotSale?->block?->block ?? 'A' }}</td>
                                <td class="space"></td>
                                <td class="label">Area :</td>
                                <td class="value-bold">
                                    {{ $plotSale?->plot_area ? number_format($plotSale->plot_area, 2) : '1000.00' }}
                                    Sq.Ft.
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Customer's Name :</td>
                                <td class="value-bold">{{ $booking->primaryDetail?->name ?? 'Santosh Kumar' }}</td>
                                <td class="space"></td>
                                <td class="label"></td>
                                <td class="value"></td>
                            </tr>
                            <tr>
                                <td class="label">Address :</td>
                                <td class="value-bold">{{ $booking->primaryDetail?->permanent_address ?? '' }}</td>
                                <td class="space"></td>
                                <td class="label">Plot Rate :</td>
                                <td class="value-bold">
                                    Rs. {{ $plotSale?->plot_rate ? number_format($plotSale->plot_rate, 2) : '899.00' }}
                                    /Sq.Ft.
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Plot Location :</td>
                                <td class="value-bold">{{ $plotSale?->plotDetail?->location ?? 'Normal' }}</td>
                                <td class="space"></td>
                                <td class="label">Payment Status :</td>
                                <td class="value-bold">{{ ucfirst($payment->payment_status ?? 'Clear') }}</td>
                            </tr>
                            <tr>
                                <td class="label">Plot Cost :</td>
                                <td class="value-bold">
                                    {{ $plotSale?->plot_cost ? number_format($plotSale->plot_cost, 2) : '899000.00' }}
                                </td>
                                <td class="space"></td>
                                <td class="label">Plc Amount :</td>
                                <td class="value-bold">
                                    Rs. {{ $plotSale?->plc_amount ? number_format($plotSale->plc_amount, 2) : '0.00' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Booking Amount :</td>
                                <td class="value-bold">
                                    {{ $payment->booking_amount ? number_format($payment->booking_amount, 2) : '49000.00' }}
                                </td>
                                <td class="space"></td>
                                <td class="label">Paid Amount :</td>
                                <td class="value-bold">
                                    Rs.
                                    {{ $payment->booking_amount ? number_format($payment->booking_amount, 2) : '49000.00' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Discount :</td>
                                <td class="value-bold">
                                    Rs.
                                    {{ $plotSale?->coupon_discount ? number_format($plotSale->coupon_discount, 2) : '50000.00' }}
                                </td>
                                <td class="space"></td>
                                <td class="label">In Words (Rs.) :</td>
                                <td class="value-bold">
                                    {{ isset($payment->booking_amount) ? amountInWords($payment->booking_amount) : 'Forty Nine Thousand' }}
                                    Only
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Other Charges :</td>
                                <td class="value-bold">
                                    {{ $plotSale?->other_charges ? number_format($plotSale->other_charges, 2) : '0.00' }}
                                </td>
                                <td class="space"></td>
                                <td class="label">Payment Mode :</td>
                                <td class="value-bold">{{ ucfirst($payment->payment_mode ?? 'Cash') }}</td>
                            </tr>
                            <tr>
                                <td class="label">Due Amount :</td>
                                <td class="value-bold">
                                    Rs. {{ $payment->due_amount ? number_format($payment->due_amount, 2) : '800000' }}
                                </td>
                                <td class="space"></td>
                                <td class="label"></td>
                                <td class="value"></td>
                            </tr>
                            <tr>
                                <td class="label">Payment As :</td>
                                <td class="value-bold">Booking Amount</td>
                                <td class="space"></td>
                                <td class="label"></td>
                                <td class="value"></td>
                            </tr>
                            <tr>
                                <td class="label">Payment date :</td>
                                <td class="value-bold">
                                    {{ $payment->created_at ? $payment->created_at->format('d/m/Y') : '20/03/2026' }}
                                </td>
                                <td class="space"></td>
                                <td class="label"></td>
                                <td class="value"></td>
                            </tr>
                            <tr>
                                <td class="label">Over due :</td>
                                <td class="value-bold">{{ $payment->over_due ?? '0' }}</td>
                                <td class="space"></td>
                                <td class="label"></td>
                                <td class="value"></td>
                            </tr>
                            <tr>
                                <td class="label">Remark :</td>
                                <td class="value-bold">{{ $payment->remark ?? '' }}</td>
                                <td class="space"></td>
                                <td class="label"></td>
                                <td class="value"></td>
                            </tr>
                        </table>

                        <div class="note-box">
                            Note -<br>
                            1- The receipt is subject to realization of cheque<br>
                            2- All Disputes Subjected to Lucknow Jurisdiction only.<br>
                            3- Booking / Token Amount not Refundable and not Transferable.

                            <div class="signature">
                                (Authorised Signature)
                            </div>
                        </div>

                    </div>
                </td>
            </tr>

            @if ($index == 0)
                <tr class="divider-row">
                    <td>
                        <div class="divider"></div>
                    </td>
                </tr>
            @endif
        @endforeach
    </table>

</body>

</html>
