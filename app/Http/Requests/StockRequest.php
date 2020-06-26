<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
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
            'update_stock' => [
                'required' | 'integer' | 'regex:/^0$|^[1-9][0-9]*$/' | 'between:1,10000'
            ],
        ];
    }

    public function attributes(){
        return [
            'update_stock' => '在庫数',
        ];
    }

    public function messages() {
        return [
            'required' => ':attributeを入力してください',
            'integer' => ':attributeは数値で記入してください',
            'regex' => ':attributeは正の整数で記入してください',
            'between' => ':attributeは:min〜:maxの値で記入してください',
        ];
    }
}
