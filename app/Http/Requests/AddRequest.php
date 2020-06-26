<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            'name' => [
                'required' | 'string' | 'max:20'
            ],
            'price' => [
                'required' | 'integer' | 'regex:/^0$|^[1-9][0-9]*$/' | 'between:1,1000000'
            ],
            'stock' => [
                'required' | 'integer' | 'regex:/^0$|^[1-9][0-9]*$/' | 'between:1,10000'
            ],
            'image' => [
                'file' | 'image' | 'max:400000' | 'mimes:jpeg,png' | 'dimensions:min_width=100,min_height=100,max_width=900,max_height=900'
            ]
        ];
    }

    public function attributes()
    {
        return [
            'name' => '商品名',
            'price' => '価格',
            'stock' => '在庫数',
            'image' => '画像'
        ];
    }

    public function messages()
    {
        return [
            'image.max' => 'ファイルは400MBまでのファイルをアップロードしてください',
            'required' => ':attributeを入力してください',
            'string' => ':attributeは文字で記入してください',
            'max' => ':attributeは:max字以内で記入してください',
            'integer' => ':attributeは数値で記入してください',
            'regex' => ':attributeは正の整数で記入してください',
            'between' => ':attributeは:min〜:maxの値で記入してください',
            'file' => ':attributeファイルがありません',
            'mimes' => ':attributeファイルはjpegもしくはpngファイルをアップロードしてください',
            'dimensions' => ':attributeは、:min_width×:min_height〜:max_width×:max_heightのサイズのものをアップロードしてください'
        ];
    }
}
