<div class="grid grid--center grid--md-1 grid--lg-3">
    @forelse($nominations->chunk(3) as $list)
        <div class="grid__column">
            @foreach($list as $nomination)
                <a href="{{ route('nominations.show', $nomination->id) }}">
                    <div class="nomination">
                        @if(!empty($nomination->docs))
                            <div class="nomination__icon">
                                <img src="/storage/{{ $nomination->image }}" alt="" />
                            </div>
                        @endif
                        <div class="nomination__body">
                            <div class="nomination__title">{{ $nomination->title }}</div>
                            <p>{!! $nomination->body !!}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @empty
        <div class="grid__column text-center">
            Нет активных номинаций
        </div>
    @endforelse
</div>