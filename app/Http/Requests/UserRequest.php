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

     public function getValidatorInstance()
    {
        // プルダウンで選択された値(= 配列)を取得
        $date = $this->input('birth_day', array()); //デフォルト値は空の配列

        // 日付を作成(ex. 2020-1-20)
        $date_validation = implode('-', $date);

        // rules()に渡す値を追加でセット
        //     これで、この場で作った変数にもバリデーションを設定できるようになる
        $this->merge([
            'birth_day_validation' => $date_validation,
        ]);

        return parent::getValidatorInstance();
    }


     //バリデーションなどのルール
    public function rules()
    {
        return [
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u|max:30',
            'under_name_kana' => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u|max:30',
            'mail_address' => 'required|email:filter,dns|max:100|unique:users',
            'sex' =>  ["in:1,2,3"],
            'birth_day_validation' => 'required|date|before:now|after:2000-01-01',
            'role' => ["in:1,2,3,4"],
            'password' => 'required|string|min:8|max:30|confirmed',
            'password_confirmation' => 'required|string|max:191',
        ];
    }


    //バリデーション エラーメッセージ
        public function messages(){
        return [
            'over_name.required' => '必須項目です。',
            'over_name.max' => '10文字以下で入力してください。',

            'under_name.required' => '必須項目です。',
            'under_name.max' => '10文字以下で入力してください。',

            'over_name_kana.required' => '必須項目です。',
            'over_name_kana.max' => '30文字以下で入力してください。',
            'over_name_kana.regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u' => 'カタカナで入力してください。',

            'under_name_kana.required' => '必須項目です。',
            'under_name_kana.max' => '30文字以下で入力してください。',
            'under_name_kana.regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u' => 'カタカナで入力してください。',

            'mail_address.required' => '必須項目です。',
            'mail_address.email:filter,dns' => 'メールアドレスの形式で入力してください。',
            'mail_address.max' => '100文字以下で入力してください。',
            'mail_address.unique:users' => 'すでに登録されているアドレスです。',

            'sex.required' => '必須項目です。',

            'birth_day_validation.required'  => '必須項目です。',
            'birth_day_validation.date'  => '正しい値を入力してください。',
            'birth_day_validation.before:now'  => '2000年1月1日〜今日までの日付を入力してください。',
            'birth_day_validation.after:2000-01-01'  => '2000年1月1日〜今日までの日付を入力してください。',

            'role.required' => '必須項目です。',

            'password.required' => '必須項目です。',
            'password.min' => '8文字以上で入力してください。',
            'password.max' => '30文字以下で入力してください。',
            'password.confirmed' => 'パスワードが異なります',
        ];
    }
}
