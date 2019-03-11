<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'string|max:250',
            'description' => 'string',
            'discount' => 'integer|min:0',
            'is_active' => 'boolean'
        ];
    }
}
