<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CommentsRequest extends FormRequest
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

    // régle d'ajout d'un commentaire
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'book_id' => 'required',
            'rate' => 'required'
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
            'user_id.required' => 'Un utilisateur est requis',
            'book_id.required' => 'Un livre doit etre renseigné',
            'rate.required' => 'Une note doit etre renseigné'
        ];
    }
}
