<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateUserRequest extends FormRequest
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

    // régle de création d'un user
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email',
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
            'name.required' => 'Un Nom pour l\'utilisateur est requis',
            'email.required' => 'Un email est requis',
            'email.unique' => 'Cette email est deja pris',
            'password.unique' => 'Un mot de passe est requis'
        ];
    }
}
