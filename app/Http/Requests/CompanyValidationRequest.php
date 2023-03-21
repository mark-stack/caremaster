<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            '_method' => 'nullable',
            'name' => 'required|string|max:191',
            'email' => 'nullable|string|max:191',
            'logo' => 'nullable',
            'website' => 'nullable|string|max:191',
        ];
    }
}
