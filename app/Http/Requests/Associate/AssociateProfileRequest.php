<?php

namespace App\Http\Requests\Associate;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssociateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $associateId = $this->user() ? $this->user()->id : auth()->id();

        return [
            'associate_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'father_name' => 'required|string|max:255',
            'dob' => 'required|date|before:today',
            'mobile_number' => ['required', 'string', 'digits:10',
                Rule::unique('associates', 'mobile_number')->ignore($associateId),
            ],
            'email' => ['required', 'email', 'max:255',
                Rule::unique('associates', 'email')->ignore($associateId),
            ],
            'pancard_number' => ['required', 'string', 'size:10',
                Rule::unique('associates', 'pancard_number')->ignore($associateId),
            ],
            'aadhar_number' => ['required', 'string', 'digits:12',
                Rule::unique('associates', 'aadhar_number')->ignore($associateId),
            ],
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:30',
            'ifsc_code' => 'required|string|max:15',
            'account_holder_name' => 'required|string|max:255',
            'nominee_name' => 'required|string|max:255',
            'nominee_relation' => 'required|string|max:100',
            'nominee_age' => 'required|integer|min:1|max:120',
            'photo' => [$associateId ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'id_proof_photo' => [$associateId ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'pancard_photo' => [$associateId ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'bank_passbook' => [$associateId ? 'nullable' : 'required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }
}
