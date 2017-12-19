@extends('layouts.app')

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
                        <h4><strong>个人简介</strong></h4>
                        <p>{{ $user->introduction }}</p>
                        <hr>
                        <h4><strong>手机</strong></h4>
                        <p>{{ $user->phone }}</p>
                        <hr>
                        <h4><strong>邮箱</strong></h4>
                        <p>{{ $user->email }}</p>
                        <hr>
                        <h4><strong>注册于</strong></h4>
                        <p>{{ $user->created_at->diffForHumans() }}</p>
                        <hr>
                        <p class="text-center"><a href="{{ route('users.edit', $user->id) }}" class="btn btn-default">　　编辑个人资料　　</a></p>
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
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#history" aria-controls="history" role="tab" data-toggle="tab">历史</a></li>
                    <li role="presentation"><a href="#favorite" aria-controls="favorite" role="tab" data-toggle="tab">收藏</a></li>
                    <li role="presentation"><a href="#message" aria-controls="message" role="tab" data-toggle="tab">留言</a></li>
                    <li role="presentation"><a href="#star" aria-controls="star" role="tab" data-toggle="tab">赞过</a></li>
                    <li role="presentation"><a href="#atme" aria-controls="atme" role="tab" data-toggle="tab">@我</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="history">历史内容</div>
                    <div role="tabpanel" class="tab-pane" id="favorite">...</div>
                    <div role="tabpanel" class="tab-pane" id="message">...</div>
                    <div role="tabpanel" class="tab-pane" id="star">...</div>
                    <div role="tabpanel" class="tab-pane" id="atme">...</div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@stop