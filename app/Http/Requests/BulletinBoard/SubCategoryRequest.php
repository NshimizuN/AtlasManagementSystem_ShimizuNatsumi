<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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

     //バリデーションなどのルール
    public function rules()
    {
        return [
            'main_category_id' => 'required|required_with:id|',
            'sub_category_name' => 'required|string|max:100|unique:sub_categories,sub_category',
        ];
    }

        //メッセージ
        public function messages(){
        return [
            'main_category_id.required' => '必須項目です。',
            'main_category_id.required_with:id' => '存在しないカテゴリーです。',

            'sub_category_name.required' => '必須項目です。',
            'sub_category_name.string' => '文字で入力してください。',
            'sub_category_name.max' => '100文字以内で入力してください。',
        ];
    }
}
