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
            'first_name' => 'required|max:125',
        'last_name' => 'nullable|max:125',
        'phone_number' => 'required|integer',
        'gender' => 'nullable|in:male,female',
        'email' => 'required|email',
        'birth_date' => 'nullable|date',
        'city' => 'nullable|string',
        'province' => 'nullable|string',
        'district' => 'nullable|string',
        'sub-district' => 'nullable|string',
        'detail' => 'nullable|string|max:1000',
        'address_type' => 'nullable|string',
        'image_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
