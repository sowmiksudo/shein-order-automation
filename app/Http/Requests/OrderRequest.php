<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            "order_id" => "string|required",
            "orders" => "array|min:1",
            'orders.*.goods_id'=>['required'],
            'orders.*.sku' => ['required'],
            'orders.*.order_details_id' => ['required'],
            'orders.*.order_id' => ['required'],
            'orders.*.quantity' => ['required', 'integer']
        ];
        return $rules;
    }
}
