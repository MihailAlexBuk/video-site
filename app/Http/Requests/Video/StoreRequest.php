<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'desc' => 'required|string|max:1000',
            'poster' => 'required|file',
            'video_url' => 'required|file',
            'category_id' => 'required',
            'tag_ids' => 'required|array'
        ];
    }
}
