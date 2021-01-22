<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRegisterSeeker extends FormRequest
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
            'SeekerName'=>'required',
            'Address'=>'required',
            'TemporaryAddress'=>'required',
            'Education'=>'required',
            'Gender'=>'required',
            'DateOfBirth'=>'required',
            'Avatar'=>'required',
            'Email'=>'required|email|unique:seekers,email',
            'Password'=>'required',
            'Phone' => 'required|min:11|numeric',

        ];
    }
    public function messages()
    {
        return [
            'SeekerName.required'=>'Bạn phải nhập họ và tên!',
            'Address.required'=>'Bạn phải nhập địa chỉ thường trú!',
            'TemporaryAddress.required'=>'Bạn phải nhập địa chỉ tạm trú!',
            'Education.required'=>'Bạn phải chọn học vấn!',
            'Gender.required'=>'Bạn phải chọn giới tính!',
            'DateOfBirth.required'=>'Bạn phải nhập ngày sinh!',
            'Avatar.required'=>'Bạn phải chọn ảnh đại diện!',
            'Email.required'=>'Bạn phải nhập email!',
            'Email.unique'=>'Email của bạn đã được sử dụng, vui lòng nhập email khác!',
            'Email.email'=>'Email của bạn không đúng định dạng. Vui lòng nhập lại!',
            'Password.required'=>'Bạn phải nhập mật khẩu!',
            'Phone.required'=>'Bạn không được bỏ trống số điện thoại',
            'Phone.numeric'=>'Số điện thoại không đúng định dạng! Vui lòng nhập lại',
            'Phone.min'=>'Số điện thoại quá ngắn, yêu cầu nhập lại',

        ];
    }
}
