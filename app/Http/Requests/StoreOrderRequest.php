<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'container_price' => 'required',
            'town' => 'required',
            'status' => 'required',
            'container_type' => 'required',
            'type_1' => 'required',
            'type_2' => 'required',
            'type_3' => 'required',
            'type_4' => 'required',
            'type_5' => 'required',
            'type_6' => 'required',
            'type_7' => 'required',
            'description' => 'required',
            'passport_number' => 'required',
            'date_of_issue' => 'required',
            'passport_authority' => 'required',
            'passport_address' => 'required'
        ];
    }
}
