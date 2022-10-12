<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name' => 'required|max:255|unique:categories,name',
                ];
            }
            case 'PATCH':
            {
                return [
                    'name' => 'required|max:255|unique:categories,name,'.Request()->category,
                ];
            }
            default: break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required', ['attribute' => 'name']),
            'name.max' => __('validation.max', ['attribute' => 'name']),
            'name.unique' => __('validation.unique', ['attribute' => 'name']),
        ];
    }
}
