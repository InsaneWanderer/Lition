<?php

namespace App\Http\Requests;

use App\Rules\AuthorRule;
use App\Rules\GenreRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateBookRequest extends FormRequest
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
            'id' => ['integer', 'exists:books,id'],
            'name' => ['string', 'max:255'],
            'cover' => ['file', 'nullable'],
            'authors' => [new AuthorRule()],
            'year' => ['numeric', 'min:1000', 'max:9999'],
            'genres' => [new GenreRule()],
            'description' => ['string', 'nullable'],
            'subscription_id' => ['exists:subscriptions,id'],
            'text_file' => ['file'],
        ];
    }
}
