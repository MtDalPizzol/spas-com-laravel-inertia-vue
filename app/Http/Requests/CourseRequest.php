<?php

namespace App\Http\Requests;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseRequest extends FormRequest
{
    public function authorize()
    {
        if ($this->isUpdating()) {
            return Auth::user()->can('update', $this->course);
        }

        return Auth::user()->can('create', Course::class);
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:3'],
            'cover' => ['nullable', 'string'],
            'cover_file' => ['nullable', 'file', 'image', 'max:2048']
        ];
    }
}
