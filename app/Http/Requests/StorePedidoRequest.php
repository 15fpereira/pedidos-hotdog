<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
{
        /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric|min:0',
            'payment_method' => 'required|in:pix,cartao,entrega',
            'status' => 'in:pendente,aprovado,em_preparo,saiu_entrega,finalizado,cancelado',
            'order_type' => 'required|in:delivery,retirada,local',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.addons' => 'nullable|array',
            'items.*.addons.*' => 'exists:addons,id',
        ];
    }
    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }
}
