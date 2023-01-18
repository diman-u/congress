<div class="grid grid--center grid--sm-2 grid--md-3 grid--lg-4 grid--xl-5 grid--xxl-6">
    @forelse($list as $item)
        <div class="grid__column">
            <a class="speaker-item" href="/speakers/{{ $item->id }}" target="_blank" rel="nofollow">
                <div class="speaker-item__image">
                    <img src="/storage/{{ $item->image }}" alt="">
                </div>
                <div class="speaker-item__info">
                    <p class="speaker-item__name">
                        {{ $item->fio }}
                    </p>
                    {!! $item->body !!}
                </div>
            </a>
        </div>

    @empty
        <p>Спикеров не найдено.</p>
    @endforelse
</div>