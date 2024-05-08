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
            'city' => 'required|string',
            'province' => 'required|string',
            'district' => 'required|string',
            'sub-district' => 'required|string',
            'address_type' => 'required',
            'detail' => 'max:1000|required',
            'phone_number' => 'integer|max:15|required',
            'email' => 'email|required'
        ];
    }
}
