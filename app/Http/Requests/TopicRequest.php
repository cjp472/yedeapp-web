<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title'     => 'required|min:2',
                    'body'      => 'required|min:10',
                    'course_id'   => 'required|numeric',
                    'chapter_id'=> 'required|numeric',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }

    public function messages()
    {
        return [
            'title.required' => '请输入标题',
            'body.required' => '请输入正文',
            'title.min' => '标题不少于 2 个字符',
            'body.min'  => '正文不少于 10 个字符',
        ];
    }
}
