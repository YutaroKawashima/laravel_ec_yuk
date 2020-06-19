<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'amount' => [
                'required',
                'integer',
                'regex:/^0$|^[1-9][0-9]*$/',
                'between:1,10000',
            ]
        ];
    }

    public function attributes(){
        return [
            'amount' => '数量'
        ];
    }

    public function messages(){
        return [
            'required' => ':attributeを入力してください',
            'integer' => ':attributeは数値で入力してください',
            'regex' => ':attributeは正の整数で入力してください',
            'between' => ':attributeは1〜10000の数値を入力してください',
        ];
    }
}
