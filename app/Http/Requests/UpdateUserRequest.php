<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->route('user'); // lấy từ route binding

        return [
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $userId,
            'password' => 'sometimes|string|min:6',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
            'status' => 'in:active,inactive',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role_id' => 'sometimes|exists:roles,id',
        ];
    }
}
