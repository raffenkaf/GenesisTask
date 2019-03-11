<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddress extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'door_number' => 'nullable|string|max:10',
            'house_number' => 'required|string|max:10',
            'street' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
        ];
    }
}
