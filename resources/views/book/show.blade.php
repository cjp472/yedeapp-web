@extends('layout.app')

@section('title', config('app.name'))

@section('content')

<div class="row book-detail">
    <div class="col-md-12 head">
        <div class="col-sm-3 book-cover">
            <img class="image-shadow" width="100%" src="{{ $book->cover }}">
        </div>
        <div class="col-sm-9 book-brief">
            <div class="title">{{ $book->title }}</div>
            <div class="brief">{!! $book->brief !!}</div>
            <div class="extra">
                <a href="" class="btn btn-primary btn-wider-look">订阅 ￥{{ $book->price }}</a>

            </div>
        </div>
    </div>
    <div class="col-md-12 body">
        <div class="chapters">
            <dl>
                {{--
                <dt>第 1 章 开始编写</dt>
                <dd><a href=""><span class="label label-primary">免费试读</span>1.1 序言</a></dd>
                <dd><a href=""><span class="label label-primary">免费试读</span>1.2 数据库视图管理工具</a></dd>
                <dd><a href=""><span class="label label-primary">免费试读</span>1.3 数据库视图管理工具</a></dd>
                <dd><a href=""><span class="label label-primary">免费试读</span>1.4 数据库视图管理工具</a></dd>
                <dd><a href=""><span class="label label-primary">免费试读</span>1.5 数据库视图管理工具</a></dd>
                <dt>第 2 章 一段不容易的路</dt>
                <dd><a href="">1.1 序言</a></dd>
                <dd><a href="">1.2 数据库视图管理工具</a><span class="pull-right"><i class="glyphicon glyphicon-lock"></i></span></dd>
                <dd><a href="">1.3 数据库视图管理工具</a><span class="pull-right"><i class="glyphicon glyphicon-lock"></i></span></dd>
                <dd><a href="">1.4 数据库视图管理工具</a><span class="pull-right"><i class="glyphicon glyphicon-lock"></i></span></dd>
                <dd><a href="">1.5 数据库视图管理工具</a><span class="pull-right"><i class="glyphicon glyphicon-lock"></i></span></dd>
                --}}
                @foreach($book->chapters as $chapter)
                    <dt>{{ $chapter->title }}</dt>

                    @foreach($book->topics as $topic)
                        @if($topic->chapter_id === $chapter->id)
                            <dd>
                                <a href="{{ $topic->link($book->slug) }}">
                                    @if($topic->free)
                                        <span class="label label-primary">免费试读</span>    
                                    @endif
                                    {{ $topic->title }}
                                </a>
                                @if(!$topic->free)
                                    <span class="pull-right"><i class="glyphicon glyphicon-lock"></i></span>
                                @endif
                            </dd>
                        @endif
                    @endforeach

                @endforeach
            </dl>
        </div>
    </div>
</div>

@stop