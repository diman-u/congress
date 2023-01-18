<div class="grid grid--sm-1 grid--md-2 grid--lg-3">
    @foreach($list as $date => $collection)
    <div class="grid__column">
        <div class="h1 mt-1">{{ Carbon\Carbon::parse($date)->format('j F') }}</div>
        <div class="h3">Перезагрузка системы здравоохранения</div>

        @foreach($collection as $program)
        <div class="program-item">
            <div class="program-item__time">{{ $program->time }} - {{ $program->time_end }}</div>
            <a class="program-item__title" href="{{ route('program.show', $program->id) }}">{{ $program->title }}</a>

            <div class="program-faces">
                @foreach($program->speaker as $speaker)
                    <img alt="" src="/storage/{{ $speaker->image }}">
                @endforeach
            </div>

        </div>
        @endforeach
    </div>
    @endforeach
</div>

@if (!empty($list))
<div class="text-center mt-3">
    <a href="{{ route('program.index') }}" class="btn btn--big">Скачать программу</a>
</div>
@endif