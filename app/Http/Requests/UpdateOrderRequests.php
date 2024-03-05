<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequests extends FormRequest
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
            'order.*.id' => ['required', 'integer',"exists:orders,id"],
            'order.*.qty' => ['required', 'integer'],
            'order.*.selling_price' => ['required', 'numeric', 'max:99999999', 'min:0'],
            'order.*.order_discount' => ['required', 'numeric', 'max:99999999', 'min:-999999'],
            'order.*.final_price' => ['required', 'numeric', 'max:99999999', 'min:0'],
            'order.*.branch_id' => ['required', 'exists:branches,id'],
            'order.*.order_status' => ['required', 'string'],
        ];
    }
}
