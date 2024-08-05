<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;  
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        'city' => 'nullable|string',
        'province' => 'nullable|string',
        'district' => 'nullable|string',
        'sub_district' => 'nullable|string',
        'detail' => 'nullable|string|max:1000',
        'address_type' => 'nullable|string',
        'image_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
