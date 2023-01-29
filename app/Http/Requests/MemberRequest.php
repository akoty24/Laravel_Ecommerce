<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:50',
            'title' => 'required|string|min:3|max:30',
            'description' => 'required|max:500',
            'btn_text' => 'required|string|min:3|max:20',
            'photo' => 'required|image|mimes:jpeg,png,jpg'
        ];
    }
}
