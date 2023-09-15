<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class LogUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */

    // régle de login d'un user
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ];
    }

    // si erreur de validation on envoie une erreur 422 avec les messages associé aux champs
    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'succes' => false,
            'status_code' => 422,
            'error' => true,
            'message' => 'Erreur de validation',
            'errorList' => $validator->errors()
        ], 422));
    }

    // liste des messages
    public function messages() {
        return [
            'email.required' => 'Merci de remplir le champs mail',
            'email.email' => 'le champs mail n\'est pas au bon format',
            'email.exists' => 'Cette email n\'existe pas',
            'password.required' => 'Merci de remplir le champs mot de passe'
        ];
    }
}
