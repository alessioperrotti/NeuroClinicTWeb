<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;

class NewEventoRequest extends FormRequest
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
            'data' => 'required|date|before:tomorrow|after:2000-01-01|date_format:Y-m-d',
            'ora' => 'required|date_format:H:i',
            'durata' => 'required|integer|min:1|digits_between:1,120',
            'intensita' => 'required|integer|min:1|max:10',
            'disturbo' => 'required',
            'paziente' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator): HttpResponseException
    {
        throw new HttpResponseException(response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
        //passiamo all exception linsieme dei messaggi derrore e Response::HTTP_UNPROCESSABLE_ENTITY che è una costante predefinita, che genera il codice 422
        
    }
}
