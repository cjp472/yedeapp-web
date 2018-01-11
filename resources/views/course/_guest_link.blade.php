@if ($topic->free)
    <a href="{{ $topic->link($course->slug) }}">
        <span class="label label-primary">免费试读</span>
        {{ $topic->title }}
    </a>
@else
    <span>{{ $topic->title }}</span>
@endif

@if(!$topic->free)
    <span class="pull-right"><i class="glyphicon glyphicon-lock" title="订阅后开启"></i></span>
@endif