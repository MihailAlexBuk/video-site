<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string',
            'product_image_1' => 'nullable|file',
            'product_image_2' => 'nullable|file',
            'product_image_3' => 'nullable|file',
            'desc' => 'required|string',
            'size' => 'required|string',
            'price' => 'required|string',
            'discount' => 'nullable|integer',

            "category_id"=> 'required',
            "tag_ids"=> 'nullable|array',
            "tag_ids.*"=> 'nullable|integer',

        ];
    }
}
