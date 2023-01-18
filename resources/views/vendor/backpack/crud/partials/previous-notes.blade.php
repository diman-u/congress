@if (count($crud->getCurrentEntry()->notes))
<h5>Предыдущие сообщения</h5>
<div class="accordion" id="previous-notes">
    @foreach ($crud->getCurrentEntry()->notes()->orderByDesc('created_at')->get() as $note)
    <div class="card mb-0">
        <div class="card-header" id="heading-{{ $note->id }}">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-{{ $note->id }}">
                    Сообщение от {{ $note->created_at }}
                </button>
            </h2>
        </div>
  
        <div id="collapse-{{ $note->id }}" class="collapse" aria-labelledby="heading-{{ $note->id }}" data-parent="#previous-notes">
            <div class="card-body">
                {!! $note->note !!}
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif