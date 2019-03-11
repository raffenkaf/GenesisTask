<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrder extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status_id' => 'nullable|integer',
            'user_id' => 'required|integer|min:1',
            'shipment_address_id' => 'nullable|integer|min:1',
        ];
    }
}
