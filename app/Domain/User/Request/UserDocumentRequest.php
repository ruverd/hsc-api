<?php

namespace App\Domain\User\Request;

use Illuminate\Foundation\Http\FormRequest;

class UserDocumentRequest extends FormRequest
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
            'user_id'=> 'required|integer|unique:user_documents',
            'cpf'=> 'required|string',
            'rg'=> 'required|string',
            'rg_emitter'=> 'required|string',
            'crm'=> 'required|string',
            'crm_emitter'=> 'required|string'
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
