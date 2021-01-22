<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestApply extends FormRequest
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
            'SeekerEmail'=>'required|email',
            'SeekerPhone'=>'required|min:11|numeric',
            'SeekerAddress'=>'required',
            'SeekerCVLink'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'SeekerName.required'=>'Vui lòng! Bạn phải nhập đầy đủ họ tên.',
            'SeekerEmail.required'=>'Vui lòng! Bạn phải nhập email.',
            'SeekerPhone.required'=>'Vui lòng! Bạn phải nhập số điện thoại',
            'SeekerPhone.numeric'=>'Số điện thoại không đúng định dạng! Vui lòng nhập lại!',
            'SeekerPhone.min'=>'Số điện thoại quá ngắn, yêu cầu nhập lại!',
            'SeekerAddress.required'=>'Bạn phải nhập địa chỉ tạm trú!',
            'SeekerCVLink.required'=>'Bạn phải nhập CV của bạn!',
        ];
    }
}
