<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseChickRequest extends FormRequest
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
        return [
            'date'  => ['required', 'date'],
            'company_id'        => ['required', 'string', 'max:100'],
            'item_id'           => ['required', 'string', 'max:100'],
            'account_id'        => ['required', 'string', 'max:100'],
            'rate'              => ['required', 'integer'],
            'quantity'          => ['required', 'integer'],
            'net_ammount'       => ['required',' integer'],
            'status'            => ['required', 'in:available,not_available'],
            'remarks'           => ['nullable', 'max:10000'],
            'purchase_chick_id' => ['nullable', 'string', 'max:100']
        ];
    }
}
