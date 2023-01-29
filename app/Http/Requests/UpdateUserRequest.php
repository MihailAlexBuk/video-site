<?php

namespace App\Http\Requests;

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
            'name' => 'nullable|string',
            'desc' => 'nullable|string',
            'avatar' => 'nullable|file',
            'old_password' => 'nullable|string',
            'new_password' => 'nullable|string',
            'new_password_confirmation' => 'nullable|string',
        ];
    }
}
