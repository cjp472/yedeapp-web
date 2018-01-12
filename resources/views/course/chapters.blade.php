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
            @if (Auth::check())
                @if (!Auth::user()->hasSubscribed($course))
                    <div class="extra">
                        <a href="" class="btn btn-primary btn-wider-look">订阅 ￥{{ $course->price }}</a>
                    </div>
                @endif
            @endif
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
                                    @can('show', $topic)
                                        @include('course._subscriber_link')
                                    @else
                                        @include('course._guest_link')
                                    @endcan
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