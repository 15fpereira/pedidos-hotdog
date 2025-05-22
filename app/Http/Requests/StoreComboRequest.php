<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComboRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:hotdog,pizza',
            'is_active' => 'boolean',
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
    
}
