<section 
    x-data="{
        showBodyHelp: false
    }"
    x-init="() => {
        const image = FilePond.create($refs.image);
        image.setOptions({
            acceptedFileTypes: ['image/*'],
            maxFileSize: '1MB',
            server: {
                process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('image', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('image', filename, load)
                }
            }
        });

        @if (count($entry->getMedia('image')))
        image.files = [
            @foreach ($entry->getMedia('image') as $file)
                {
                    source: '{{$file->id}}',
                    options: {
                        type: 'local',
                        file: {
                            name: '{{$file->name}}',
                        },
                        metadata: {
                            poster: '{{$file->getFullUrl()}}'
                        }
                    }
                }
            @endforeach
        ];
        @endif
        
        const files = FilePond.create($refs.files);
        files.setOptions({
            allowMultiple: true,
            allowFilePoster: false,
            allowImagePreview: false,
            maxFiles: 10,
            maxFileSize: '10MB',
            labelIdle: 'Перетащите или выберите файл',
            server: {
                process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('files', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('files', filename, load)
                }
            }
        });

        files.on('removefile', (error, file) => {
            if (file.serverId) {
                $wire.set('mediaToDelete', $wire.mediaToDelete.concat([file.serverId]));
            }
        });

        @if (count($entry->getMedia('files')))
        files.files = [
            @foreach ($entry->getMedia('files') as $file)
                {
                    source: '{{$file->id}}',
                    options: {
                        type: 'local',
                        file: {
                            name: '{{$file->name}}',
                        },
                        metadata: {
                            poster: '{{$file->getFullUrl()}}'
                        }
                    }
                },
            @endforeach
        ];
        @endif
    }"
