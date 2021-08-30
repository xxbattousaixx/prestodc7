<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:120',
            'body' => 'required|max:500',
            'category_id' => 'numeric'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.min' => 'Il titolo deve avere un minimo di 5 caratteri',
            'title.max' => 'Il titolo non può contenere più di 120 caratteri',
            'body.required' => 'Il testo è obbligatorio',
            'body.max' => 'Il testo non può essere più lungo di 500 caratteri',
            'category_id.numeric' => 'Devi selezionare una categoria'
        ];
    }
}