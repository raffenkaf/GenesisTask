<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrder extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status_id' => 'integer',
            'user_id' => 'integer|min:1',
            'shipment_address_id' => 'integer|min:1',
        ];
    }
}
