<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
            'main_category' => 'required|string|max:100|unique:main_categories',
        ];
    }

       //メッセージ
        public function messages(){
        return [
            'main_category.required' => '必須項目です。',
            'main_category.string' => '文字で入力してください。',
            'main_category.max' => '100文字以下で入力してください。',
            'main_category.unique' => 'すでに登録されています。',
        ];
    }
}
