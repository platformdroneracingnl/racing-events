<?php

namespace App\Http\Requests\Management;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('user-create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'pilot_name' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'organization_id' => 'nullable|exists:organizations,id',
            'race_team_id' => 'nullable|exists:race_teams,id',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ];
    }
}
