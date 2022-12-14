<?php

namespace App\Http\Requests;

use App\Http\Requests\mainRequest;

class ArticleRequest extends MainRequest
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
            'title'        => 'required',
            'slug'         => 'required',
            'body'         => 'required',
        ];
    }
}
