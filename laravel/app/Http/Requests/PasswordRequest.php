<?php

namespace App\Http\Requests;

use App\Rules\CurrentPasswordCheckRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->redirect = url()->previous().'#changepassword';

        return [
            'old_password' => ['required', new CurrentPasswordCheckRule],
            'password' => ['required', 'min:6', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required', 'min:6'],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'old_password' => __('current password'),
        ];
    }
}
