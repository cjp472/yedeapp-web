@extends('layout.app')

@section('title', $user->name . ' 的个人资料 - ' . config('app.name'))
    
@section('content')
<div class="row">

    <div class="col-md-3 col-sm-12 col-xs-12 user-info">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="media">
                    <div class="text-center">
                        <img class="img-thumbnail img-responsive" src="{{ $user->avatar }}" width="300px" height="300px">
                    </div>
                    <div class="media-body">
                        <hr>
                        
                        <h4><strong>用户</strong></h4>
                        <p>{{ $user->name }}</p>
                        @if($user->introduction)
                            <p>{{ $user->introduction }}</p>
                        @endif
                        <hr>

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
                    <li class="{{ active_class(if_route('user.show') && (if_route_param('tab', 'history') || if_route_param('tab', ''))) }}"><a href="{{ route('user.show', [$user, 'history']) }}">历史</a></li>
                    <li class="{{ active_class(if_route('user.show') && if_route_param('tab', 'favorite')) }}"><a href="{{ route('user.show', [$user, 'favorite']) }}">收藏</a></li>
                    <li class="{{ active_class(if_route('user.show') && if_route_param('tab', 'comment')) }}"><a href="{{ route('user.show', [$user, 'comment']) }}">留言</a></li>
                    {{--  <li class="{{ active_class(if_route('user.show') && if_route_param('tab', 'atme')) }}"><a href="{{ route('user.show', [$user, 'atme']) }}">@我</a></li>  --}}
                </ul>
                
                <!-- Tab panes -->
                <div class="tab-content">
                    <ul class="item-list">
                        @include('user._' . $tab)
                    </ul>
                    @empty(!$items)
                        <div class="text-center">
                            {{ $items->render() }}
                        </div>
                    @endempty
                </div>
            </div>
        </div>
    </div>
    
</div>
@stop