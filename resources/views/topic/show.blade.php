@extends('layout.app')

@section('title', $topic->title . ' - ' . config('app.name'))

@section('content')

<div class="row topic-detail">
    <div class="col-md-12">

        <div class="head clearfix">
            <h1 class="pull-left">{{ $topic->title }}</h1>
            <div class="pull-right">
                @auth
                <div class="head-button">
                    <a class="btn btn-default btn-sm favorite-add"><i class="glyphicon glyphicon-heart-empty"></i> <span>收藏</span></a>
                </div>
                @endauth
                
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

        <div class="body">
            <div class="content">{!! $topic->body !!}</div>
        </div>

        <div class="sns-share">
            <div class="sns-component">分享：这里是分享图片</div>
            @auth
                <div class="favorite"><a class="btn btn-default btn-sm favorite-add"><i class="glyphicon glyphicon-heart-empty"></i> <span>收藏</span></a></div>
            @endauth
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
                        <a id="comment_{{ $comment->id }}">
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
                                    {{--  <div class="head-button">
                                        <button type="button" class="btn btn-link btn-md comment-vote" data-key="id_{{ $comment->id }}" data-vote="{{ $comment->votes }}" data-star="{{ $comment->star }}" data-uri="{{ route('comment.vote', $comment->id) }}"><i class="glyphicon glyphicon-thumbs-up"></i> <span>{{ $comment->star }}</span></button>
                                    </div>  --}}
                                </div>
                            </div>
                            <div class="comment-content">{{ $comment->body }}</div>
                            <div class="comment-date">{{ $comment->updated_at->diffForHumans() }}</div>

                            @foreach ($replies as $reply)
                                @if ($reply->parent_id == $comment->id)
                                    <div class="media reply">
                                        <a id="comment_{{ $reply->id }}">
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
                                                    {{--  <div class="head-button">
                                                        <button type="button" class="btn btn-link btn-md comment-vote" data-key="id_{{ $comment->id }}"  data-vote="{{ $comment->votes }}" data-star="{{ $comment->star }}" data-uri="{{ route('comment.vote', $comment->id) }}"><i class="glyphicon glyphicon-thumbs-up"></i> <span>{{ $reply->star }}</span></button>
                                                    </div>  --}}
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
var $editor = $('#write_comment textarea');
var $jumper = $('#jump_to_editor');
var $form = $('#comment_form');
    
var $buttonsAddFavorite = $('.favorite-add');
{{--
// var $buttonsVoteComment = $('.comment-vote');
--}}

var USERID = '{{ Auth::id() }}';
var TOPIC_VOTES = '{!! $topic->votes !!}';
var TOPIC_API = "{{ route('topic.vote', $topic->id) }}";

function ButtonsHandler() {
    this.userId = USERID;

    this.setText = function(btn, text) {
        btn.children('span').text(text);
    };

    this.setIcon = function(btn, oldIcon, newIcon) {
        btn.children('i').removeClass(oldIcon).addClass(newIcon);
    };

    this.setStyle = function(btn, oldStyle, newStyle) {
        btn.removeClass(oldStyle).addClass(newStyle);
    };

    this.isVoted = function(data) {
        if (data) {
            var votes = JSON.parse(data);
            for (var i = 0; i < votes.length; i++) {
                var vote = votes[i];
                if (vote.user_id == this.userId) {
                    return true;
                }
            }
        }
        return false;
    }

}

