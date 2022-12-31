<?php

namespace App\Http\Requests\Master\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'product_code'    => [Rule::unique('products', 'products_code')],
            'product_name'    => 'required',
            'product_price'   => 'required',
            'supplier_code'   => 'required',
            'category_code'   => 'required',
            'type_product'    => 'nullable',
            'model_code'      => 'nullable',
            'brand_code'      => 'nullable',
            'levelAttribute'  => 'nullable',
            'detailAttribute' => 'nullable',
            'product_picture' => 'nullable',

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
            'supplier_name.required' => 'Supplier Name must be filled in.',
            'product_name.required'  => ' Product name must be filled in.',
            'product_price.required' => ' Product Pricemust be filled in.',
            'supplier_code.required' => ' Supplier must be filled in.',
            'category_code.required' => ' Category must be filled in.',
            'model_code'             => ' Model must be filled in.',
            'brand_code'             => ' Brand must be filled in.',
            'levelAttribute'         => ' must be filled in.',
            'detailAttribute'        => ' must be filled in.',
            'product_picture'        => ' must be filled in.',

        ];
    }
}
