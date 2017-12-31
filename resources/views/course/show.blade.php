@extends('layout.app')

@section('title', config('app.name'))

@section('content')

<div class="row course-detail">
    <div class="col-md-12 head">
        <div class="col-sm-3 course-cover">
            <img class="image-shadow" width="100%" src="{{ $course->cover }}">
        </div>
        <div class="col-sm-9 course-intro">
            <div class="name">{{ $course->name }}</div>
            <div class="intro">{!! $course->intro !!}</div>
            <div class="extra">
                <a href="" class="btn btn-primary btn-wider-look">订阅 ￥{{ $course->price }}</a>
            </div>
        </div>
    </div>
    <div class="col-md-12 body">
        <div class="chapters">
            @if ($chapters)
                <dl>
                    @foreach($chapters as $chapter)
                        <dt>{{ $chapter->name }}</dt>
                        @foreach($course->topics as $topic)
                            @if($topic->chapter_id === $chapter->id)
                                <dd>
                                    <a href="{{ $topic->link($course->slug) }}">
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
            @endif
        </div>
    </div>
</div>

@stop