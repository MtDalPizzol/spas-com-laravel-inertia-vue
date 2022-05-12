<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as HttpFormRequest;

class FormRequest extends HttpFormRequest
{
    protected function isUpdating()
    {
        return $this->method() === 'PUT';
    }
}
