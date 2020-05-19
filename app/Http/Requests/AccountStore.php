<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountStore extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'account' => 'required|unique:accounts',
            'password' => 'required|string|min:8',
            'description' => 'required|string'
        ];
    }
}
