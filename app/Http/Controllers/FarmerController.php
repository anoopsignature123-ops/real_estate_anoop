<?php

namespace App\Http\Controllers;

use App\Http\Requests\FarmerRequest;
use App\Models\Broker;
use App\Services\FarmerService;
use App\Services\LocationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FarmerController extends Controller
{
    public function __construct(
        protected FarmerService $farmerService,
        protected LocationService $locationService
    ) {}

    public function getCities(int $stateId): JsonResponse
    {
        return response()->json(
            $this->locationService->getCities($stateId)
        );
    }

    public function index(): View
    {
        return view('farmers.index', [
            'farmers' => $this->farmerService->getFarmers(),
        ]);
    }

    public function create(): View
    {
        return view('farmers.create', [
            'brokers' => Broker::latest()->get(),
            'states' => $this->locationService->getStates(),
        ]);
    }

    public function store(FarmerRequest $request): RedirectResponse
    {
        $this->farmerService->createFarmer($request->validated());

        return redirect()
            ->route('farmers.index')
            ->with('success', 'Farmer created successfully.');
    }

    public function show(int $id): View
    {
        return view('farmers.show', [
            'farmer' => $this->farmerService->findFarmer($id),
        ]);
    }

    public function edit(int $id): View
    {
        return view('farmers.edit', [
            'farmer' => $this->farmerService->findFarmer($id),
            'brokers' => Broker::latest()->get(),
            'states' => $this->locationService->getStates(),
        ]);
    }

    public function update(FarmerRequest $request, int $id): RedirectResponse
    {
        $farmer = $this->farmerService->findFarmer($id);

        $this->farmerService->updateFarmer($farmer, $request->validated());

        return redirect()
            ->route('farmers.index')
            ->with('success', 'Farmer updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $farmer = $this->farmerService->findFarmer($id);

        $this->farmerService->deleteFarmer($farmer);

        return redirect()
            ->route('farmers.index')
            ->with('success', 'Farmer deleted successfully.');
    }
}