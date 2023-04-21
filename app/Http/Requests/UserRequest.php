<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    //フォームリクエスト利用の許可判定
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
            'over_name' => 'required|string|max:60',
            'under_name' => 'required|string|max:60',
            'over_name_kana' => 'required|string|max:60',
            'under_name_kana' => 'required|string|max:60',
            'mail_address' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:191|confirmed',
            'password_confirmation' => 'required|string|max:191',
        ];
    }

    //バリデーション エラーメッセージ
        public function messages(){
        return [
            'over_name.max' => '姓は60文字以下で入力してください。',
            'under_name.max' => '名は60文字以下で入力してください。',
            'over_name_kana.max' => 'セイは60文字以下で入力してください。',
            'under_name_kana.max' => 'メイは60文字以下で入力してください。',
            'mail_address.max' => 'メールアドレスは255文字以下で入力してください。',
            'mail_address.unique:users' => 'すでに登録されているアドレスです。',
            'password.max' => 'パスワードは191文字以下で入力してください。',
            'password.confirmed' => 'パスワードが異なります',
        ];
    }
}
