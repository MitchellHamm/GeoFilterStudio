<div class="list-group">
    @foreach($listItems as $listItem)
    <a href="{{ route($listItem['route'], $listItem['route_params']) }}" class="{{ $listItem['class'] }}">
        {{ $listItem['name'] }}
    </a>
    @endforeach
</div>