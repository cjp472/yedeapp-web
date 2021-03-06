<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
            'name' => 'required|between:3,15|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
            'email' => 'required|email',
            'phone' => 'numeric|regex:/^1[0-9]{10}$/',
            'introduction' => 'max:140',
            'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200'
        ];
    }

    /**
     * Get the messages while fail to validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique' => '此用户名已存在',
            'name.regex' => '用户名支持中英文、数字、横杠和下划线',
            'name.between' => '用户名长度须为 3 - 15 个字符',
            'name.required' => '用户名不能为空',
            'phone.numeric' => '手机号码须为数字',
            'phone.regex' => '请输入有效的手机号码',
            'avatar.dimensions' => '头像宽和高需要 200px 以上'
        ];

    }
}
