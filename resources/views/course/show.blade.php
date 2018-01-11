@extends('layout.app')

@section('title', config('app.name'))

@section('content')

<div class="row course-detail">
    <div class="col-md-12 head">
        <img src="{{ config('url') }}/images/course_1.png" alt="{{ $course->name }}" width="100%">
    </div>
    <div class="col-md-12 body">
        <dl class="intro">
            <dt>这是一个什么样的教程</dt>
            <dd>
                <p>本书将教你如何使用 Laravel 一步一步构建一个类似新浪微博的应用，让你从实际开发中体会到 Laravel 开发的敏捷、愉悦与轻松。通过阅读本教程，你将学到如 HTML、CSS、JavaScript、PHP 和 Laravel 等 Web 开发相关的基础知识。</p>
                <p>本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</p>
            </dd>
            <dt>适宜人群</dt>
            <dd>本书将教你如何使用 Laravel 一步一步构建一个类似新浪微博的应用，让你从实际开发中体会到 Laravel 开发的敏捷、愉悦与轻松。通过阅读本教程，你将学到如 HTML、CSS、JavaScript、PHP 和 Laravel 等 Web 开发相关的基础知识。本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 Web 开发中更为专业、实用的技能，如 Git 工作流、Gulp 前端工作流、Bootstrap 框架基本使用等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。</dd>
            <dt>订阅须知</dt>
            <dd>
                <p>1.本书将教你如何使用 Laravel 一步一步构建一个类似新浪微博的应用，让你从实际开发中体会到 Laravel 开发的敏捷、愉悦与轻松。</p>
                <p>2.本书将教你如何使用 Laravel 一步一步构建一个类似新浪微博的应用，让你从实际开发中体会到 Laravel 开发的敏捷、愉悦与轻松。</p>
                <p>3.本书将教你如何使用 Laravel 一步一步构建一个类似新浪微博的应用，让你从实际开发中体会到 Laravel 开发的敏捷、愉悦与轻松。</p>
            </dd>
        </dl>
        <div class="extra">
            <a href="{{ route('course.chapters', $course) }}" class="btn btn-primary btn-wider-look">免费试读</a>
            <a href="" class="btn btn-primary btn-wider-look">订阅 ￥{{ $course->price }}</a>
        </div>
    </div>
</div>

@stop