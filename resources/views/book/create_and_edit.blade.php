@extends('layout.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> Topic /
                    @if($book->id)
                        Edit #{{$book->id}}
                    @else
                        Create
                    @endif
                </h1>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($book->id)
                    <form action="{{ route('topics.update', $book->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                <div class="form-group">
                	<label for="title-field">Title</label>
                	<input class="form-control" type="text" name="title" id="title-field" value="{{ old('title', $book->title ) }}" />
                </div> 
                <div class="form-group">
                	<label for="body-field">Body</label>
                	<textarea name="body" id="body-field" class="form-control" rows="3">{{ old('body', $book->body ) }}</textarea>
                </div> 
                <div class="form-group">
                    <label for="user_id-field">User_id</label>
                    <input class="form-control" type="text" name="user_id" id="user_id-field" value="{{ old('user_id', $book->user_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="chapter_id-field">Chapter_id</label>
                    <input class="form-control" type="text" name="chapter_id" id="chapter_id-field" value="{{ old('chapter_id', $book->chapter_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="book_id-field">Book_id</label>
                    <input class="form-control" type="text" name="book_id" id="book_id-field" value="{{ old('book_id', $book->book_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="comment_count-field">Comment_count</label>
                    <input class="form-control" type="text" name="comment_count" id="comment_count-field" value="{{ old('comment_count', $book->comment_count ) }}" />
                </div> 
                <div class="form-group">
                    <label for="view_count-field">View_count</label>
                    <input class="form-control" type="text" name="view_count" id="view_count-field" value="{{ old('view_count', $book->view_count ) }}" />
                </div> 
                <div class="form-group">
                    <label for="order-field">Order</label>
                    <input class="form-control" type="text" name="order" id="order-field" value="{{ old('order', $book->order ) }}" />
                </div> 
                <div class="form-group">
                	<label for="desc-field">Desc</label>
                	<textarea name="desc" id="desc-field" class="form-control" rows="3">{{ old('desc', $book->desc ) }}</textarea>
                </div> 
                <div class="form-group">
                	<label for="slug-field">Slug</label>
                	<input class="form-control" type="text" name="slug" id="slug-field" value="{{ old('slug', $book->slug ) }}" />
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('topics.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection