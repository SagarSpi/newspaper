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
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:1024',
            'number' => 'nullable|numeric|digits_between:4,15',
        ];
    }
    public function withValidator($validator)
    {   
        // Apply 'required' validation if 'password' is provided
        $validator->sometimes('password','required|confirmed',function ($input) {
            return $input->password !== null;
        });
        // Apply 'required' validation if 'role' is provided
        $validator->sometimes('role', 'required|string|in:admin,manager,editor,reporter,visitor,guest,user', function ($input) {
            return $input->role !== null;
        });

        // Apply 'required' validation if 'status' is provided
        $validator->sometimes('status', 'required|string|in:active,inactive,deleted', function ($input) {
            return $input->status !== null;
        });
    }
    protected $stopOnFirstFailure = true;
}
