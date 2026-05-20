<?php

namespace App\Services;

use App\Models\CustomerBooking;

class BookingLetterService
{
    public function getBookingDropdown()
    {
        return CustomerBooking::with([
            'primaryDetail',
        ])
            ->latest()
            ->get();
    }

    public function getBookings($bookingId = null)
    {
        $query = CustomerBooking::with([

            'primaryDetail',
            'plotSaleDetail.project',
            'plotSaleDetail.block',
            'plotSaleDetail.plotDetail',
            'payment',

        ]);

        if ($bookingId) {

            $query->where(
                'id',
                $bookingId
            );

        }

        return $query->latest()->get();
    }

    public function findBooking($id)
    {
        return CustomerBooking::with([

            'primaryDetail',
            'secondaryDetail',
            'nomineeDetail',

            'plotSaleDetail.project',
            'plotSaleDetail.block',
            'plotSaleDetail.plotDetail',

            'payment',
            'payments',

            'associate',

        ])->findOrFail($id);
    }
}
