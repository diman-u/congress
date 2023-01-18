@if ($crud->getCurrentEntry())
@forelse ($crud->getCurrentEntry()->members as $members)
    <div @class([
        'media',
        'mb-4' => !$loop->last
    ])>
        @if ($members->getFirstMedia('image'))
            <img src="{{ $members->getFirstMediaUrl('image', 'thumb') }}" class="mr-3" alt="" />
        @endif
        <div class="media-body">
            <h5 class="mt-0">{{ $members->name }}</h5>
            <div><strong>Должность:</strong> {{ $members->position }}</div>
            <div><strong>Город:</strong> {{ $members->city }}</div>
        </div>
    </div>
@empty
  <p>Записей не обнаружено</p>
@endforelse
@else
    <p>Записей не обнаружено</p>
@endif

@push('crud_fields_styles')
    @loadOnce('members_field_styles')
    <style type="text/css">
        .media img {
            max-height: 100px;
        }
    </style>>
    @endLoadOnce
@endpush

