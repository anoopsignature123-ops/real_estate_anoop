<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EnquiryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
        return [
            'associate_id' => 'nullable|exists:associates,id',
            'source_id' => 'nullable|exists:sources,id',
            'customer_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'dob' => 'nullable|date',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'plot_size' => 'nullable|string|max:255',
            'budget' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'followup_date' => 'nullable|date',
            'enquiry_types_id' => 'nullable|exists:enquiry_types,id',
        ];
    }
}
