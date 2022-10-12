<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            'name' => 'required|max:255|min:5',
            'status' => 'required|numeric',
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ];
    }

    public function messages()
    {
        return [
            'name.required' =>  __('validation.required', ['attribute' => 'name']),
            'name.min' => __('validation.min', ['attribute' => 'name']),
            'name.max' => __('validation.max', ['attribute' => 'name']),
            'status.required' =>  __('validation.required', ['attribute' => 'status']),
            'status.numeric' =>  __('validation.numeric', ['attribute' => 'status']),
            'from.*' => 'Please enter the from date with format date(dd-MM-YYYY)',
            'to.*' => 'Please enter the to date greater than or equal to from date' ,
        ];
    }
}