function FavoriteAddButtons(buttons) {
    this.buttons = buttons;
    this.state = false;
    this.initState = false;
    
    this.setAdded = function() {
        this.setStyle(buttons, 'btn-selected', 'btn-selected');
        this.setIcon(buttons, 'glyphicon-heart-empty', 'glyphicon-heart');
        this.setText(buttons, '已收藏');
    }

    this.setNotAdd = function() {
        this.setStyle(buttons, 'btn-selected', '');
        this.setIcon(buttons, 'glyphicon-heart-empty', 'glyphicon-heart-empty');
        this.setText(buttons, '收藏');
    }

    this.toggle = function() {
        if (this.state == 'added') {
            this.setNotAdd();
            this.state = 'noadd';
        } else {
            this.setAdded();
            this.state = 'added';
        }
    };

    this.init = function() {
        if (this.isVoted(TOPIC_VOTES)) {
            this.state = this.initState = 'added';
            this.setAdded();
        } else {
            this.state = this.initState = 'noadd';
            this.setNotAdd();
        }
    };

    this.isChanged = function() {
        return this.initState != this.state;
    }
}

{{--
// function CommentVoteButtons(buttons) {
//     this.buttons = buttons;
//     this.state = [];
//     this.initState = [];
//     this.star = [];

//     this.setVoteUp = function(btn, star) {
//         this.setStyle(btn, 'btn-selected', 'btn-selected');
//         this.setIcon(btn, 'glyphicon-thumbs-up', 'glyphicon-heart');
//         this.setText(btn, star);
//     }

//     this.setVoteDown = function(btn, star) {
//         this.setStyle(btn, 'btn-selected', '');
//         this.setIcon(btn, 'glyphicon-thumbs-up', 'glyphicon-thumbs-up');
//         this.setText(btn, star);
//     }

//     this.toggle = function(btn) {
//         var key = btn.attr('data-key');
//         var star = parseInt(this.star[key]);

//         if (this.state[key] == 'up') {
//             this.star[key] = star - 1;
//             this.setVoteDown(btn, this.star[key]);
//             this.state[key] = 'down';
//         } else {
//             this.star[key] = star + 1;
//             this.setVoteUp(btn, this.star[key]);
//             this.state[key] = 'up';
//         }
//     };

//     this.init = function() {
//         var that = this;
//         this.buttons.each(function() {
//             var btn = $(this),
//                 key = btn.attr('data-key'),
//                 data = btn.attr('data-vote'),
//                 star = btn.attr('data-star');

//             // Keep the star number whatever the state is.
//             that.star[key] = star;

//             if (that.isVoted(data)) {
//                 that.state[key] = that.initState[key] = 'up';
//                 that.setVoteUp(btn);
//             } else {
//                 that.state[key] = that.initState[key] = 'down';
//                 that.setVoteDown(btn);
//             }
//         });
//     };

//     // When the btn has been changed, return it's state 'up' or 'down'.
//     this.isChanged = function(btn) {
//         var key = btn.attr('data-key');
//         if (this.initState[key] != this.state[key]) {
//             return this.state[key];
//         } else {
//             return false;
//         }
//     }
// }
--}}

FavoriteAddButtons.prototype = new ButtonsHandler();
FavoriteAddButtons.prototype.constructor = FavoriteAddButtons;

var fabtns = new FavoriteAddButtons($buttonsAddFavorite);
fabtns.init();

{{--
// CommentVoteButtons.prototype = new ButtonsHandler();
// CommentVoteButtons.prototype.constructor = CommentVoteButtons;
// var cvbtns = new CommentVoteButtons($buttonsVoteComment);
// cvbtns.init();
--}}

$(document).ready(function(){
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

    $buttonsAddFavorite.click(function() {
        fabtns.toggle();
    });

    $buttonsVoteComment.click(function() {
        cvbtns.toggle($(this));
    });

    $(window).on('beforeunload', function(){
        if (fabtns.isChanged()) {
            $.get(TOPIC_API);
        }

        {{--
        // $buttonsVoteComment.each(function() {
        //     var btn = $(this);
        //     var act, api;

        //     if (act = cvbtns.isChanged(btn)) {
        //         api = btn.attr('data-uri') + '/' + act + '?s=' + Math.random();
        //         $.get(api);
        //     }
        // });
        --}}
    });
});
</script>
@stop