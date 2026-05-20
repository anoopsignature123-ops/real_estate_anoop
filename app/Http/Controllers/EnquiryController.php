<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnquiryRequest;
use App\Models\Associate;
use App\Models\EnquiryType;
use App\Models\Source;
use App\Services\EnquiryService;

class EnquiryController extends Controller
{
    protected $service;

    public function __construct(EnquiryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $enquiries = $this->service->getAll();

        $associates = Associate::all();
        $sources = Source::all();
        $enquiry_types = EnquiryType::all();

        return view('enquiry.index', compact('enquiries', 'associates', 'sources', 'enquiry_types'));
    }

    public function store(EnquiryRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()
            ->route('enquiry.index')
            ->with('success', 'Enquiry Created Successfully');
    }

    public function edit($id)
    {
        $enquiry = $this->service->findById($id);

        return response()->json($enquiry);
    }

    public function update(EnquiryRequest $request, $id)
    {
        $this->service->update($request->validated(), $id);

        return redirect()
            ->route('enquiry.index')
            ->with('success', 'Enquiry Updated Successfully');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return redirect()
            ->route('enquiry.index')
            ->with('success', 'Enquiry Deleted Successfully');
    }
}
