<div class="partners">
    @forelse($list as $item)
    <a class="partners__item" href="{{ $item->link }}" target="_blank" rel="nofollow">
        <span>{{ $item->title }}</span>
        <img class="img-fluid"
             src="/storage/{{ $item->image }}"
             alt="" loading="lazy">
    </a>
    @empty
        <p>Партнеров не найдено.</p>
    @endforelse
</div>