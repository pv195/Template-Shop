<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => ['required','regex:/(03|05|07|08|09|01[2|6|8|9])([0-9]{8})$/'],
            'password' =>'required|min:8|max:20',
            'confirm_password' =>'required_with:password|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' =>  __('validation.required',['attribute' => 'name']),
            'name.min' => __('validation.min',['attribute' => 'name']),
            'name.max' => __('validation.max',['attribute' => 'name']),
            'email.required' => __('validation.required',['attribute' => 'email']),
            'email.email' => __('validation.email',['attribute' => 'email']),
            'email.unique' => __('validation.unique',['attribute' => 'email']),
            'phone.required' => __('validation.required',['attribute' => 'phone']),
            'phone.regex' => __('validation.regex',['attribute' => 'phone']),
            'password.required' => __('validation.required',['attribute' => 'password']),
            'password.min' => __('validation.min',['attribute' => 'password']),
            'password.max' => __('validation.max',['attribute' => 'password']),
            'confirm_password.required_with' => __('validation.required_with',['attribute' => 'confirm_password']),
            'confirm_password.same' => __('validation.same',['attribute' => 'confirm_password']),
        ];
    }
}
