<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'description' => 'required|max:255',
            // 'image_url' => 'required|url', // Ajustez le champ 'description' en fonction de votre modèle
            // 'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ajoutez des règles pour le champ 'img' si nécessaire
            // Ajoutez d'autres règles en fonction de vos besoins
        ];
    }
}
