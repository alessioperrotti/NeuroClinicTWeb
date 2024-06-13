<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Resources\Paziente;


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
            'nome' => 'required|max:30|regex:/^[A-Za-zÀ-ÿ\s]+$/',
            'cognome' => 'required|max:30|regex:/^[A-Za-zÀ-ÿ\s]+$/',
            'dataNasc' => 'required|date|before:today|after:1900-01-01',
            'genere' => 'required|min:0|max:1',
            'via' => 'required|max:30|regex:/^[A-Za-zÀ-ÿ\s]+$/',
            'civico' => 'required|string|max:5',
            'citta' => 'required|max:30|regex:/^[A-Za-zÀ-ÿ\s]+$/',
            'prov' => 'required|max:2',
            'telefono' => 'required|min:10|max:15|regex:/^(\+39)?[0-9]{10}$/',
            'email' => 'required|email|max:50|unique:paziente,email',
            'username' => 'required|max:20|unique:paziente,username',
            'clinico' => 'required',
        ];
    }


    protected function failedValidation(Validator $validator): HttpResponseException
    {
        throw new HttpResponseException(response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