>
    <div class="container">
        <div class="heading heading--left">
            <h3>Заявка на участие в Премии</h3>
        </div>

        @if (session()->has('message'))
            <p class="message message--success">
                {{ session('message') }}
            </p>
        @endif

        <form wire:submit.prevent="{{ $entry->id ? 'update' : 'store' }}">

            <div class="grid grid--sm-1 grid--md-2 grid--lg-3 grid--lg-f66">
                <div class="grid__column">

                    <div class="field">
                        <label class="label">Краткое название работы</label>
                        <div class="control">  
                            <input 
                                type="text" 
                                maxlength="100"
                                wire:model="entry.title" 
                                placeholder="Будет отображаться на карточке вашего проекта в общей галерее кейсов на сайте Премии"
                            >
                        </div>

                        <p class="help">Доступно для ввода <strong x-text="100 - ($wire.entry.title || '').length"></strong> знаков</p>
                        @error('entry.title') <p class="message message--danger message--small">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label class="label">Полное название</label>
                        <div class="control">
                            <textarea rows="3" maxlength="300" wire:model="entry.full_title" placeholder="Будет отображаться на отдельной странице вашего проекта на сайте Премии (Может совпадать с кратким)"></textarea>
                        </div>

                        <p class="help">Доступно для ввода <strong x-text="300 - ($wire.entry.full_title || '').length"></strong> знаков</p>
                        @error('entry.full_title') <p class="message message--danger message--small">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label class="label">Номинация</label>
                        <div class="control control--select">
                            <select wire:model.defer="entry.nomination_id">
                                @foreach ($nominations as $nomination)
                                    <option value="{{ $nomination->id }}">{{ $nomination->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        @error('entry.nomination_id') <p class="message message--danger message--small">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label class="label">Краткое тезисное описание</label>
                        <div class="control">
                            <textarea rows="3" maxlength="300" wire:model="entry.description" placeholder="Будет отображаться на карточке в галерее кейсов"></textarea>
                        </div>
                        <p class="help">Доступно для ввода <strong x-text="300 - ($wire.entry.description || '').length"></strong> знаков</p>
                        @error('entry.description') <p class="message message--danger message--small">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label class="label">Полное описание <button type="button" class="badge"  @click.prevent="showBodyHelp=!showBodyHelp">?</button></label>
                        
                        <div class="card text-small" x-show="showBodyHelp">
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
                            <textarea rows="6" maxlength="5000" wire:model="entry.body"></textarea>
                        </div>

                        <p class="help">Доступно для ввода <strong x-text="5000 - ($wire.entry.body || '').length"></strong> знаков</p>
                        @error('entry.body') <p class="message message--danger message--small">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid--sm-1 grid--lg-2">
                        <div class="grid__column">
                            <div class="card">
                                <div class="field">
                                    <label class="label">Изображение для обложки</label>
                                    <div class="control" wire:ignore>
                                        <input type="file" x-ref="image">
                                    </div>

                                    <p class="help">Данное изображение будет отображаться на сайте. <br>(не более 1Мб).</p>
                                    @error('image') <p class="message message--danger message--small">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="grid__column">
                            <div class="card">
                                <div class="field">
                                    <label class="label">Материалы и иллюстрации</label>
                                    <div class="control" wire:ignore>
                                        <input type="file" x-ref="files" />
                                    </div>
                                    <p class="help">возможно загрузить до 10 файлов – полное описание работы, картинки, таблицы, графики <br>(размер каждого файла не более 10Мб).</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="grid__column">

                    <div class="field">
                        <label class="label">Укажите название вашего учреждения</label>
                        <div class="control">  
                            <input type="text" wire:model.defer="entry.organization">
                        </div>

                        <p class="help">Заполните поле, если заявка подается от организации</p>
                        @error('entry.organization') <p class="message message--danger message--small">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label class="label">Укажите адрес вашего сайта</label>
                        <div class="control">  
                            <input type="text" wire:model.defer="entry.link">
                        </div>

                        <p class="help">Заполните поле, если у проекта или организации есть веб-сайт</p>
                        @error('entry.link') <p class="message message--danger message--small">{{ $message }}</p> @enderror
                    </div>

                    <h3 class="mt-3 mb-3">Участники проекта</h3>

                    @error('members') <p class="message message--danger message--small">{{ $message }}</p> @enderror

                    @if ($entry->id)
                        @livewire('forms.entry-members', ['entry' => $entry])   
                    @else
                        <div class="message">Участники проекта могут быть добавлены после сохрания данных</div>
                    @endif
                    
                </div>
            </div>
            
            <div class="card">
                <button type="submit" class="btn btn--sm-block">Сохранить</button>
                <a class="btn btn--sm-block btn--blue" href="{{ route('account') }}">Отмена</a>
                @if ($entry->id)
                    <button type="button" class="btn btn--sm-block btn--red" wire:click="updateAndModerate">Отправить на модерацию</button>
                @endif
            </div>

            <div class="message">На модерацию передаются только отправленные заявки. Для этого заполните все обязательные поля и сохраните форму.</div>
            <div class="message">Вы можете в любой момент вернуться к заполнению формы перед её отправкой на модерацию.</div>
        </form>
    </div>
</section>

@push('styles')
    @once
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
        <link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet">
    @endonce
@endpush

@push('scripts')
    @once
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
        <script>
            const FilePondLabels_RU = {
                labelIdle: 'Перетащите или выберите <span class="filepond--label-action"> Изображение </span>',
                labelInvalidField: 'Поле содержит недопустимые файлы',
                labelFileWaitingForSize: 'Укажите размер',
                labelFileSizeNotAvailable: 'Размер не поддерживается',
                labelFileLoading: 'Ожидание',
                labelFileLoadError: 'Ошибка при ожидании',
                labelFileProcessing: 'Загрузка',
                labelFileProcessingComplete: 'Загрузка завершена',
                labelFileProcessingAborted: 'Загрузка отменена',
                labelFileProcessingError: 'Ошибка при загрузке',
                labelFileProcessingRevertError: 'Ошибка при возврате',
                labelFileRemoveError: 'Ошибка при удалении',
                labelTapToCancel: 'нажмите для отмены',
                labelTapToRetry: 'нажмите, чтобы повторить попытку',
                labelTapToUndo: 'нажмите для отмены последнего действия',
                labelButtonRemoveItem: 'Удалить',
                labelButtonAbortItemLoad: 'Прекращено',
                labelButtonRetryItemLoad: 'Повторите попытку',
                labelButtonAbortItemProcessing: 'Отмена',
                labelButtonUndoItemProcessing: 'Отмена последнего действия',
                labelButtonRetryItemProcessing: 'Повторите попытку',
                labelButtonProcessItem: 'Загрузка',
                labelMaxFileSizeExceeded: 'Файл слишком большой',
                labelMaxFileSize: 'Максимальный размер файла: {filesize}',
                labelMaxTotalFileSizeExceeded: 'Превышен максимальный размер',
                labelMaxTotalFileSize: 'Максимальный размер файла: {filesize}',
                labelFileTypeNotAllowed: 'Файл неверного типа',
                fileValidateTypeLabelExpectedTypes: 'Tipos de arquivo suportados são {allButLastType} ou {lastType}',
                imageValidateSizeLabelFormatError: 'Тип изображения не поддерживается',
                imageValidateSizeLabelImageSizeTooSmall: 'Изображение слишком маленькое',
                imageValidateSizeLabelImageSizeTooBig: 'Изображение слишком большое',
                imageValidateSizeLabelExpectedMinSize: 'Минимальный размер: {minWidth} × {minHeight}',
                imageValidateSizeLabelExpectedMaxSize: 'Максимальный размер: {maxWidth} × {maxHeight}',
                imageValidateSizeLabelImageResolutionTooLow: 'Разрешение слишком низкое',
                imageValidateSizeLabelImageResolutionTooHigh: 'Разрешение слишком высокое',
                imageValidateSizeLabelExpectedMinResolution: 'Минимальное разрешение: {minResolution}',
                imageValidateSizeLabelExpectedMaxResolution: 'Максимальное разрешение: {maxResolution}',
                labelMaxFileSizeExceeded: 'Файл слишком большой',
                labelMaxFileSize: 'Максимальный размер файла {filesize}'
            };

            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginFileValidateSize,
                FilePondPluginFileValidateType,
                FilePondPluginFilePoster
            );
            
            FilePond.setOptions(FilePondLabels_RU);
            FilePond.setOptions({
                imagePreviewHeight: 200,
                filePosterMaxHeight: 200,
                credits: false
            });
        </script>
    @endonce
@endpush