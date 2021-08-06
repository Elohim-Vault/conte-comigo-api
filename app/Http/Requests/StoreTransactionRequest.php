<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
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
            'value' => ['required'],
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'value.required' => "O valor é obrigatório.",
            'description.required' => 'A descrição é obrigatória.',
        ];
    }
}
