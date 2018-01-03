<?php

use App\Models\Course;

return [

    'title'   => '课程',
    
    'single'  => '课程',

    'model'   => Course::class,

    // 对 CRUD 动作的单独权限控制，其他动作不指定默认为通过
    'action_permissions' => [
        // 删除权限控制
        'delete' => function () {
            // 只有站长才能删除课程
            return Auth::user()->hasRole('Superadmin');
        },
    ],

    'columns' => [

        'id' => [
            'title' => 'ID',
        ],

        'name' => [
            'title' => '课程',
            'sortable' => false,
            'output' => function ($name, $model) {
                return '<a href="/course/' . $model->slug . '" target="_blank">' . $name . '</a>';
            },
        ],

        'slug' => [
            'title' => '英文',
            'sortable' => false,
        ],

        'user_id' => [
            'title' => '作者',
            'sortable' => false,
            'output' => function ($user_id, $model) {
                $model->load('user');
                return $model->user->name;
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

        'intro' => [
            'title' => '描述',
            'sortable' => false,
            'output' => function ($intro, $model) {
                return str_limit($intro, 50);
            },
        ],

        'price' => [
            'title' => '价格',
            'sortable' => false,
        ],

        'cover' => [
            'title' => '封面',
            'sortable' => false,
            'output' => function ($cover, $model) {
                return empty($cover) ? 'N/A' : '<a href="'.$cover.'" target="_blank"><img src="'.$cover.'" width="40"></a>';
            },
        ],

        'operation' => [
            'title' => '管理',
            'sortable' => false,
        ],

    ],

    'edit_fields' => [

        'name' => [
            'title' => '课程',
        ],

        'slug' => [
            'title' => '英文',
        ],

        'user_id' => [
            'title' => '作者 ID',
        ],

        'cover' => [
            'title' => '封面',
            'type' => 'image',
            'location' => public_path() . '/uploads/images/courses/',
        ],

        'intro' => [
            'title' => '描述',
            'type'  => 'textarea',
        ],

        'introduction' => [
            'title' => '介绍',
            'type'  => 'textarea',
        ],

    ],

    'filters' => [

        'id' => [
            'title' => 'ID',
        ],

        'name' => [
            'title' => '课程',
        ],

        'slug' => [
            'title' => '英文',
        ],

    ],

    'rules'   => [
        'name' => 'required|min:2|unique:courses'
    ],

    'messages' => [
        'name.unique'   => '课程名已存在',
        'name.required' => '课程名不能为空',
    ],
];