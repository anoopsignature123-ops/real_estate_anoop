<?php

namespace App\Services;

use App\Models\Farmer;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class FarmerService
{
    public function getFarmers(): Collection
    {
        return Farmer::with(['bankDetail', 'broker'])->latest()->get();
    }

    public function findFarmer(int $id): Farmer
    {
        return Farmer::with(['bankDetail', 'broker', 'cityName', 'stateName'])->findOrFail($id);
    }

    public function createFarmer(array $data): Farmer
    {
        return DB::transaction(function () use ($data) {
            $farmer = Farmer::create([
                'broker_id'     => $data['broker_id'],
                'name'          => $data['name'],
                'caste'         => $data['caste'],
                'mobile_number' => $data['mobile_number'],
                'city'          => $data['city'],
                'state'         => $data['state'],
                'pancard_number'=> $data['pancard_number'],
                'aadhar_number' => $data['aadhar_number'],
                'address'       => $data['address'],
            ]);

            $farmer->bankDetail()->create([
                'bank_name'           => $data['bank_name'],
                'account_holder_name' => $data['account_holder_name'],
                'account_number'      => $data['account_number'],
                'ifsc_code'           => $data['ifsc_code'],
            ]);

            return $farmer;
        });
    }

    public function updateFarmer(Farmer $farmer, array $data): Farmer
    {
        return DB::transaction(function () use ($farmer, $data) {
            $farmer->update([
                'broker_id'     => $data['broker_id'],
                'name'          => $data['name'],
                'caste'         => $data['caste'],
                'mobile_number' => $data['mobile_number'],
                'city'          => $data['city'],
                'state'         => $data['state'],
                'pancard_number'=> $data['pancard_number'],
                'aadhar_number' => $data['aadhar_number'],
                'address'       => $data['address'],
            ]);

            $farmer->bankDetail()->updateOrCreate(
                ['farmer_id' => $farmer->id],
                [
                    'bank_name'           => $data['bank_name'],
                    'account_holder_name' => $data['account_holder_name'],
                    'account_number'      => $data['account_number'],
                    'ifsc_code'           => $data['ifsc_code'],
                ]
            );

            return $farmer;
        });
    }

    public function deleteFarmer(Farmer $farmer): bool
    {
        return $farmer->delete();
    }
}