<div>
    <select wire:model="eventID">
        @foreach($events as $event)
            <option value="{{ $event->id }}">{{ $event->title }}</option>
        @endforeach
    </select>

    <div>@json($eventID)</div>

    @forelse($entries as $item)
        <div>
            <a href="{{ route('entries.show', $item->id) }}">{{ $item->title }}</a>
        </div>
        <hr>
    @empty
        <div class="grid__column text-center">
            Нет кейсов
        </div>
    @endforelse
</div>