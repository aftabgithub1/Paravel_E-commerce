<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfilePost extends FormRequest
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
            'old_password'=>'required',
            'password'=>'required|confirmed|min:8',
            'password_confirmation'=>'required'
        ];
    }
    // public function messages()
    // {
    //     return [
    //         'old_password.required'=>'পুারন পাসওয়ার্ড কই',
    //         'password.required'=>'নতুন পাসওয়ার্ড দাও',
    //         'password_confirmation.required'=>'আবার নতুন পাসওয়ার্ড দাও'
    //     ];
    // }
}
