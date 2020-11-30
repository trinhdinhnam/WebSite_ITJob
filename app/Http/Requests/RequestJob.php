<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestJob extends FormRequest
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
            'JobName'=>'required',
            'Require'=>'required',
            'Description'=>'required',
            'Address'=>'required',
            'Salary'=>'required'    
        ];
    }
    public function messages()
    {
        return [
            'JobName.required'=>'Bạn phải nhập tên công việc!',
            'Description.required'=>'Bạn phải nhập tên công việc!',
            'Address.required'=>'Bạn phải địa chỉ làm việc!',
            'Salary.required'=>'Bạn phải mức lương của công việc!',
            'Require.required'=>'Bạn phải nhập yêu cầu công việc!'
        ];
    }
}
