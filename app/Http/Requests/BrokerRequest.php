<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrokerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $brokerId = $this->route('broker');

        return [
            // Personal Info
            'name'           => 'required|string|max:255',
            'mobile_number'  => ['required', 'digits_between:10,12', Rule::unique('brokers', 'mobile_number')->ignore($brokerId)],
            'state'          => 'required|string',
            'city'           => 'required|string',
            'pancard_number' => ['required', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/', Rule::unique('brokers', 'pancard_number')->ignore($brokerId)],
            'aadhar_number'  => ['required', 'digits:12', Rule::unique('brokers', 'aadhar_number')->ignore($brokerId)],
            'address'        => 'required|string|max:500',

            // Bank Details
            'bank_name'           => 'required|string|max:255',
            'account_holder_name' => 'required|string|max:255',
            'account_number'      => 'required|alpha_num|max:20',
            'ifsc_code'           => ['required', 'regex:/^[A-Z]{4}0[A-Z0-9]{6}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'             => 'Broker name is required.',
            'mobile_number.digits_between' => 'Mobile number must be between 10 and 12 digits.',
            'pancard_number.regex'      => 'Invalid PAN format (e.g., ABCDE1234F).',
            'aadhar_number.digits'      => 'Aadhaar must be exactly 12 digits.',
            'ifsc_code.regex'           => 'Invalid IFSC format.',
            'state.required'            => 'Please select a state.',
            'city.required'             => 'Please select a city.',
        ];
    }
}