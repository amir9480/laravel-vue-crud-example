<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email,'.optional($this->user)->id.'|max:191',// optional($this->user)->id prevents from email dublicate error while editing an user
            'password' => ($this->isMethod("post")?'required':'nullable').'|string|min:6', // if method was true then user is creating and password required to init user
        ];
    }
}
