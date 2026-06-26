<?php

namespace App\Services;

use App\Models\Company;
use App\Models\CustomerPayment;
use App\Models\ReceiptTemplate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Schema;

class ReceiptPdfService
{
    private const DEFAULT_VIEW = 'payment.receipt-reprint.pdf';

    public function download(CustomerPayment $payment)
    {
        $pdf = $this->makePdf($payment, $this->activeTemplate());

        return $pdf->download(
            'receipt-' . ($payment->receipt_number ?? 'RCP-' . $payment->id) . '.pdf'
        );
    }

    public function preview(CustomerPayment $payment, ReceiptTemplate $template)
    {
        $pdf = $this->makePdf($payment, $template);

        return $pdf->stream('preview-' . $template->slug . '.pdf');
    }

    private function makePdf(CustomerPayment $payment, ?ReceiptTemplate $template)
    {
        $payment->loadMissing([
            'customerBooking.primaryDetail',
            'plotSaleDetail.project',
            'plotSaleDetail.block',
            'plotSaleDetail.plotDetail',
        ]);

        $company = Company::where('status', '1')->first();
        $view = $this->resolveView($template?->view_path);

        return Pdf::loadView($view, compact('payment', 'company', 'template'))->setPaper('A4');
    }

    private function activeTemplate(): ?ReceiptTemplate
    {
        if (! Schema::hasTable('receipt_templates')) {
            return null;
        }

        return ReceiptTemplate::where('status', 'active')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->first()
            ?: ReceiptTemplate::where('status', 'active')->orderBy('sort_order')->first();
    }

    private function resolveView(?string $viewPath): string
    {
        if ($viewPath && view()->exists($viewPath)) {
            return $viewPath;
        }

        return self::DEFAULT_VIEW;
    }
}