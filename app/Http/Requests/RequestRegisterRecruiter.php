<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRegisterRecruiter extends FormRequest
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
            'Email'=>'required|email|unique:recruiters,Email',
            'Phone'=>'required|min:11|numeric',
            'Password'=>'required',
            'CompanyName'=>'required',
            'Address'=>'required',
            'CompanyLogo'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'RecruiterName.required'=>'Bạn phải nhập tên nhà tuyển dụng!',
            'Email.required'=>'Bạn phải nhập email!',
            'Email.unique'=>'Email của bạn đã được sử dụng, vui lòng nhập email khác!',
            'Email.email'=>'Email của bạn không đúng định dạng. Vui lòng nhập lại!',
            'Phone.required'=>'Bạn phải nhập số điện thoại!',
            'Password.required'=>'Bạn phải nhập mật khẩu!',
            'CompanyName.required'=>'Bạn phải nhập tên công ty!',
            'Address.required'=>'Bạn phải nhập địa chỉ công ty!',
            'CompanyLogo.required'=>'Bạn phải chọn ảnh logo của công ty!',
            'Phone.numeric'=>'Số điện thoại không đúng định dạng! Vui lòng nhập lại',
            'Phone.min'=>'Số điện thoại quá ngắn, yêu cầu nhập lại',
        ];
    }
}
