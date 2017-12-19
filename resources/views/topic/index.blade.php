@extends('layout.app')

@section('title', config('app.name'))

@section('content')

<div class="row topic-list">
    <div class="col-md-12 head">
        <div class="col-sm-2 book-cover">
            <a class="image" href="https://fsdhub.com/books/laravel-essential-training-5.5"><img class="image-shadow" width="100%" src="https://fsdhub.com/uploads/images/201704/28/1/O2sXyZ5ZH6.jpg"></a>
        </div>
        <div class="col-sm-10 book-brief">
            <div class="title">Laravel 教程 - Web 开发实战入门 ( Laravel 5.5 )</div>
            <div class="brief">
                <p>本书将教你如何使用 Laravel 一步一步构建一个类似新浪微博的应用，让你从实际开发中体会到 Laravel 开发的敏捷、愉悦与轻松。通过阅读本教程，你将学到如 HTML、CSS、JavaScript、PHP 和 Laravel 等 Web 开发相关的基础知识。本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</p>
                <p>本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</p>
            </div>
            <div class="extra">
                <a href="" class="btn btn-primary btn-wider-look">订阅 ￥39.00</a>

            </div>
        </div>
    </div>
    <div class="col-md-12 body">
        <div class="chapters">
            <dl>
                <dt>第 1 章 开始编写</dt>
                <dd><a href=""><span class="label label-primary">免费试读</span>1.1 序言</a></dd>
                <dd><a href=""><span class="label label-primary">免费试读</span>1.2 数据库视图管理工具</a></dd>
                <dd><a href=""><span class="label label-primary">免费试读</span>1.3 数据库视图管理工具</a></dd>
                <dd><a href=""><span class="label label-primary">免费试读</span>1.4 数据库视图管理工具</a></dd>
                <dd><a href=""><span class="label label-primary">免费试读</span>1.5 数据库视图管理工具</a></dd>
            </dl>
            <dl>
                <dt>第 2 章 一段不容易的路</dt>
                <dd><a href="">1.1 序言</a></dd>
                <dd><a href="">1.2 数据库视图管理工具</a><span class="pull-right"><i class="glyphicon glyphicon-lock"></i></span></dd>
                <dd><a href="">1.3 数据库视图管理工具</a><span class="pull-right"><i class="glyphicon glyphicon-lock"></i></span></dd>
                <dd><a href="">1.4 数据库视图管理工具</a><span class="pull-right"><i class="glyphicon glyphicon-lock"></i></span></dd>
                <dd><a href="">1.5 数据库视图管理工具</a><span class="pull-right"><i class="glyphicon glyphicon-lock"></i></span></dd>
            </dl>
        </div>
    </div>
</div>

@stop