<?php

namespace App\Http\Requests\Auth;

use Logia\Core\Validation\Support\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'oldPassword' => 'required|string',
            'newPassword' => 'required|string',
            'confirmPassword' => 'required_with:newPassword|same:newPassword|string'
        ];
    }
}
