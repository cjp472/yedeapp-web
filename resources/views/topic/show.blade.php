@extends('layout.app')

@section('title', $topic->title . ' - ' . config('app.name'))

@section('content')
{{--  Special header and menus  --}}
@include('topic._header')
@include('topic._catalog')

<div class="row topic-detail">
    <div class="col-md-12">
        {{--  Head  --}}
        <div class="head clearfix">
            <h1 class="pull-left">{{ $topic->title }}</h1>
            <div class="pull-right">
                @auth
                <div class="head-button">
                    <a class="btn btn-default btn-sm favorite-add"><i class="glyphicon glyphicon-heart-empty"></i> <span>收藏</span></a>
                </div>
                @endauth

                {{--  User can edit and delete his/her topic  --}}
                @can('update', $topic)
                    <div class="head-button">
                        <a href="{{ route('topic.edit', $topic->id) }}" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-edit"></i> <span>编辑</span></a>
                    </div>
                    <div class="head-button">
                        <form action="{{ route('topic.destroy', $topic->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-trash"></i> <span>删除</span></button>
                        </form>
                    </div>
                @endcan
            </div>
        </div>
        {{--  Topic content  --}}
        <div class="body">
            <div class="content">{!! $topic->body !!}</div>
        </div>
        {{--  Sns Share  --}}
        @include('topic._sns')
        {{--  Prev and next button  --}}
        <div class="prev-and-next clearfix">
            @if ($prev)
                <a href="{{ $prev->link() }}" class="btn btn-default pull-left prev" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{ $prev->title }}"><i class="glyphicon glyphicon-chevron-left"></i> 上一节</a>    
            @endif
            @if ($next)
                <a href="{{ $next->link() }}" class="btn btn-default pull-right next" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{ $next->title }}">下一节 <i class="glyphicon glyphicon-chevron-right"></i></a>
            @endif
        </div>

    </div>
</div>
{{--  Comments  --}}
<div class="row topic-comments">
    <div class="col-md-12">
        <div class="head clearfix">
            <div class="heading pull-left">留言精选</div>
            <div class="pull-right"><a id="jump_to_editor" role="button" tabindex="0" data-trigger="focus" data-placement="left" data-content="试读不支持写留言"><i class="glyphicon glyphicon-pencil"></i> 写留言</a></div>
        </div>
        <div class="body">
            @include('topic._comments')
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @include('topic._scripts')
@endsection