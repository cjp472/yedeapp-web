<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'body'      => 'required|min:2',
            'topic_id'  => 'required|numeric',
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
            'body.require' => '请输入留言内容',
            'body.min' => '请输入至少 2 个字符',
        ];

    }
}
