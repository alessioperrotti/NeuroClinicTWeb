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
            'dataNasc' => 'required',
            'genere' => 'required|min:0|max:1',
            'via' => 'required|max:30',
            'civico' => 'required|numeric',
            'citta' => 'required|max:30',
            'prov' => 'required|max:2',
            'telefono' => 'required|min:10|max:13',
            'email' => 'required|email|max:40|unique:paziente,email',
            'username' => 'required|max:20|unique:user,username',
            'clinico' => 'required',
        ];
    }
}
