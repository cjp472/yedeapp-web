@forelse ($items as $item)
    <li class="clearfix">
        <span class="pull-left">
            内容&nbsp;&nbsp;
            <a href="{{ $item->link($item->course->slug) }}" target="_blank">{{ str_limit($item->title, 35) }}</a>
            &nbsp;&nbsp;在课程&nbsp;&nbsp;
            <a href="{{ route('course.chapters', $item->course) }}" target="_blank">{{ str_limit($item->course->name, 25) }}</a>
        </span>
        <span class="pull-right">{{ $item->created_at->diffForHumans() }}</span>
    </li>
@empty
    <li class="empty">目前没有内容</li>
@endforelse