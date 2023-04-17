<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'photo1'=> 'required_without:id|image|mimes:png,jpg,gif,gpeg',
            'title1' => 'required|min:3',
            'description1' => 'required|min:5',
            'photo2'=> 'required_without:id|image|mimes:png,jpg,gif,gpeg',
            'title2' => 'required|min:3',
            'description2' => 'required|min:5',
        ];
    }
}
