<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'imageNew' => 'array|max:4',
            'imageNew.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|max:500',
            'quantity' => 'required|integer',
            'brand' => 'required',
            'category' => 'required',
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
            'imageNew.array'  =>  __('validation.array', ['attribute' => 'image']),
            'imageNew.max' =>  __('Add up to 3 photos only', ['attribute' => 'image']),
            'imageNew.*.image' =>  __('validation.image', ['attribute' => 'image']),
            'imageNew.*.mimes' =>  __('validation.mimes', ['attribute' => 'image']),
            'imageNew.*.max' => __('validation.max', ['attribute' => 'image']),
            'description.required' => __('validation.required', ['attribute' => 'description']),
            'description.max' => __('validation.max', ['attribute' => 'description']),
            'quantity.required' => __('validation.required', ['attribute' => 'quantity']),
            'quantity.integer' => __('validation.integer', ['attribute' => 'quantity']),
            'brand.required' => __('validation.required', ['attribute' => 'brand']),
            'category.required' => __('validation.required', ['attribute' => 'category']),
        ];
    }
}
