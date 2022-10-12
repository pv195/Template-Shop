<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|max:255|min:3',
            'image' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'email' => 'required|email', Rule::unique('users')->ignore($this->id),
            'phone' => 'required|numeric|min:10',
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
            'name.required' =>  __('validation.required', ['attribute' => 'name']),
            'name.max' =>  __('validation.max', ['attribute' => 'name']),
            'name.min' =>  __('validation.min', ['attribute' => 'name']),
            'image.mimes' =>  __('validation.mimes', ['attribute' => 'image']),
            'image.max' =>  __('validation.max', ['attribute' => 'image']),
            'email.required' =>  __('validation.required', ['attribute' => 'email']),
            'email.email' =>  __('validation.email', ['attribute' => 'email']),
            'phone.required' =>  __('validation.required', ['attribute' => 'phone']),
            'phone.numeric' =>  __('validation.numeric', ['attribute' => 'phone']),
            'phone.min' =>  __('validation.min', ['attribute' => 'phone']),
        ];
    }
}
