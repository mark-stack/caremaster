<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeValidationRequest extends FormRequest
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
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'company_id' => 'required',
            'email' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:191',
        ];
    }
}
