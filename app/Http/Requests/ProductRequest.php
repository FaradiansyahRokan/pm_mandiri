<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
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
            'name_product' => 'required|max:255',
            'description_product' => 'required',
            'price' => 'required|integer',
            'qty' => 'required|integer',
            'files.*' => 'required|image|mimes:jpeg,png,jpg,giv,svg|max:2048',
            'id_category_size' => 'required',
            'id_category_menu' => 'required',
            'id_category_flavour' => 'required',
        ];
    }
}
