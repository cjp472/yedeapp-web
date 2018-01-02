@extends('layout.app')

@section('title', $topic->title . ' - ' . config('app.name'))

@section('content')

<div class="row topic-detail">
    <div class="col-md-12">

        <div class="head clearfix">
            <h1 class="pull-left">{{ $topic->title }}</h1>
            <div class="pull-right">
                <div class="head-button">
                    <a href="#" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-heart"></i> 收藏</a>
                </div>
                @can('update', $topic)
                    <div class="head-button">
                        <a href="{{ route('topic.edit', $topic->id) }}" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-edit"></i> 编辑</a>
                    </div>
                    <div class="head-button">
                        <form action="{{ route('topic.destroy', $topic->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-trash"></i> 删除</button>
                        </form>
                    </div>
                @endcan
            </div>
        </div>

        <div class="body">
            <div class="content">{!! $topic->body !!}</div>
        </div>

        <div class="sns-share">
            <div class="sns-component">分享：这里是分享图片</div>
            <div class="favorite"><a href="" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-heart"></i> 收藏</a></div>
        </div>

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

<div class="row topic-comments">
    <div class="col-md-12">
    
        <div class="head clearfix">
            <div class="heading pull-left">留言精选</div>
            <div class="pull-right"><a id="jump_to_editor"><i class="glyphicon glyphicon-pencil"></i> 写留言</a></div>
        </div>

        <div class="body">
            <ul class="media-list comments"> 
                @forelse($comments as $comment)
                    <li class="media comment">
                        <div class="media-left">
                            <a href="{{ route('user.show', $comment->user_id) }}">
                                <img class="media-object img-circle" width="50px" src="{{ $comment->user->avatar }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="media-heading">
                                <span class="author">{{ $comment->user->name }}</span>
                                <div class="pull-right">
                                    @can('destroy', $comment)
                                        <div class="head-button">
                                            <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-link btn-md"><i class="glyphicon glyphicon-trash"></i> 删除</button>
                                            </form>
                                        </div>
                                    @endcan
                                    <div class="head-button">
                                        <button type="button" class="btn btn-link btn-md"><i class="glyphicon glyphicon-thumbs-up"></i> {{ $comment->star }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="comment-content">{{ $comment->body }}</div>
                            <div class="comment-date">{{ $comment->updated_at->diffForHumans() }}</div>

                            @foreach ($replies as $reply)
                                @if ($reply->parent_id == $comment->id)
                                    <div class="media reply">
                                        <div class="media-body">
                                            <div class="media-heading">
                                                <span class="author"><i class="vline"></i>作者回复</span>
                                                <div class="pull-right">
                                                    @can('destroy', $comment)
                                                        <div class="head-button">
                                                            <form action="{{ route('comment.destroy', $reply->id) }}" method="post">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button type="submit" class="btn btn-link btn-md"><i class="glyphicon glyphicon-trash"></i> 删除</button>
                                                            </form>
                                                        </div>
                                                    @endcan
                                                    <div class="head-button">
                                                        <button type="button" class="btn btn-link btn-md"><i class="glyphicon glyphicon-thumbs-up"></i> {{ $reply->star }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="comment-content">{{ $reply->body }}</div>
                                            <div class="comment-date">{{ $reply->updated_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </li>
                @empty
                    {{-- 没有留言 --}}
                @endforelse

                @guest
                    <li class="text-center"><a href="{{ route('login') }}">留言请先登陆</a></li>
                @else
                    {{-- 评论框 --}}
                    <li class="media write" id="write_comment">
                        <div class="media-left">
                            <img class="media-object img-circle" width="50px" src="{{ Auth::user()->avatar }}">
                        </div>
                        <div class="media-body">
                            @include('common.error')
                            <form id="comment_form" action="{{ route('comment.store') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                                <textarea name="body" class="editor" placeholder="理性留言的你可以说是很有素质了" required></textarea>
                                <button class="btn btn-primary btn-wider-look" type="submit">提交</button><span class="submit-tip">（快捷键 Ctrl + Enter）</span>
                            </form>
                        </div>
                    </li>
                @endguest

            </ul>
        </div>

    </div>
</div>
@stop

@section('scripts')
<script>
$(document).ready(function(){
    $editor = $('#write_comment textarea');
    $jumper = $('#jump_to_editor');
    $form = $('#comment_form');

    // Jump to comment editor
    $jumper.click(function(){
        $editor.focus();
    })

    // Ctrl + Enter submit
    $editor.keydown(function(event){
        if (event.ctrlKey && event.keyCode == 13) {
            $form.submit();
        }
    });
});
</script>
@stop