@forelse ($items as $item)
    <li>
        {{ $item }}
    </li>
@empty
    <li class="empty">目前没有内容</li>
@endforelse