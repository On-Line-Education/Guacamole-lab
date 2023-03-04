<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:student,instructor',
            'attributes' => 'array',
            'attributes.guac-email-address' => '',
            'attributes.guac-organizational-role' => '',
            'attributes.guac-full-name' => '',
            'attributes.expired' => '',
            'attributes.timezone' => '',
            'attributes.access-window-start' => '',
            'attributes.guac-organization' => '',
            'attributes.access-window-end' => '',
            'attributes.disabled' => '',
            'attributes.valid-until' => '',
            'attributes.valid-from' => ''
        ];
    }
}
