<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
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
            'zip'                 => 'required|regex:/^\d{7}$/|min:7',
            'prefecture'          => 'required',
            'city'                => 'required|string|regex:/^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９、。 ｦ-ﾟ Ａ-Ｚ ａ-ｚ 々 〃 ゝ 﨑 －\-\n\r]+$/u|max:255',
            'email'               => 'required|string|email|confirmed|unique:forms,email,NULL,id,deleted_at,NULL|max:50',
            'email_confirmation'  => 'required|string|email|max:50',
            'age'                 => 'required',
            'gender'              => 'required',
            'unique_url'          => 'unique:forms,unique_url',
        ];
    }

    public function messages()
    {
        return [
            'gender.required'      => '性別を選択してください。',
            'age.required'         => '年齢を選択してください。',
            'prefecture.required'  => '都道府県を選択してください。',
            'unique_url.unique'    => 'お手数ですがもう一度確認ボタンを押してください。',
        ];
    }
}
