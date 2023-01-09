<?php

namespace App\Http\Requests\Master\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'supplier_code'    => [Rule::unique('suppliers', 'supplier_code')->ignore($this->supplier)],
            'supplier_name'    => 'required', 'string',
            'supplier_address' => 'required',
            'supplier_phone'   => 'required',
        ];
    }

    /**
     * Validation custom message.
     *
     * @return array<string>
     */
    public function messages(): array
    {
        return [
            'supplier_name.required'    => 'Supplier Name must be filled in.',
            'supplier_address.required' => 'Supplier Address must be filled in.',
            'supplier_phone.required'   => 'Supplier Phobe Number must be filled in.',

        ];
    }
}
