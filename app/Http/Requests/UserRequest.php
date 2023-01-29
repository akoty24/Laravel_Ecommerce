<?php

namespace App\Http\Requests;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //'photo' => 'required',
            'name' => 'required|min:3',
            'lname' => 'required|min:3',
            'email'=> 'email|required',
            'password'=> 'required' ,
            'phone'=>'required' ,
            'active' => 'required',
            'address' => 'required',
            'address2' => 'required',
            'city' => 'required',
            'country' => 'required',
            'pincode' => 'required',
            'role' => 'required',

        ];
    }
}
