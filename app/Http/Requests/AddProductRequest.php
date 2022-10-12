<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'price' => 'required|numeric',
            'images' => 'required|array|min:2|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'brand' => 'required',
            'category' => 'required',
            'description' => 'required|max:500',
            'quantity' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' =>  __('validation.required', ['attribute' => 'name']),
            'name.min' => __('validation.min', ['attribute' => 'name']),
            'name.max' => __('validation.max', ['attribute' => 'name']),
            'price.required' =>  __('validation.required', ['attribute' => 'price']),
            'price.numeric' =>  __('validation.numeric', ['attribute' => 'price']),
            'images.required' =>  __('validation.required', ['attribute' => 'image']),
            'images.array'  =>  __('validation.array', ['attribute' => 'image']),
            'images.max' =>  __('validation.max', ['attribute' => 'image']),
            'images.min' =>  __('validation.min', ['attribute' => 'image']),
            'images.*.image' =>  __('validation.image', ['attribute' => 'image']),
            'images.*.mimes' =>  __('validation.mimes', ['attribute' => 'image']),
            'images.*.max' => __('validation.max', ['attribute' => 'image']),
            'description.required' => __('validation.required', ['attribute' => 'description']),
            'description.max' => __('validation.max', ['attribute' => 'description']),
            'quantity.required' => __('validation.required', ['attribute' => 'quantity']),
            'quantity.integer' => __('validation.integer', ['attribute' => 'quantity']),
            'brand.required' => __('validation.required', ['attribute' => 'brand']),
            'category.required' => __('validation.required', ['attribute' => 'category']),
        ];
    }
}
