<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Entry as EntryModel;
use App\Models\Event;
use App\Models\Nomination;

class Entry extends Component
{
    use WithFileUploads;

    public $entry;
    public $nominations = [];

    public $image;
    public $files = [];
    public $mediaToDelete = [];
    

    protected $rules = [
        'entry.title' => 'required|min:6|max:100',
        'entry.full_title' => 'required|min:6|max:300',
        'entry.description' => 'required|min:6|max:300',
        'entry.body' => 'required|min:6|max:5000',
        'entry.organization' => 'max:255',
        'entry.link' => 'nullable|url',
        'entry.nomination_id' => 'required',
    ];

    protected $messages = [
        'entry.title.required' => 'Укажите краткое название вашего проекта',
        'entry.full_title.required' => 'Укажите полное название вашего проекта',
        'entry.description.required' => 'Укажите краткое описание вашего проекта',
        'entry.body.required' => 'Запоните полное описание вашего проекта',
        'entry.nomination_id.required' => 'Выберите номинацию из списка',

        'image' => 'Загрузите изображение для обложки',
    ];

    public function mount($id = null)
    {
        $this->entry = new EntryModel();

        if (is_numeric($id)) {
            $this->entry = EntryModel::findOrFail($id);
        }

        if (
            $this->entry->exists() 
            && $this->entry->user_id != auth()->id()
        ) {
            return redirect()->route('account')->with('error', 'Ошибка доступа');
        }

        if (
            $this->entry->exists() 
            && !in_array($this->entry->status, [
                    EntryModel::STATUS_DRAFT, 
                    EntryModel::STATUS_RETURNED
                ])
        ) {
            return redirect()->route('account')->with('error', 'Заявка находится на расммотрении');
        }

        $this->nominations = Nomination::get();
        if (!$this->entry->exists()) {
            $this->entry->nomination_id = $this->nominations[0]->id;
        }
    }

    public function render()
    {
        return view('livewire.forms.entry')
            ->extends('layouts.account');
    }

    public function store()
    {
        $this->validate(array_merge(
            $this->rules,
            [
                'image' => 'required|image|max:1024',
            ]
        ));

        $this->entry->status = EntryModel::STATUS_DRAFT;
        $this->entry->user_id = auth()->id();
        $this->entry->event_id = Event::active()->id;
        $this->entry->save();

        $this->processUploads();

        session()->flash('message', 'Данные успешно сохранены!');

        return redirect()->to('/account/entry/'.$this->entry->id);
    }

    public function update()
    {
        $this->validate();

        $this->entry->save();

        $this->processUploads();

        session()->flash('message', 'Данные успешно обновлены!');

        return redirect()->to('/account/entry/'.$this->entry->id);
    }

    public function updateAndModerate()
    {

        $this->validate();

        if (!count($this->entry->members()->get())) {
            $this->addError('members', 'Вы должны добавить хотябы одного участника');
            return;
        }

        $this->entry->status = EntryModel::STATUS_MODERATION;
        $this->entry->save();

        $this->processUploads();

        session()->flash('message', 'Заявка отправлена на модерацию');

        return redirect()->route('account');
    }

    private function processUploads()
    {
        if (!$this->entry->exists()) {
            return;
        }

        // delete unused media
        foreach ($this->mediaToDelete as $mediaId)  {
            $this->entry->deleteMedia($mediaId);
        }

        // add or update image
        if ($this->image) {
            $this->entry
                ->addMedia($this->image->getRealPath())
                ->toMediaCollection('image');
        }

        // add new files
        collect($this->files)->each(fn($file) =>
            $this->entry
                ->addMedia($file->getRealPath())
                ->usingName($file->getClientOriginalName())
                ->toMediaCollection('files')
        );
    }
}
