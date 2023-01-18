<div class="heading heading--left">
    <h3>Заявки на участие в конгрессе</h3>
</div>

@forelse($list as $item)
    <div class="card card--actions">
        <div class="card__content">
            <div class="card__title">Участие в конгрессе &laquo;Оргздрав-2023&raquo;</div>

            <div class="card__text">
                <dl class="dl-horizontal">
                    <dt>Дата добавления</dt>
                    <dd>22.09.2022</dd>
                
                    <dt>Тип участия</dt>
                    <dd>Очное</dd>
                
                    <dt>Стоимость участия</dt>
                    <dd>15&nbsp;999&nbsp;руб.</dd>
                </dl>
            </div>

            <div class="message message--info">Ожидается оплата</div>
        </div>
        <div class="card__footer">
            <a href="#" class="btn">Оплатить</a>
        </div>
    </div>
@empty
    <p>Нет активных заявок</p>
@endforelse