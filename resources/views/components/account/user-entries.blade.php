<div class="heading heading--left">
    <h3>Заявки на участие в Премии</h3>
    <a href="/account/entry/create">Добавить заявку</a>
</div>

@forelse($list as $item)
    <div class="card">
        <div class="card__content">
            <div class="card__title">{{ $item->title }}</div>

            <div class="card__text">
                <dl class="dl-horizontal">
                    <dt>Дата добавления</dt>
                    <dd>{{ $item->created_at }}</dd>

                    <dt>Дата изменения</dt>
                    <dd>{{ $item->updated_at }}</dd>
                
                    <dt>Статуст</dt>
                    <dd>{{ $item->listReadableStatus()[$item->status] }}</dd>
                
                    <dt>Номинация</dt>
                    <dd>{{ $item->nomination->title }}</dd>
                
                    <dt>Мерприятие</dt>
                    <dd>{{ $item->event->title }}</dd>
                </dl>
            </div>
            
        
            @if ($item::STATUS_DRAFT == $item->status)
                <div class="flex flex--gap flex--action flex--column-sm">
                    <div class="message">Заявка не отправлена на модерацию</div>
                    <a href="/account/entry/{{ $item->id }}" class="btn">Редактировать</a>
                </div>
            @elseif ($item::STATUS_MODERATION == $item->status)
                <div class="message">Заявка находится на модерарации</div>
            @elseif ($item::STATUS_RETURNED == $item->status)
                <div class="flex flex--gap flex--action flex--column-sm">
                    <div class="message message--danger">Заявка возвращена на доработку модератором</div>
                    <a href="/account/entry/{{ $item->id }}" class="btn">Редактировать</a>
                </div> 
            @endif
        </div>
    </div>
@empty
    <p>Нет активных заявок. <a href="/account/entry/create">Добавить заявку</a> на участие в премии</p>
@endforelse