<?php

namespace App\Domain\User\Request;

use Illuminate\Foundation\Http\FormRequest;

class UserContactRequest extends FormRequest
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
            'user_id'=> 'required|integer|unique:user_contracts',
            'street_personal'=> 'required|string',
            'number_personal'=> 'required|string',
            'neighborhood_personal'=> 'required|string',
            'city_personal'=> 'required|string',
            'state_personal'=> 'required|string',
            'zipcode_personal'=> 'required|string',
            'phone_personal'=> 'required|string',
            'street_business'=> 'required|string',
            'number_business'=> 'required|string',
            'neighborhood_business'=> 'required|string',
            'city_business'=> 'required|string',
            'state_business'=> 'required|string',
            'zipcode_business'=> 'required|string',
            'phone_business'=> 'required|string'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [

        ];
    }
}
