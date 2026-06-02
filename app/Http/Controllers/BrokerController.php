<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrokerRequest;
use App\Models\Broker;
use App\Services\BrokerService;
use App\Services\LocationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BrokerController extends Controller
{
    public function __construct(
        protected BrokerService $brokerService,
        protected LocationService $locationService
    ) {}

    public function index(): View
    {
        $brokers = $this->brokerService->getBrokers();
        return view('brokers.index', compact('brokers'));
    }

    public function create(): View
    {
        return view('brokers.create', [
            'states' => $this->locationService->getStates(),
        ]);
    }

    public function store(BrokerRequest $request): RedirectResponse
    {
        $this->brokerService->createBroker($request->validated());

        return redirect()
            ->route('brokers.index')
            ->with('success', 'Broker created successfully.');
    }

    public function show($id): View
    {
        $broker = $this->brokerService->findBroker($id);
        return view('brokers.show', compact('broker'));
    }

    public function edit($id): View
    {
        return view('brokers.edit', [
            'broker' => $this->brokerService->findBroker($id),
            'states' => $this->locationService->getStates(),
        ]);
    }

    public function update(BrokerRequest $request, $id): RedirectResponse
    {
        $broker = $this->brokerService->findBroker($id);
        
        $this->brokerService->updateBroker($broker, $request->validated());

        return redirect()
            ->route('brokers.index')
            ->with('success', 'Broker updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        $broker = $this->brokerService->findBroker($id);
        $this->brokerService->deleteBroker($broker);

        return redirect()
            ->route('brokers.index')
            ->with('success', 'Broker deleted successfully.');
    }
}