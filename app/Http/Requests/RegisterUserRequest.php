<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' =>'required|max:30|regex:/(^[\pL0-9 ]+$)/u',
            'email' =>'required|email|max:50|unique:users,email',
            'password' =>'required|max:25|min:6',
            'confirm_password' => 'required|same:password',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'name.max' => 'Giới hạn 30 ký tự',
            'name.regex' => 'Tên không có ký tự đặc biệt',
            'email.required' => 'Vui lòng nhập email',
            'email.max' => 'Giới hạn 50 ký tự',
            'email.email' => 'Không đúng định dạng email',
            'email.unique' => 'Email đã tồn tại',  
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.max' => 'Giới hạn 25 ký tự',
            'password.min' => 'Giới hạn 6 ký tự',
            'confirm_password.required' => 'Vui lòng nhập xác nhận mật khẩu',
            'confirm_password.same' => 'Xác nhận mật khẩu không đúng',
        ];
    }
}
