<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            'date'              => [ 'date'],
            'vehicle_no'        => [ 'string', 'max:100'],
            'bilty_no'          => [ 'integer', 'min:0'],
            'account_id'        => [ 'string'],
            'item_id'           => [ 'string'],
            'no_of_crate'       => [ 'integer', 'min:0'],
            'quantity'          => [ 'integer', 'min:0'],
            'net_weight'        => [ 'integer', 'min:0'],
            'weight_difference' => [ 'integer'],
            'posted_weight'     => [ 'integer'],
            'average'           => ['integer', 'min:0'],
            'rate'              => ['integer', 'min:0'],
            'rate_detection'    => ['integer', 'min:0'],
            'final_rate'        => ['integer', 'min:0'],
            'gross_ammount'     => [ 'integer', 'min:0'],
            'fare'              => [ 'integer', 'min:0'],
            'other_charges'     => [ 'integer', 'min:0'],
            'net_ammount'       => ['required', 'integer', 'min:0'],
            'remarks'           => ['nullable', 'string'],
        ];
    }
}
