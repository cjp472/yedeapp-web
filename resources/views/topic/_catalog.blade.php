<div class="modal fade" id="modal-chapters" tabindex="-1" role="dialog" aria-labelledby="modal-course-chapters">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ $course->name }}</h4>
            </div>
            <div class="modal-body">
                <dl>
                    @foreach ($chapters as $chapter)
                        <dt>{{ $chapter->name }}</dt>
                        @foreach ($course->topics as $topic)
                            @if($topic->chapter_id === $chapter->id)
                                <dd><a href="{{ $topic->link($course->slug) }}">{{ $topic->title }}</a></dd>
                            @endif
                        @endforeach
                    @endforeach
                </dl>
            </div>
        </div>
    </div>
</div>