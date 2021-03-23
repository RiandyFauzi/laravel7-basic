<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'thumbnail' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'title' => 'required|min:3',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'array|required',
        ];
    }
}
