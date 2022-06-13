<?php

namespace App\Http\Requests;

use App\Rules\AuthorRule;
use App\Rules\GenreRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateBookRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'cover' => ['file', 'nullable'],
            'authors' => ['required', new AuthorRule()],
            'year' => ['required', 'numeric', 'min:1000', 'max:9999'],
            'genres' => ['required', new GenreRule()],
            'description' => ['string', 'nullable'],
            'subscription_id' => ['required', 'exists:subscriptions,id'],
            'text_file' => ['required', 'file'],
        ];
    }
}
