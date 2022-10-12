<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountProductRequest extends FormRequest
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
            'code' => 'required|max:12|min:5',
            'rate' => 'required|numeric',
            'product_id' => 'required',
            'discount_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'code.required' =>  __('validation.required', ['attribute' => 'name']),
            'code.min' => __('validation.min', ['attribute' => 'name']),
            'code.max' => __('validation.max', ['attribute' => 'name']),
            'rate.required' =>  __('validation.required', ['attribute' => 'status']),
            'rate.numeric' =>  __('validation.numeric', ['attribute' => 'status']),
            'product_id.required' =>  __('validation.required', ['attribute' => 'status']),
            'discount_id.required' =>  __('validation.required', ['attribute' => 'status']),
        ];
    }
}

