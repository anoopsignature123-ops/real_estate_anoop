<?php

namespace App\Services;

use App\Models\CustomerPayment;

class ReceiptReprintService
{
    public function __construct(private ReceiptPdfService $receiptPdfService) {}

    public function search($plotId, $customerBookingId)
    {
        return CustomerPayment::with([
            'customerBooking.primaryDetail',
            'plotSaleDetail.project',
            'plotSaleDetail.block',
            'plotSaleDetail.plotDetail',
        ])
            ->where('customer_booking_id', $customerBookingId)
            ->whereHas('plotSaleDetail', function ($query) use ($plotId) {
                $query->where('plot_detail_id', $plotId);
            })
            ->latest()
            ->get();
    }

    public function downloadPdf($paymentId)
    {
        $payment = CustomerPayment::with([
            'customerBooking.primaryDetail',
            'plotSaleDetail.project',
            'plotSaleDetail.block',
            'plotSaleDetail.plotDetail',
        ])->findOrFail($paymentId);

        return $this->receiptPdfService->download($payment);
    }
}
