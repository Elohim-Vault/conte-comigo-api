<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGainRequest extends FormRequest
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
            'value' => 'required',
            'description' => 'required',
            'account' => 'exists:accounts,nickname'
        ];
    }

    public function messages()
    {
        return [
            'account.exists' => "Essa conta não existe.",
            'value.required' => "O campo descrição não foi preenchido",
            'description.required' => 'O campo valor não foi preenchido'
        ];
    }
}
