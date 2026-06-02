<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FarmerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $farmer = $this->route('farmer');
        $farmerId = $farmer ? $farmer->id : null;

        return [
            // Farmer Information
            'broker_id'      => 'required|exists:brokers,id',
            'name'           => 'required|string|max:255',
            'mobile_number'  => ['required', 'digits_between:10,12', Rule::unique('farmers', 'mobile_number')->ignore($farmerId)],
            'caste'          => 'required|in:General,OBC,SC,ST',
            'city'           => 'required|string|max:100',
            'state'          => 'required|string|max:100',
            'pancard_number' => ['required', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/', Rule::unique('farmers', 'pancard_number')->ignore($farmerId)],
            'aadhar_number'  => ['required', 'digits:12', Rule::unique('farmers', 'aadhar_number')->ignore($farmerId)],
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
            'broker_id.required'            => 'Please select a broker.',
            'mobile_number.digits_between'  => 'Mobile number must be between 10 and 12 digits.',
            'mobile_number.unique'          => 'This mobile number is already registered.',
            'pancard_number.regex'          => 'Invalid PAN format (e.g., ABCDE1234F).',
            'aadhar_number.digits'          => 'Aadhaar number must be exactly 12 digits.',
            'aadhar_number.unique'          => 'This Aadhaar number is already registered.',
            'ifsc_code.regex'               => 'Invalid IFSC format.',
            'city.required'                 => 'Please select a city.',
            'state.required'                => 'Please select a state.',
        ];
    }
}