<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LectureReservationCreateRequest extends FormRequest
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
            'instructor_id' => 'required|exists:users,id',
            'class_room_id' => 'required|exists:class_rooms,id',
            'class_id' => 'required|exists:student_classes,id',
            'start' => 'required|date',
            'end' => 'required|date',
        ];
    }
}
