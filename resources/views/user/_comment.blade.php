@forelse ($items as $item)
    <li class="clearfix">
        <span class="pull-left">
            发表&nbsp;&nbsp;
            <a href="{{ $item->topic->link($item->course->slug) . '#comment_' . $item->id }}" target="_blank">{{ str_limit($item->body, 40) }}</a>
            &nbsp;&nbsp;在&nbsp;&nbsp;
            <a href="{{ $item->topic->link($item->course->slug) }}" target="_blank">{{ str_limit($item->topic->title, 25) }}</a>
        </span>
        <span class="pull-right">{{ $item->created_at->diffForHumans() }}</span>
    </li>
@empty
    <li class="empty">目前没有内容</li>
@endforelse