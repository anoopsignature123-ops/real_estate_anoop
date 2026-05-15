<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlotPaymentRequest;
use App\Services\PlotPaymentService;
use Illuminate\Http\Request;

class PlotPaymentController extends Controller
{
    public function __construct(
        private PlotPaymentService $plotPaymentService
    ) {}

    public function index(Request $request)
    {
        $bookings = $this->plotPaymentService->getAll();

        $selectedBooking = null;

        if ($request->filled('selected_booking')) {

            $selectedBooking = $this->plotPaymentService
                ->findById($request->selected_booking);

        }

        return view(
            'plot-payment.index',
            compact('bookings', 'selectedBooking')
        );
    }

    public function update(
        PlotPaymentRequest $request,
        $id
    ) {
        $this->plotPaymentService->updatePayment(
            $id,
            $request->validated()
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Payment updated successfully'
            );
    }
}
