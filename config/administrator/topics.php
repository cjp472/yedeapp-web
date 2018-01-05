<?php

use App\Topic;

return [

    'title'   => '章节',

    'single'  => '章',

    'model'   => Topic::class,

    'columns' => [

        'id' => [
            'title' => 'ID',
        ],

        'title' => [
            'title'     => '章名',
            'sortable'  => false,
            'output'    => function ($value, $model) {
                return make_link($value, $model->link());
            },
        ],

        'course_id' => [
            'title'    => '课程',
            'sortable' => false,
            'output'   => function ($value, $model) {
                $url = "/course/{$model->course->slug}";
                return make_link(e($model->course->name), $url);
            },
        ],

        'user_id' => [
            'title'    => '作者',
            'sortable' => true,
            'output'   => function ($value, $model) {
                $url = "/user/{$value}";
                return make_link($model->user->name, $url);
            },
        ],

        'avatar' => [
            'title'    => '头像',
            'sortable' => false,
            'output'   => function ($value, $model) {
                $avatar = empty($model->user->avatar) ? 'N/A' : '<img src="'.$model->user->avatar.'" style="height:30px;width:30px">';
                $url = "/user/{$model->user->id}";
                return make_link($avatar, $url);
            },
        ],

        'comment_count' => [
            'title'    => '评论数',
        ],

        'view_count' => [
            'title'    => '阅读数',
        ],

        'free' => [
            'title'    => '免费',
            'output' => function ($value, $model) {
                return $value == 1 ? '是' : '否';
            }
        ],

        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],

    ],

    'edit_fields' => [

        'title' => [
            'title' => '章名',
        ],

        'course' => [
            'title'              => '课程',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'search_fields'      => ["CONCAT(id, ' ', name)"],
            'options_sort_field' => 'id',
        ],
        
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',

            // 自动补全，对于大数据量的对应关系，推荐开启自动补全，
            // 可防止一次性加载对系统造成负担
            'autocomplete'       => true,

            // 自动补全的搜索字段
            'search_fields'      => ["CONCAT(id, ' ', name)"],

            // 自动补全排序
            'options_sort_field' => 'id',
        ],

        'free' => [
            'title' => '免费'
        ],

        'comment_count' => [
            'title'    => '评论数',
        ],

        'view_count' => [
            'title'    => '阅读数',
        ],
    ],

    'filters' => [

        'id' => [
            'title' => 'ID',
        ],

        'title' => [
            'title' => '章名',
        ],

        'free' => [
            'title'             => '免费（1 免费 / 0 收费）',
        ],

        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],

        'course' => [
            'title'              => '课程',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],

    ],

    'rules'   => [
        'title' => 'required'
    ],

    'messages' => [
        'title.required' => '请填写标题',
    ],
];