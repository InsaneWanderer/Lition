<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditBookRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'title' => 'required',
            'cover' => 'required|file',
            'author' => 'required',
            'year' => 'required',
            'genres' => 'required',
            'description' => 'required',
            'sub' => 'required',
            'text-file' => 'required',
        ];
    }
}
