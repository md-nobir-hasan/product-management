<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateColorRequest extends FormRequest
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
        $id = $this->color->id;
        return [
            'name' => 'nullable|string|max:255|unique:colors,name,'.$id,
            'rgb_code' => ['nullable','string','max:6',"unique:colors,rgb_code,$id"]
        ];
    }
}
