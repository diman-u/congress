<div class="grid grid--center grid--sm-2 grid--lg-4">
    @forelse($list as $item)
        <div class="grid__column">
            <article class="news-item">
                <div class="news-item__image">
                    <img src="/storage/{{ $item->image }}" alt="">
                </div>
                <div class="news-item__meta">
                    <p class="news-item__date">{{ $item->created_at->format('d.m.Y') }}</p>
                </div>
                <p class="news-item__title">
                    <a href="/news/{{ $item->id }}" class="covering-link">{{ $item->name }}</a>
                </p>
            </article>
        </div>
    @empty
        <div class="grid__column text-center">
            Нет новостей
        </div>
    @endforelse
</div>