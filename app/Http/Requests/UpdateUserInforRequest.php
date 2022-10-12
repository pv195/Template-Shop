<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInforRequest extends FormRequest
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
            'name' => 'max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'email', Rule::unique('users')->ignore($this->id),
            'phone' => 'numeric|min:10',
            'address' => 'max:255|min:3',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.max' =>  __('validation.max', ['attribute' => 'name']),
            'name.min' =>  __('validation.min', ['attribute' => 'name']),
            'image.mimes' =>  __('validation.mimes', ['attribute' => 'image']),
            'image.max' =>  __('validation.max', ['attribute' => 'image']),
            'email.email' =>  __('validation.email', ['attribute' => 'email']),
            'phone.numeric' =>  __('validation.numeric', ['attribute' => 'phone']),
            'phone.min' =>  __('validation.min', ['attribute' => 'phone']),
            'address.max' => __('validation.max', ['attribute' => 'address']),
            'address.min' => __('validation.min', ['attribute' => 'address']),
        ];
    }
}
