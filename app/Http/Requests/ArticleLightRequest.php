<?php

namespace App\Http\Requests;

use App\Http\Requests\mainRequest;

class ArticleLightRequest extends MainRequest
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
            'title_ar'    =>  'required',
            'slug_ar'     =>  'required',
            'body_ar'     =>  'required',

            'title_en'    =>  'required|', //'required|alpha',
            'slug_en'     =>  'required|',
            'body_en'     =>  'required|',

            'title_ca'    =>  'required',
            'slug_ca'     =>  'required',
            'body_ca'     =>  'required',
        ];
    }
}
