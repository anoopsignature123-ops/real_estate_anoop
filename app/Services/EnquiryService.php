<?php

namespace App\Services;

use App\Models\Enquiry;

class EnquiryService
{
    public function getAll()
    {
        // यहाँ enquiryType भी उत्सुकता से लोड (Eager Load) कर दिया है
        return Enquiry::with(['associate', 'source', 'enquiryType'])->latest()->get();
    }

    public function store($data)
    {
        return Enquiry::create($data);
    }

    public function findById($id)
    {
        // यहाँ भी enquiryType को जोड़ा है ताकि एडिट फॉर्म में पुरानी वैल्यू दिखे
        return Enquiry::with(['associate', 'source', 'enquiryType'])->findOrFail($id);
    }

    public function update($data, $id)
    {
        $enquiry = Enquiry::findOrFail($id); // डायरेक्ट ढूंढेंगे ताकि बार-बार रिलेशंस लोड न हों
        $enquiry->update($data);

        return $enquiry;
    }

    public function delete($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        return $enquiry->delete();
    }
}