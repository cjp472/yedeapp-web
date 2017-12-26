@extends('layout.app')

@section('title', $user->name . ' 的个人资料 - ' . config('app.name'))
    
@section('content')

<div class="row">

    <div class="col-md-3 col-sm-12 col-xs-12 user-info">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="media">
                    <div align="center">
                        <img class="img-thumbnail img-responsive" src="{{ $user->avatar }}" width="300px" height="300px">
                    </div>
                    <div class="media-body">
                        <hr>
                        
                        @if($user->introduction)
                            <h4><strong>一句话介绍</strong></h4>
                            <p>{{ $user->introduction }}</p>
                            <hr>
                        @endif

                        @if($user->phone)
                            <h4><strong>手机</strong></h4>
                            <p>{{ $user->phone }}</p>
                            <hr>
                        @endif
                        
                        @if($user->email)
                            <h4><strong>邮箱</strong></h4>
                            <p>{{ $user->email }}</p>
                            <hr>
                        @endif

                        <h4><strong>注册于</strong></h4>
                        <p>{{ $user->created_at->diffForHumans() }}</p>
                        <hr>
                        <p class="text-center"><a href="{{ route('user.edit', $user->id) }}" class="btn btn-default btn-wider-look">编辑个人资料</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9 col-sm-12 col-xs-12 user-tabs">
        {{-- 用户发布的内容 --}}
        <div class="panel panel-default">
            <div class="panel-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="http://www.qq.com">历史</a></li>
                    <li><a href="#favorite">收藏</a></li>
                    <li><a href="#comment">留言</a></li>
                    <li><a href="#star" >赞过</a></li>
                    <li><a href="#atme">@我</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane">历史内容</div>
                        <ul class="item-list">
                            @forelse ($comments as $comment)
                                <li>
                                    {{ $comment->body }}
                                </li>
                            @empty
                                {{-- 没有留言处理 --}}
                            @endforelse
                        </ul>
                        <div class="text-center">{!! $comments->render() !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@stop