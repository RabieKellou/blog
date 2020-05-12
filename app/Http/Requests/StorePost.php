<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
            'title' => 'min:4|required|max:100',
            'content' => 'required',
            'picture' => 'image|mimes:jpeg,jpg,png,gif,svg|max:1024|dimensions:min_height:500'
        ];
    }
}
