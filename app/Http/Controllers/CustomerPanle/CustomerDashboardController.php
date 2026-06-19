<?php

namespace App\Http\Controllers\CustomerPanle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function dashboard()
    {
        $customer = auth()->guard('customer')->user();

        $customer->load([
            'primaryDetail.correspondenceDetail',
            'plotSaleDetails.project',
            'plotSaleDetails.block',
            'plotSaleDetails.plotDetail',
            'payments',
        ]);

        $plots = $customer->plotSaleDetails;
        $payments = $customer->payments;

        $totalBooking = $plots->whereNotNull('booking_code')->count();
        $totalPlotCost = $plots->sum(fn ($plot) => $plot->total_plot_cost ?? $plot->final_payable ?? 0);
        $totalPaid = $payments->sum(fn ($payment) => $payment->paid_amount ?? $payment->booking_amount ?? 0);
        $dueAmount = max($totalPlotCost - $totalPaid, 0);
        $pendingPayments = $payments->where('payment_status', 'pending')->count();
        $latestPlots = $plots->sortByDesc('created_at')->take(3);

        return view('customer_dashboard', compact(
            'customer',
            'plots',
            'payments',
            'totalBooking',
            'totalPlotCost',
            'totalPaid',
            'dueAmount',
            'pendingPayments',
            'latestPlots'
        ));
    }

}
