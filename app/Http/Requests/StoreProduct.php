<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:250',
            'description' => 'required|string',
            'price' => 'required|integer|min:1',
            'discount' => 'integer|min:0',
            'is_active' => 'boolean'
        ];
    }
}
