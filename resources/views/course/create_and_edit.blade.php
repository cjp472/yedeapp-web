@extends('layout.app')

@section('content')
<div class="row">
    <div class="panel panel-default col-md-12">
        
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-edit"></i>
                @if($course->id)
                    编辑课程
                @else
                    新建课程
                @endif
            </h4>
        </div>

        <div class="panel-body">
            @include('common.error')

            @if($course->id)
                <form class="form-horizontal" action="{{ route('course.update', $course->slug) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
            @else
                <form class="form-horizontal" action="{{ route('course.store') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
            @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label class="col-sm-2" for="title_field">书名</label>
                        <div class="col-sm-7"><input class="form-control" type="text" name="title" id="title_field" value="{{ old('title', $course->title) }}" required /></div>
                        <div class="col-sm-3 input-tips">书的中文名，如：从简单学起</div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-2" for="slug_field">英文名</label>
                        <div class="col-sm-7"><input class="form-control" type="text" name="slug" id="slug_field" value="{{ old('slug', $course->slug) }}" required /></div>
                        <div class="col-sm-3 input-tips">显示在网址上，可用连字符，不能用空格。如：my-first-course</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2" for="cover_field" class="cover-label">封面</label>
                        <div class="col-sm-7"><input type="file" name="cover" id="cover_field" required></div>
                        <div class="col-sm-3 input-tips">封面图片，尺寸：300 x 500</div>
                    </div>
                    @if($course->cover)
                        <div class="form-group">
                            <div class="col-sm-7 col-sm-offset-2">
                                <label for="cover_field"><img class="img-responsive" src="{{ $course->cover }}" width="200" /></label>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="col-sm-2">分章</label>
                        <div class="col-sm-7 clearfix chapters">
                            <input class="form-control pull-left spacing" type="text" name="chapter" id="chapter_field_0" value="{{ old('chapter_count', $course->chapter_count) }}" /><a class="pull-right button" href="#"><span class="glyphicon glyphicon-plus"></span></a>
                            <input class="form-control pull-left spacing" type="text" name="chapter" id="chapter_field_1" value="{{ old('chapter_count', $course->chapter_count) }}" /><a class="pull-right button" href="#"><span class="glyphicon glyphicon-minus"></span></a>
                            <input class="form-control pull-left spacing" type="text" name="chapter" id="chapter_field_2" value="{{ old('chapter_count', $course->chapter_count) }}" /><a class="pull-right button" href="#"><span class="glyphicon glyphicon-minus"></span></a>
                        </div>
                        <div class="col-sm-3 input-tips">书的分章，填写每章标题</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2" for="price_field">价格</label>
                        <div class="col-sm-7"><input class="form-control" type="text" name="price" id="price_field" value="{{ old('price', $course->price) }}" required /></div>
                        <div class="col-sm-3 input-tips">如：39.9</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2" for="brief_field">描述</label>
                        <div class="col-sm-7"><textarea name="brief" id="brief_field" class="form-control" rows="3" required>{{ old('brief', $course->brief) }}</textarea></div>
                        <div class="col-sm-3 input-tips">简短描述，用于首页和书目录页上方</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2" for="preface_field">简介</label>
                        <div class="col-sm-7"><textarea name="preface" id="preface_field" class="form-control" rows="6" required>{{ old('preface', $course->preface) }}</textarea></div>
                        <div class="col-sm-3 input-tips">用于推广页面，点出书的亮点</div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary btn-wider-look">确定</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){
    var $chapters = $('.chapters');
    
})
</script>
@endsection