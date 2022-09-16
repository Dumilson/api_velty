<?php

namespace App\Http\Requests\RoomTyping;

use Illuminate\Foundation\Http\FormRequest;

class RequestRoomTyping extends FormRequest
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
            'name_typing' => 'required',
            'description' => 'required',
        ];
    }
}
