<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
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
            'attributes' => 'array',
            'attributes.guac-email-address' => 'string',
            'attributes.guac-organizational-role' => 'string',
            'attributes.guac-full-name' => 'string',
            'attributes.expired' => 'string',
            'attributes.timezone' => 'string',
            'attributes.access-window-start' => 'string',
            'attributes.guac-organization' => 'string',
            'attributes.access-window-end' => 'string',
            'attributes.disabled' => 'string',
            'attributes.valid-until' => 'string',
            'attributes.valid-from' => 'string'
        ];
    }
}
