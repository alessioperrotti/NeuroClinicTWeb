<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// Aggiunti per response JSON
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\Console;
use Symfony\Component\HttpFoundation\Response;

class FaqRequest extends FormRequest
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
        $rules = [
            'domanda' => 'required|max:250',
            'risposta' => 'required|max:1000',
        ];


        return $rules;
    }

    protected function failedValidation(Validator $validator): HttpResponseException
    {
        throw new HttpResponseException(response($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
        //passiamo all exception linsieme dei messaggi derrore e Response::HTTP_UNPROCESSABLE_ENTITY che è una costante predefinita, che genera il codice 422
        
    }
}
