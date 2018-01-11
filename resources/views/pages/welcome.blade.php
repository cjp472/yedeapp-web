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
                @foreach ($courses as $course)
                    <div class="col-md-12 body">
                        <div class="col-sm-3 course-cover">
                            <a class="image" href="{{ route('course.show', $course) }}"><img class="image-shadow" width="100%" src="{{ $course->cover }}"></a>
                        </div>
                        <div class="col-sm-9 course-intro">
                            <div class="name">{{ $course->name }}</div>
                            <div class="intro">
                                <p>{{ $course->intro }}</p>
                            </div>
                            <div class="extra">
                                @if (Auth::check() && Auth::user()->hasSubscribed($course))
                                    <a href="{{ route('course.chapters', $course) }}" class="btn btn-primary btn-wider-look">开始阅读</a>
                                @else
                                    <a href="{{ route('course.show', $course) }}" class="btn btn-primary btn-wider-look">了解更多</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>