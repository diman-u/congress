<div
    x-data="{ photo: null }"
    x-init="() => {
        photo = FilePond.create($refs.photo);
        photo.setOptions({
            acceptedFileTypes: ['image/*'],
            maxFileSize: '1MB',
            server: {
                process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('photo', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('photo', filename, load)
                }
            }
        });
    }"
    @member-added.window=" photo.getFiles().forEach(file => photo.removeFile(file.id)) "
>
    <div @class([
        'mb-2' => $memberList
    ])>
    @foreach ($memberList as $item)
        <div class="card card--actions">
            <div class="card__content">
                @if ($loop->first)
                    <div class="card__subtitle">Руководитель проекта</div>
                @endif

                @if (count($item->getMedia('image')))
                <div class="mb-1">
                    {{ $item->getMedia('image')[0]->img()->attributes(['class' => 'img-fluid img-mh60']) }}
                </div>
                @endif
                <div class="card__title">{{ $item->name }}</div>
                <div class="card__text">
                    <div>{{ $item->position }}</div>
                    <div>{{ $item->city }}</div>
                </div>
            </div>
            <div class="card__footer">
                <div class="flex flex--right flex--gap flex--column">
                    @if (!$loop->first && 1 < $loop->count)
                        <button class="btn btn--small" type="button" wire:click="moveUp({{ $item->id }})"><i class="fa-solid fa-caret-up"></i></button>
                    @endif
                    @if (!$loop->last && 1 < $loop->count)
                        <button class="btn btn--small" type="button" wire:click="moveDown({{ $item->id }})"><i class="fa-solid fa-caret-down"></i></button>
                    @endif
                    <button class="btn btn--small" type="button" wire:click="delete({{ $item->id }})"><i class="fa-solid fa-trash"></i></button>
                </div>
            </div>
        </div>
    @endforeach
    </div>

    <div class="card">
        <div class="card__content">
            <div class="field">
                <label class="label">ФИО</label>
                <div class="control">  
                    <input type="text" wire:model.defer="member.name">
                </div>

                @error('member.name') <p class="message message--danger message--small">{{ $message }}</p> @enderror
            </div>
            <div class="field">
                <label class="label">Должность</label>
                <div class="control">  
                    <input type="text" wire:model.defer="member.position">
                </div>
                
                @error('member.position') <p class="message message--danger message--small">{{ $message }}</p> @enderror
            </div>
            <div class="field">
                <label class="label">Город</label>
                <div class="control">  
                    <input type="text" wire:model.defer="member.city">
                </div>

                @error('member.city') <p class="message message--danger message--small">{{ $message }}</p> @enderror
            </div>
            <div class="field">
                <div class="control" wire:ignore>
                    <input type="file" x-ref="photo" />
                </div>
                <p class="help">Объем файла до&nbsp;1&nbsp;мб</p>
            </div>
        </div>
        <div class="card__footer">
            <button class="btn" type="button" wire:click="add">Добавить</button>
        </div>
    </div>
</div>