<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'member_id'      => 'nullable|exists:members,id',
            'promotion_code' => 'nullable|string|exists:promotions,code',
            'payment_method' => 'required|string|in:cash,card,e-wallet,qris',
            'payment_status' => 'nullable|string|in:pending,completed,cancelled',
            'notes'          => 'nullable|string|max:255',
            'items'          => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.notes'      => 'nullable|string|max:100',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'items.required' => 'Keranjang tidak boleh kosong.',
            'items.*.product_id.exists' => 'Produk tidak valid.',
            'items.*.quantity.min' => 'Jumlah barang minimal 1.',
        ];
    }
}
