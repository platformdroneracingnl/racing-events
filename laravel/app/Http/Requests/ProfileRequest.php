<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $this->redirect = url()->previous().'#changeprofile';

        return [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore(auth()->id())],
            'pilot_name' => ['required'],
            'country_id' => ['required'],
        ];
    }
}
