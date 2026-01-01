<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tenant_id'             => 'required',
            // 'total_no_of_required_units'           => 'required',
            'property_id-*'         => 'required',
            'unit-*'                => 'required',
            // 'proposal_no'           => 'required',
            // 'proposal_date'           => 'required',
        ];
    }
}
