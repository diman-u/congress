
<div>
    @livewireStyles
    <div>
        <input type="text" wire:model.defer="phone" >
        <button wire:click="call()">Like</button>
    </div>

    <div>
        <input type="text" wire:model.defer="apply" >
        <button wire:click="like()">Подтвердить</button>
    </div>
    @livewireScripts
</div>
