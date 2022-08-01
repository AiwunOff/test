<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostChapitreRequest extends FormRequest
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
            'titre' => 'required|max:255|string',
            'description' => 'required|string',
            'fichier_video' => 'required',
            //'iframe_video' => 'required',
            'module_id' => 'required|max:5|alpha_num',
        ];
    }
}
