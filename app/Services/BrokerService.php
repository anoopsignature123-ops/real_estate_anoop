<?php

namespace App\Services;

use App\Models\Broker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class BrokerService
{
    public function getBrokers(): Collection
    {
        return Broker::with('bankDetail')->latest()->get();
    }

    public function findBroker(int $id): Broker
    {
        return Broker::with('bankDetail', 'stateName', 'cityName')->findOrFail($id);
    }

    public function createBroker(array $data): Broker
    {
        return DB::transaction(function () use ($data) {
            $broker = Broker::create([
                'name' => $data['name'],
                'mobile_number' => $data['mobile_number'],
                'city' => $data['city'],
                'state' => $data['state'],
                'pancard_number' => $data['pancard_number'],
                'aadhar_number' => $data['aadhar_number'],
                'address' => $data['address'],
            ]);

            $broker->bankDetail()->create([
                'bank_name' => $data['bank_name'],
                'account_number' => $data['account_number'],
                'ifsc_code' => $data['ifsc_code'],
                'account_holder_name' => $data['account_holder_name'],
            ]);

            return $broker;
        });
    }

    public function updateBroker(Broker $broker, array $data): Broker
    {
        return DB::transaction(function () use ($broker, $data) {
            $broker->update([
                'name' => $data['name'],
                'mobile_number' => $data['mobile_number'],
                'city' => $data['city'],
                'state' => $data['state'],
                'pancard_number' => $data['pancard_number'],
                'aadhar_number' => $data['aadhar_number'],
                'address' => $data['address'],
            ]);

            $broker->bankDetail()->updateOrCreate(
                ['broker_id' => $broker->id],
                [
                    'bank_name' => $data['bank_name'],
                    'account_number' => $data['account_number'],
                    'ifsc_code' => $data['ifsc_code'],
                    'account_holder_name' => $data['account_holder_name'],
                ]
            );

            return $broker;
        });
    }

    public function deleteBroker(Broker $broker): bool
    {
        return $broker->delete();
    }
}