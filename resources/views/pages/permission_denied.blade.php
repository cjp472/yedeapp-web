@extends('layout.app')

@section('title', '访问受限')

@section('content')

<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-body">
            @if (Auth::check())
                <div class="text-center">
                    抱歉，当前帐号无后台访问权限
                </div>
            @else
                <div class="text-center">请先 <a href="{{ route('login') }}">登录</a> 再访问</div>
            @endif
        </div>
    </div>
</div>

@stop