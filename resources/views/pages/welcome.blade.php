<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="全栈工程师,全栈,FullStack,全栈培训,全栈学习,全端工程师,编程,编码,编程学习,编程技巧,文章,php,javascript,laravel,java,vuejs ">
    <meta name="description" content="FSDHub 是一个针对全栈工程师培训的学习社区。">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name') }} - 下半辈子我们一起成长</title>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="welcome-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 head">
                    <div class="logo"><a href="{{ config('url') }}"><img src="{{ config('url') }}/images/yede_logo.png" alt="野得教程LOGO"></a></div>
                </div>
                <div class="col-md-12 body">
                    <div class="col-sm-3 book-cover">
                        <a class="image" href="https://fsdhub.com/books/laravel-essential-training-5.5"><img class="image-shadow" width="100%" src="https://fsdhub.com/uploads/images/201704/28/1/O2sXyZ5ZH6.jpg"></a>
                    </div>
                    <div class="col-sm-9 book-brief">
                        <div class="title">Laravel 教程 - Web 开发实战入门 ( Laravel 5.5 )</div>
                        <div class="brief">
                            <p>本书将教你如何使用 Laravel 一步一步构建一个类似新浪微博的应用，让你从实际开发中体会到 Laravel 开发的敏捷、愉悦与轻松。通过阅读本教程，你将学到如 HTML、CSS、JavaScript、PHP 和 Laravel 等 Web 开发相关的基础知识。本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</p>
                            <p>本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</p>
                        </div>
                        <div class="extra"><a href="" class="btn btn-primary">免费试读</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>