<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Autoriser cette requête. À ajuster si besoin avec une logique d'autorisation spécifique.
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
            'prenom' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'telephone' => [
                'required',
                'string',
                'unique:users,telephone',
                'regex:/^\+221(70|75|76|77|78)\d{7}$/', // Format spécifique pour le téléphone
            ],
            'adresse' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'string'], // Assurez-vous que la gestion des images corresponde à votre logique (URL, base64, etc.)
            'statut' => ['required', 'in:Actif,Bloquer'], // Statuts possibles comme défini dans le modèle
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'], // Confirmation du mot de passe
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'telephone.regex' => 'Le numéro de téléphone doit commencer par +221 suivi de 70, 75, 76, 77 ou 78 et comporter 13 chiffres maximum.',
            'role_id.exists' => 'Le rôle sélectionné n\'existe pas.',
            // Ajoutez d'autres messages personnalisés ici si nécessaire
        ];
    }
}
