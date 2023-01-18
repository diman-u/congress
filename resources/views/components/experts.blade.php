<div class="grid grid--center grid--sm-2 grid--md-3 grid--lg-4 grid--xl-5 grid--xxl-6">
    @forelse($list as $item)
    <div class="grid__column">
        <a class="speaker-item" href="{{ route('speaker.show', $item->id) }}">
            <div class="speaker-item__image">
                <img alt="{{ $item->fio }}"
                    src="/storage/{{ $item->image }}">
            </div>
            <div class="speaker-item__info">
                <p class="speaker-item__name">{{ $item->fio }}</p>
                <p class="speaker-item__detail">{{ $item->position }}</p>
            </div>
        </a>
    </div>
    @empty
        <p>Партнеров не найдено.</p>
    @endforelse
</div>
