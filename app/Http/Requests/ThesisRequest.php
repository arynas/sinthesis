<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThesisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {

            case 'POST':
                return [
                    'title' => 'required',
                    'student' => 'required',
                    'lecturer' => 'required',
                    'semester' => 'required',
                    'starts_at' => 'required',
                    'ends_at' => 'required',
                ];

            case 'PUT':

            case 'PATCH':
        }
    }
}
