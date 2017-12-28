@extends('layout.app')

@section('content')

<div class="row">
    <div class="panel panel-default col-md-10 col-md-offset-1">
        
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-edit"></i>
                @if($topic->id)
                    编辑文章
                @else
                    新建文章
                @endif
            </h4>
        </div>

        @include('common.error')

        <div class="panel-body">
            @if($topic->id)
                <form action="{{ route('topic.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
                    <input type="hidden" name="_method" value="PUT">
            @else
                <form action="{{ route('topic.store') }}" method="POST" accept-charset="UTF-8">
            @endif

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="title-field">标题</label>
                    <input class="form-control" type="text" name="title" id="title-field" value="{{ old('title', $topic->title) }}" required />
                </div> 
                <div class="form-group">
                    <label for="body-field">正文</label>
                    <textarea name="body" id="body-field" class="form-control" rows="10" required>{{ old('body', $topic->body) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="chapter_id-field">书目</label>
                    <select class="form-control" name="book_id" required>
                        <option value="" hidden disabled {{ null === old('book_id', $topic->book_id) ? 'selected' : '' }}>请选择书目</option>
                        @foreach ($books as $value)
                            <option value="{{ $value->id }}" {{ $value->id == old('book_id', $topic->book_id) ? 'selected' : '' }}>{{ $value->title }}</option>
                        @endforeach
                    </select>
                </div> 
                <div class="form-group">
                    <label for="chapter_id-field">章节</label>
                    <select class="form-control" name="chapter_id" required>
                        <option value="" hidden disabled {{ null === old('chapter_id', $topic->chapter_id) ? 'selected' : '' }}>请选择章节</option>
                        @foreach ($chapters as $value)
                            <option value="{{ $value->id }}" {{ $value->id == old('chapter_id', $topic->chapter_id) ? 'selected' : '' }}>{{ $value->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-wider-look">确定</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection