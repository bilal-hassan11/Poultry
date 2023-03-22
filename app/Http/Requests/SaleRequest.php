<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'date'               => ['required', 'date'],
            'bill_no'            => ['string', 'max:100'],
            'account_id'         => ['required'],
            'item_id'            => ['required', 'string', 'max:250'],
            'vehicle_no'         => ['string'],
            'no_of_crate'        => ['required'],
            'rate'               => ['required', 'integer'],
            'quantity'           => ['required', 'integer'],
            'gross_ammount'      =>['required', 'integer'],
            'average'            => ['required', 'integer'],
            'net_ammount'        => ['required', 'integer'],
            'other_charges'     => [ 'integer'],
            'remarks'            => [ 'string'],
            
        ];
    }
}
