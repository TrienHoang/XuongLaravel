<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role_id' => 'required|exists:roles,id',
        ];
    }
}
