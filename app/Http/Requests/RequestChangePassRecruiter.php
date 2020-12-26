<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestChangePassRecruiter extends FormRequest
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

            'pass_old'=>'required',
            'pass_new'=>'required',
            'pass_confirm'=>'required',
            'pass_confirm'=>'same:pass_new',
        ];
    }
    public function messages()
    {
        return [

            'pass_old.required'=>'Mật khẩu cũ không được để trống',
            'pass_new.required'=>'Mật khẩu mới không được để trống',
            'pass_confirm.required'=>'Bạn phải xác nhận lại mật khẩu',
            'pass_confirm.same'=>'Mật khẩu xác nhận không đúng',
        ];
    }
}
