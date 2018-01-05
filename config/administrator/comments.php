<?php

use App\Comment;

return [

    'title'   => '留言',

    'single'  => '留言',

    'model'   => Comment::class,

    'columns' => [

        'id' => [
            'title' => 'ID',
        ],

        'body' => [
            'title'     => '留言',
            'sortable'  => false,
            'output'    => function ($body, $model) {
                return make_link(str_limit($body, 40), $model->topic->link() . '#comment_' . $model->id, $body);
            },
        ],

        'topic_id' => [
            'title'    => '章节',
            'sortable' => false,
            'output'   => function ($topic_id, $model) {
                return make_link(e($model->topic->title), $model->topic->link());
            },
        ],

        'user_id' => [
            'title'    => '留言人',
            'sortable' => true,
            'output'   => function ($user_id, $model) {
                return make_link($model->user->name, "/user/{$user_id}");
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

        'star' => [
            'title' => '点赞数',
            'sortable' => true,
        ],

        'created_at' => [
            'title'    => '留言时间',
        ],

        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],

    ],

    'edit_fields' => [

        'star' => [
            'title' => '点赞数',
        ],

    ],

    'filters' => [

        'id' => [
            'title' => 'ID',
        ],

        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name)"),
            'options_sort_field' => 'id',
        ],

    ],

];