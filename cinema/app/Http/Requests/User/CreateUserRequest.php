<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_genre' => 'required|integer',
            'id_distributeur' => 'required|integer',
            'titre' => 'required|string',
            'resum' => 'nullable|string',
            'date_debut_affiche' => 'nullable|date',
            'date_fin_affiche' => 'nullable|date',
            'duree_minutes' => 'nullable|integer',
            'annee_production' => 'nullable|integer',
        ];
    }
}
