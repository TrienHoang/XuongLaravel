<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // $user = $this->route('user');
        // $userId = is_object($user) ? $user->id : $user;
    
        return [
            'name' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->route('id')),
            ],
            'password' => 'sometimes|nullable|string|min:6',
            'phone_number' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'status' => 'sometimes|in:active,inactive',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role_id' => 'sometimes|exists:roles,id',
        ];
    }
}
