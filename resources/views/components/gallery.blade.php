<div class="grid grid--center grid--sm-2 grid--lg-4">
    @if(!empty($gallery))
    <div>
        {{ $gallery->title }}
    </div>
    @endif

    @if(!empty($galleryItems))
    <div class="grid__column">
        @foreach($galleryItems as $items)
            <article class="news-item">
                <div class="news-item__image">
                    <img width="150" src="/storage/{{ $items->path }}" alt="{{ $items->title }}">
                </div>
            </article>
        @endforeach
    </div>
    @endif
</div>