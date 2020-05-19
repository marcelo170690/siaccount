<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebAccountStore extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'web_page' => 'required',
            'web_account' => 'required',
            'password' => 'required|string|min:8',
            'description' => 'required|string'
        ];
    }
}
