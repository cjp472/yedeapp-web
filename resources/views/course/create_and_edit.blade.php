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
                <form id="course_form" class="form-horizontal" action="{{ route('course.update', $course->slug) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
            @else
                <form id="course_form" class="form-horizontal" action="{{ route('course.store') }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
            @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label class="col-sm-2" for="name_field">课程名</label>
                        <div class="col-sm-7"><input class="form-control" type="text" name="name" id="name_field" value="{{ old('name', $course->name) }}" required /></div>
                        <div class="col-sm-3 input-tips">课程中文名，如：从简单学起</div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-2" for="slug_field">英文名</label>
                        <div class="col-sm-7"><input class="form-control" type="text" name="slug" id="slug_field" value="{{ old('slug', $course->slug) }}" required /></div>
                        <div class="col-sm-3 input-tips">显示在网址上，可用连字符，不能用空格。如：my-first-course</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2" for="cover_field" class="cover-label">封面图</label>
                        <div class="col-sm-7"><input type="file" name="cover" id="cover_field" ></div>
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
                            <input type="hidden" id="chapters_hidden" name="chapters" value="{{ old('chapters', $course->chapters) }}" />
                        </div>
                        <div class="col-sm-3 input-tips">添加章节，填写每章标题</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2" for="price_field">价格</label>
                        <div class="col-sm-7"><input class="form-control" type="text" name="price" id="price_field" value="{{ old('price', $course->price) }}" required /></div>
                        <div class="col-sm-3 input-tips">如：39.9</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2" for="intro_field">描述</label>
                        <div class="col-sm-7"><textarea name="intro" id="intro_field" class="form-control" rows="8" required>{{ old('intro', $course->intro) }}</textarea></div>
                        <div class="col-sm-3 input-tips">简短描述，用于首页和课程目录上方</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2" for="introduction_field">介绍</label>
                        <div class="col-sm-7"><textarea name="introduction" id="introduction_field" class="form-control" rows="8" required>{{ old('introduction', $course->introduction) }}</textarea></div>
                        <div class="col-sm-3 input-tips">用于推广页面，详述课程亮点</div>
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
@stop

@section('scripts')
<script>
var $chapters = $('.chapters');
var $hiddenNode = $('#chapters_hidden');
var maxId = 1, maxOrder = 1;
var strNode = '<div class="dummy-node">'
    +'<input class="form-control pull-left spacing" type="text" value="[value]" />'
    +'<a class="pull-right button" onclick="handle(this, \'[symbol]\')">'
    +'<span class="glyphicon glyphicon-[symbol]"></span>'
    +'</a>'
    +'</div>';

function handle(btn, plusOrMinus) {
    var $row = $(btn).parent();
    var hasValue = $row.children('input').val();
    var node;

    // Add row
    if (plusOrMinus == 'plus') {
        node = strNode.replace(/\[value\]/g, '').replace(/\[symbol\]/g, 'minus');
        $(node).appendTo($chapters);
    } else {
        // Delete row. Confirm when it contains contents.
        if (hasValue) {
            if (confirm('确认删除？')) {
                $row.remove();
            }
        } else {
            $row.remove();
        }
    }

    return false;
}

$(document).ready(function(){
    // The old function can retrieve data from input field or db
    var hasChapters = $hiddenNode.val();

    // Set chapter items
    if (hasChapters) {
        var chapters = JSON.parse(hasChapters);

        // List all chapters
        for (var i = 0; i < chapters.length; i++) {
            var chapter = chapters[i];
            var node = strNode.replace(/\[value\]/g, chapter.name);

            // Set the first node with plus button
            if (i == 0) {
                node = node.replace(/\[symbol\]/g, 'plus');
            } else {
                // Set the other nodes with minus button
                node = node.replace(/\[symbol\]/g, 'minus');
            }

            // Store data and append to wrapper
            $(node).data(chapter).appendTo($chapters);

            // Calculate the next id and order 
            maxId = chapter.id;
            maxOrder = chapter.order;
        }
    
    } else {
        // When creating a blank new course
        var node = strNode.replace(/\[value\]/g, '').replace(/\[symbol\]/g, 'plus');
        $(node).appendTo($chapters);
    }

    // Submit
    $('#course_form').submit(function(e){
        // Compose string chapters
        var strChapters = '';

        $('.dummy-node').each(function(i){
            var data = $(this).data();

            if (data.id) {
                var json = {
                    'id': data.id,
                    'name': $(this).children('input').val(),
                    'topics': data.topics,
                    'order': data.order
                }
                strChapters += JSON.stringify(json) + ',';
            } else {
                maxId += 1;
                maxOrder += 1;
                var json = {
                    'id': maxId,
                    'name': $(this).children('input').val(),
                    'topics': [],
                    'order': maxOrder
                }
                strChapters += JSON.stringify(json) + ',';
            }
        });

        // Post chapters
        strChapters = '[' + strChapters.substring(0, strChapters.length-1) + ']';
        $hiddenNode.val(strChapters);
    });
})
</script>
@stop