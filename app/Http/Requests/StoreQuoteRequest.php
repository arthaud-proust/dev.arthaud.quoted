<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'author' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:255'],
            'source' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email'],
        ];
    }

    public function attributes()
    {
        return [
            'author' => 'auteur',
            'content' => 'contenu',
        ];
    }
}
