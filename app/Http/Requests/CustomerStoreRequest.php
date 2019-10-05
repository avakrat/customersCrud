<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'email' => 'required|email|unique:customers,email,'.$this->id.',id',
            'firstname' => 'required|string|min:2|max:30',
            'lastname' => 'required|string|min:2|max:30',
            'phone' => 'required|string|min:9|max:30'
        ];
    }
}
