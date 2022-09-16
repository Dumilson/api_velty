<?php

namespace App\Http\Requests\Costumer;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreCostumer extends FormRequest
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
            'social_reason' =>'required',
            'name_customer' =>'required',
            'cnpj' =>'required|unique:customer|cnpj',
            'email' =>'required|email|unique:customer',
            'birth_date' =>'required',
            'cep' => 'required|formato_cep',
            'telephone' => 'required|telefone'
        ];
    }
}
