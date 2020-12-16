<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestChangeInfo extends FormRequest
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
            'Email'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'SeekerName.required'=>'Bạn phải nhập họ và tên!',
            'Email.required'=>'Bạn phải nhập email!',
        ];
    }
}
