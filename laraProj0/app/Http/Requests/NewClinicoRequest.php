<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewClinicoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'nome' => 'required|max:30|regex:/^[A-Za-zÀ-ÿ\s]+$/',
            'cognome' => 'required|max:30|regex:/^[A-Za-zÀ-ÿ\s]+$/',
            'dataNasc' => 'required|date|before:today|date_format:Y-m-d',
            'ruolo' => 'required|max:20',
            'username' => 'required|max:20|unique:user,username',
            'specializ' => 'required|max:30|regex:/^[A-Za-zÀ-ÿ\s]+$/',
        ];
    }
}
