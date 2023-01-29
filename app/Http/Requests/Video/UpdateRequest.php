<?php

namespace App\Http\Requests\Video;

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
            'title' => 'nullable|string|max:255',
            'desc' => 'nullable|string|max:1000',
            'poster' => 'nullable|file',
            'category_id' => 'nullable',
            'tag_ids' => 'nullable|array'
        ];
    }
}
