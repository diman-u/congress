<div class="grid grid--sm-1 grid--lg-2">
    @forelse($entries as $item)
        <div class="grid__column">
            <article class="case-item"
                    @if(!empty($item->getMedia('image')[0]))
                        style="background-image:url({{ $item->getMedia('image')[0]->getFullUrl() }});"
                    @endif
                    >
                <div class="case-item__content">
                    <div class="case-item__title">{{ $item->title }}</div>
                    <div class="case-item__meta">
                        <div>{{ $item->organization }}</div>
                    </div>
                    <div class="case-item__entry">
                        @foreach($item->members as $member)
                            @if (count($member->getMedia('image')))
                            <div class="case-item__entry-img">
                                {{ $member->getMedia('image')[0]->img()->attributes(['class' => 'img-fluid']) }}
                            </div>
                            @endif
                        @endforeach
                        <p>{!! $item->description !!}</p>
                    </div>
                    <div class="case-item__meta case-item__meta--center">
                        <a href="{{ route('entries.show', $item->id) }}">
                            <span class="btn btn--small">Подробнее</span>
                        </a>
                        <div>
                            <div>{{ $item->nomination->title }}</div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    @empty
        <p>Кейсов не найдено.</p>
    @endforelse
</div>

<div class="text-center mt-2">
    <a href="{{ route('entries.index') }}" class="btn btn--big">Смотреть всё</a>
</div>