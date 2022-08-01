<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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

       
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'nom' => 'required|max:255|string',
                    'prenom' => 'required|max:255|string',
                    'sexe' => 'required|max:255|string',
                    'email' => 'required|max:255|email|unique:App\Models\User,email',
                    'admin' => 'required|max:255|string',
                    'password' => 'required|max:255',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'nom' => 'required|max:255|string',
                    'prenom' => 'required|max:255|string',
                    'sexe' => 'required|max:255|string',
                    'admin' => 'required|max:255|string',
                    'password' => 'required|max:255',
                    'email' => Rule::unique('users')->ignore($this->route()->user->id),
                ];
            }
            default: break;
        }
    }
}
