<?php

namespace App\Http\Livewire\Forms;

use App\Models\Entry;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\EntryMembers as EntryMembersModel;

class EntryMembers extends Component
{
    use WithFileUploads;

    public $member;
    public $photo;
    public $memberList = [];

    public $entry;

    protected $rules = [
        'member.name' => 'required|min:2|max:255',
        'member.position' => 'required|min:2|max:255',
        'member.city' => 'required|min:2|max:255',
        'photo' => 'nullable|image|max:1024',
    ];

    protected $messages = [
        'required' => 'Данное поле обязательно для участника',
    ];

    public function mount(Entry $entry)
    {
        $this->entry = $entry;
        $this->member = new EntryMembersModel();
        $this->memberList = $this->entry->members;
    }

    public function render()
    {
        return view('livewire.forms.entry-members');
    }

    public function add()
    {
        $this->validate();

        $this->entry->members()->save($this->member);

        if ($this->photo) {
            $this->member
                ->addMedia($this->photo->getRealPath())
                ->toMediaCollection('image');
        }

        $this->member = new EntryMembersModel();
        $this->memberList = $this->entry->members()->get();

        $this->dispatchBrowserEvent('member-added');
    }

    public function delete($id)
    {
        $this->entry->members()->find($id)->delete();
        $this->memberList = $this->entry->members()->get();
    }

    public function moveUp($id)
    {
        $this->entry->members()->find($id)->moveOrderUp();
        $this->memberList = $this->entry->members()->get();
    }

    public function moveDown($id)
    {
        $this->entry->members()->find($id)->moveOrderDown();
        $this->memberList = $this->entry->members()->get();
    }
}
