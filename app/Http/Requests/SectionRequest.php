<?php

namespace App\Http\Requests;

use App\Models\Section;
use Illuminate\Support\Facades\Auth;

class SectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->isUpdating()) {
            return Auth::user()->can('update', $this->section);
        }

        return Auth::user()->can('create', [Section::class, $this->course]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'min:3']
        ];
    }
}
