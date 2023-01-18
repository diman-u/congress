@livewireStyles
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Номинация #{{ $nomination->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <p>
                        <span><strong>Title</strong></span>
                        {{ $nomination->title }}
                    </p>

                    <p>
                        <span><strong>Body</strong></span>
                        {!! $nomination->body !!}
                    </p>
                    <p>
                        <span>
                            <strong>Entries</strong>
                        </span>
                        {{ $nomination->entry()->pluck('title')->implode(', ') }}
                    </p>
                    <p>
                        <span>
                            <strong>Events</strong>
                        </span>
                        {{ $nomination->event()->pluck('title')->implode(', ') }}
                    </p>
                </div>
            </div>
        </div>

        @livewire('expert-review', ['id' => $nomination->id])
    </div>
</x-app-layout>
@livewireScripts