<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SourceRequest extends FormRequest
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
        // Update के समय अपनी खुद की ID को unique validation से बाहर रखने के लिए
        $sourceId = $this->route('id');

        return [
            'name' => 'required|string|max:255|unique:sources,name,'.$sourceId,
        ];
    }
}
