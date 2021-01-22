<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestChangeInfoRecruiter extends FormRequest
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
            //
            'RecruiterName'=>'required',
            'Email'=>'required',
            'Phone'=>'required',
            'Password'=>'required',
            'CompanyName'=>'required',
            'Address'=>'required',
            'Avatar'=>'required'

        ];
    }
    public function messages()
    {
        return [
            'RecruiterName.required'=>'Bạn phải nhập tên nhà tuyển dụng!',
            'Email.required'=>'Bạn phải nhập email!',
            'Phone.required'=>'Bạn phải nhập số điện thoại!',
            'Password.required'=>'Bạn phải nhập mật khẩu!',
            'CompanyName.required'=>'Bạn phải nhập tên công ty!',
            'Address.required'=>'Bạn phải nhập địa chỉ công ty!',
            'Avatar.required'=>'Bạn phải chọn ảnh đại diện!'

        ];
    }
}
