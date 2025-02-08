<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>'required|string|max:100',
            'email'=>'required|email',
            'image'=>'nullable|image|mimes:png,jpg,jpeg,svg,|max:1024',
            'number'=>'nullable|numeric',
            'password'=>'required|confirmed',
            'role'=>'required|string',
            'status'=>'required|string'
        ];
    }
    protected $stopOnFirstFailure = true;
}
