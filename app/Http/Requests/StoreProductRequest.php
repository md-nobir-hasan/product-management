<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        return     [
            'title' => 'string|required|max:255',
            'code' => 'string|max:255',
            'inventory_cost' => 'required|numeric|max:9999999',
            'dollar_cost' => 'nullable|numeric|max:9999999',
            'other_cost' => 'nullable|numeric|max:9999999',
            'discount' => 'required|numeric|max:999999',
            'price' => 'required|numeric|max:9999999',
            'final_price' => 'required|numeric|max:9999999',
            'size_id' => 'nullable|exists:sizes,id',
            'color_id' => 'nullable|exists:colors,id',
            'branch_id' => 'nullable|exists:branches,id',
            'stock' => "required|numeric|max:99999",
            'photo' => 'string|required',
            'status' => 'nullable|in:active,inactive',
        ];
    }
}
