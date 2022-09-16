<?php

namespace App\Http\Requests\Building;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreBuilding extends FormRequest
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
            'building_name' => 'required',
            'descrption' => 'required',
            'cep' => 'required|formato_cep',
            'number' => 'required',
            'images.*' => 'required|mimes:jpg,jpeg,png,JPG,PNG,JPEG|max:6291456',
            'value_for_minute' => 'required',
            'id_typing'
        ];
    }
}
