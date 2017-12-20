@extends('layout.app')

@section('title', $topic->title . ' - ' . config('app.name'))

@section('content')

<div class="row topic-detail">
    <div class="col-md-12">

        <div class="head clearfix">
            <h1 class="pull-left">{{ $topic->title }}</h1>
            <div class="pull-right favorite"><a href="" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-heart"></i> 收藏</a></div>
        </div>

        <div class="body">
            <div class="content">{{ $topic->body }}</div>
        </div>

        <div class="sns-share">
            <div class="sns-component">分享：这里是分享图片</div>
            <div class="favorite"><a href="" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-heart"></i> 收藏</a></div>
        </div>

        <div class="prev-and-next clearfix">
            <a href="" class="btn btn-default pull-left prev"><i class="glyphicon glyphicon-chevron-left"></i> 上一节</a>
            <a href="" class="btn btn-default pull-right next">下一节 <i class="glyphicon glyphicon-chevron-right"></i></a>
        </div>

    </div>
</div>

<div class="row topic-comments">
    <div class="col-md-12">
    
        <div class="head clearfix">
            <div class="heading pull-left">留言精选</div>
            <div class="pull-right"><a href="#write_comment"><i class="glyphicon glyphicon-pencil"></i> 写留言</a></div>
        </div>

        <div class="body">
            <ul class="media-list comments">
                @foreach($topic->comments as $comment)
                    <li class="media comment">
                        <div class="media-left">
                            <a href="{{ route('user.show', $comment->user_id) }}">
                                <img class="media-object img-circle" width="50px" src="{{ $comment->user->avatar }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="media-heading">
                                <span class="author">{{ $comment->user->name }}</span>
                                <a class="pull-right" href=""><i class="glyphicon glyphicon-thumbs-up"></i> 10</a>
                            </div>
                            <div class="comment-content">{{ $comment->body }}</div>
                            <div class="comment-date">{{ $comment->updated_at->diffForHumans() }}</div>

                            @if($comment->sub)
                                <div class="media reply">
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <span class="author"><i class="vline"></i>作者回复</span>
                                            <a class="pull-right" href=""><i class="glyphicon glyphicon-thumbs-up"></i> 220</a>
                                        </div>
                                        <div class="comment-content">{{ $comment->sub->body }}</div>
                                        <div class="comment-date">{{ $comment->sub->updated_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </li>
                @endforeach
                {{-- 写留言 --}}
                <li class="media write" id="write_comment">
                    <div class="media-left">
                        <img class="media-object img-circle" width="50px" src="{{ Auth::user()->avatar }}">
                    </div>
                    <div class="media-body">
                        <textarea class="editor" placeholder="请不要发表不友善和负能量言论"></textarea>
                        <button class="btn btn-primary btn-wider-look" type="submit">提交</button>
                    </div>
                </li>

            </ul>
        </div>

    </div>
</div>

@stop
