<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            'value' => ['required', 'gt:0'],
            'description' => 'required',
            'account' => ['exists:accounts,nickname', 'required']
        ];
    }

    public function messages()
    {
        return [
            'account.exists' => "Essa conta não existe.",
            'value.required' => "O valor é obrigatório.",
            'description.required' => 'A descrição é obrigatória.',
            'account.required' => "O apelido da conta é obrigatório.",
            'value.gt' => "O valor do ganho precisa ser maior do que 0."
        ];
    }
}
