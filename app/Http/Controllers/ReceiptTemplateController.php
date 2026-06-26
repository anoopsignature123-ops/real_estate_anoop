<?php

namespace App\Http\Controllers;

use App\Models\CustomerPayment;
use App\Models\ReceiptTemplate;
use App\Services\ReceiptPdfService;

class ReceiptTemplateController extends Controller
{
    public function index()
    {
        $templates = ReceiptTemplate::orderBy('sort_order')->orderBy('name')->get();
        $activeTemplate = $templates->firstWhere('is_active', true);
        $receiptCount = CustomerPayment::count();

        return view('payment.receipt-templates.index', compact('templates', 'activeTemplate', 'receiptCount'));
    }

    public function activate(ReceiptTemplate $receiptTemplate)
    {
        if (! view()->exists($receiptTemplate->view_path)) {
            return back()->with('error', 'Selected receipt template view file was not found.');
        }

        $receiptTemplate->activate();

        return back()->with('success', $receiptTemplate->name . ' activated successfully.');
    }

    public function preview(ReceiptTemplate $receiptTemplate, ReceiptPdfService $receiptPdfService)
    {
        if (! view()->exists($receiptTemplate->view_path)) {
            return back()->with('error', 'Selected receipt template view file was not found.');
        }

        $payment = CustomerPayment::with([
            'customerBooking.primaryDetail',
            'plotSaleDetail.project',
            'plotSaleDetail.block',
            'plotSaleDetail.plotDetail',
        ])->latest()->first();

        if (! $payment) {
            return back()->with('error', 'Preview ke liye koi receipt/payment record available nahi hai.');
        }

        return $receiptPdfService->preview($payment, $receiptTemplate);
    }
}