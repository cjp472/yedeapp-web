<ul class="media-list comments"> 
    @forelse ($comments as $comment)
        <li class="media comment">
            <a id="comment_{{ $comment->id }}"></a>
            <div class="media-left">
                <a href="{{ route('user.show', $comment->user_id) }}">
                    <img class="media-object img-circle" width="50px" src="{{ $comment->user->avatar }}">
                </a>
            </div>
            <div class="media-body">
                <div class="media-heading">
                    <span class="author">{{ $comment->user->name }}</span>
                    <div class="pull-right">
                        @if ($canReplyComment)
                            <div class="head-button">
                                <a class="btn btn-link btn-md reply-button" data="{{ $comment->id }}"><i class="glyphicon glyphicon-comment"></i> 回复</a>
                            </div>
                        @endif
                        @if ($canDeleteComment)
                            <div class="head-button">
                                <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-link btn-md"><i class="glyphicon glyphicon-trash"></i> 删除</button>
                                </form>
                            </div>
                        @endif
                        {{--
                        <div class="head-button">
                            <button type="button" class="btn btn-link btn-md comment-vote" data-key="id_{{ $comment->id }}" data-vote="{{ $comment->votes }}" data-star="{{ $comment->star }}" data-uri="{{ route('comment.vote', $comment->id) }}"><i class="glyphicon glyphicon-thumbs-up"></i> <span>{{ $comment->star }}</span></button>
                        </div>
                        --}}
                    </div>
                </div>
                <div class="comment-content">{{ $comment->body }}</div>
                <div class="comment-date">{{ $comment->updated_at->diffForHumans() }}</div>
                <div class="inserted-editor"></div>
                {{--  Replies  --}}
                @foreach ($replies as $reply)
                    @if ($reply->parent_id == $comment->id)
                        <div class="media reply">
                            <a id="comment_{{ $reply->id }}"></a>
                            <div class="media-body">
                                <div class="media-heading">
                                    <span class="author"><i class="vline"></i>作者回复</span>
                                    <div class="pull-right">
                                        @if ($canDeleteComment)
                                            <div class="head-button">
                                                <form action="{{ route('comment.destroy', $reply->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-link btn-md"><i class="glyphicon glyphicon-trash"></i> 删除</button>
                                                </form>
                                            </div>
                                        @endif
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

    {{-- 订阅后才能留言 --}}
    @can('show', $topic)
        {{-- 评论框 --}}
        <li id="reply-editor">
            <div class="media create-reply">
                <div class="media-left">
                    <img class="media-object img-circle" width="50px" src="{{ Auth::user()->avatar }}">
                </div>
                <div class="media-body">
                    @include('common.error')
                    <form action="{{ route('comment.store') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <textarea name="body" class="editor" placeholder="理性留言的你可以说是很有素质了" required></textarea>
                        <button class="btn btn-primary btn-wider-look" type="submit">提交</button><span class="submit-tip">（快捷键 Ctrl + Enter）</span>
                    </form>
                </div>
            </div>
        </li>
    @else
        <li class="text-center" style="margin:20px auto"><a href="{{ route('login') }}">留言请先订阅</a></li>
    @endcan
</ul>