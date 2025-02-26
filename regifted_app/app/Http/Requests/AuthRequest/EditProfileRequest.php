<?php

namespace App\Http\Requests\AuthRequest;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            // 'name'=>'string',
            // 'location'=>'numeric|exists:locations,id',
            'location'=>'required|string',
            'phone_number'=>'regex:/[0-9]{10}/|unique:users',
            'image'=> 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
