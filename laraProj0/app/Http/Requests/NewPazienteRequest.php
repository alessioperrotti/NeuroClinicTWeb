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
        $username = $this->route('username');
        return [
            'nome' => 'required|max:30|alpha',
            'cognome' => 'required|max:30|alpha',
            'dataNasc' => 'required|date|before:today|after:1900-01-01',
            'genere' => 'required|min:0|max:1',
            'via' => 'required|max:30',
            'civico' => 'required|string|max:5',
            'citta' => 'required|max:30',
            'prov' => 'required|max:2',
            'telefono' => 'required|min:10|max:13',
            'email' => 'required|email|max:40|unique:paziente,email,' . $username . ',username',
            'username' => 'required|max:20|unique:paziente,username,' . $username . ',username',  //Specifica che l'unicità deve essere controllata tranne che per il record con l'username specificato. Questo significa che il campo email può essere uguale a quello del record corrente, ma deve essere unico per tutti gli altri record.
            'clinico' => 'required',
        ];
    }


    protected function failedValidation(Validator $validator): HttpResponseException
    {
        throw new HttpResponseException(response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
