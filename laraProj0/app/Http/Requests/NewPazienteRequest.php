<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPazienteRequest extends FormRequest
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
            'nome' => 'required|max:30',
            'cognome' => 'required|max:30',
            'genere' => 'required|min:0|max:1',
            'telefono' => 'required|min'
        ];
    }
}
