<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'localisation' => 'nullable|string|max:50',
            'image_url' => 'required|max:100',
            'date' => 'nullable|date',
        ];
    }
}
//dans le cours il est dit de créer ArticleCreateRequest mais après il est nommé ArticleStoreRequest ?
