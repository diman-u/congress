<div class="field" x-ref="form.title">
    <label class="label">Краткое название работы</label>
    <div class="control">  
        <input type="text" maxlength="100" x-model="form.title" placeholder="Будет отображаться на карточке вашего проекта в общей галерее кейсов на сайте Премии">
    </div>
	<p class="help">Доступно для ввода <strong x-text="100 - form.title.length"></strong> знаков</p>
	<p class="message message--danger message--small" x-show="error">Укажите краткое название вашего проекта</p>
</div>

<div class="field" x-ref="form.title_full">
    <label class="label">Полное название</label>
    <div class="control">
        <textarea rows="3" maxlength="300" x-model="form.title_full" placeholder="Будет отображаться на отдельной странице вашего проекта на сайте Премии (Может совпадать с кратким)"></textarea>
    </div>
    <p class="help">Доступно для ввода <strong x-text="300 - form.title_full.length"></strong> знаков</p>
	<p class="message message--danger message--small" x-show="error">Укажите полное название вашего проекта</p>
</div>

<div class="field" x-ref="form.nominations">
    <label class="label">Номинации</label>
    <div class="control control--select">
        <select x-model="form.nominations">
            <option value="1">Эффективное управление медицинскими кадрами</option>
            <option value="2">Управление качеством медицинской помощи: изменение стереотипов</option>
            <option value="3">Цифровая трансформация здравоохранения: интересные решения</option>
        </select>
    </div>
	<p class="message message--danger message--small" x-show="error">Выберите хотя бы одну номинацию из списка</p>
</div>

<div class="field" x-ref="form.description">
    <label class="label">Краткое тезисное описание</label>
    <div class="control">
        <textarea rows="3" maxlength="300" x-model="form.description" placeholder="Будет отображаться на карточке в галерее кейсов"></textarea>
    </div>
    <p class="help">Доступно для ввода <strong x-text="300 - form.description.length"></strong> знаков</p>
	<p class="message message--danger message--small" x-show="error">Укажите краткое описание вашего проекта</p>
</div>

<div class="field" x-ref="form.body">
    <label class="label">Полное описание <button type="button" class="badge"  @click.prevent="bodyHelp=!bodyHelp">?</button></label>
	<div class="card text-small" x-show="bodyHelp">
		<div class="card__content">
			<p>Пожалуйста, опишите проект, расскажите о проблемах и задачах, которые стояли перед вами, например, улучшение результатов работы, повышение эффективности, снижение затрат, развитие новых направлений, или другое. Проекты принимаются в формате завершенного кейса, то есть описания конкретной ситуации, которая потребовала анализа и вашего управленческого решения.</p>
			<p>Кейс-метод впервые стал применяться в обучении в Гарвардском университете и широко распространился по всему миру. Из практики отбирались успешные и, напротив, провальные случаи, и проводился их тщательный разбор. Коллекция управленческих кейсов составила основу для обучения других руководителей, которые могли последовательно проанализировать чужой опыт и сделать практические выводы для собственной деятельности. Сегодня кейс-метод используется не только в образовательном процессе, он получил широкое распространение в других областях благодаря своей практической ценности.</p>
			<p>Лучшие кейсы номинантов Премии мы включим в программу курса повышения квалификации ВШОУЗ, а также опубликуем в журнале &laquo;Оргздрав. Вестник ВШОУЗ&raquo; (ВАК).</p>
			<p><strong>Для описания управленческого кейса, пожалуйста, придерживайтесь следующего плана:</strong></p>
			<ul>
			<li>Описание проблемы, противоречий и сложностей ситуации, которая потребовала решения</li>
			<li>Цель и показатели для измерения достижения цели</li>
			<li>Задачи, которые требовалось решить на пути достижения цели, необходимые ресурсы (финансы, люди), этапы реализации</li>
			<li>Полученные результаты (качественные, количественные)</li>
			</ul>
			<p>Заявки на участие в Премии принимаются до 25 апреля. Объем &ndash; до 3 страниц. Объем загружаемых материалов и иллюстраций &ndash; до 10 файлов. Каждая заявка проходит модерацию и после успешной проверки становится доступна для анонимного голосования. Итоги 1го этапа голосования подводятся простым подсчетом голосов. Чем раньше кейс будет размещен на сайте, тем больше шансов набрать высший балл за период открытого голосования. Проекты, набравшие максимальное число голосов в каждой номинации, проходят во 2 этап и оцениваются членами жюри.</p>
			<p>Желание совершенствоваться, преодолевать проблемы, делиться опытом, радоваться успехам коллег &ndash; все это дает нам возможность почувствовать общность в отрасли.</p>
		</div>
	</div>
	
    <div class="control">
        <textarea rows="6" maxlength="5000" x-model="form.body"></textarea>
    </div>
    <p class="help">Доступно для ввода <strong x-text="5000 - form.body.length"></strong> знаков</p>
	<p class="message message--danger message--small" x-show="error">Запоните полное описание вашего проекта</p>
</div>

<div class="grid grid--sm-1 grid--lg-2">
	<div class="grid__column">
        <div class="card">
            <div class="field">
                <label class="label">Изображение для обложки</label>
                <div class="control">
                </div>
                <p class="help">Данное изображение будет отображаться на сайте. <br>(не более 1Мб).</p>
            </div>
        </div>
    </div>
    <div class="grid__column">
        <div class="card">
            <div class="field">
                <label class="label">Материалы и иллюстрации</label>
                <div class="control">
                </div>
                <p class="help">возможно загрузить до 10 файлов – полное описание работы, картинки, таблицы, графики <br>(размер каждого файла не более 10Мб).</p>
            </div>
        </div>
    </div>
</div>