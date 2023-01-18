<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Список спикеров
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @forelse($speakers as $item)
                        <div class="my-4">
                            <a href="{{ route('speaker.show', $item->id) }}">
                                <img class="w-32" src="/storage/{{ $item->image }}" alt="" />
                                {{ $item->fio }}
                            </a>
                        </div>
                        <hr>
                    @empty
                        <div class="grid__column text-center">
                            Нет спикеров
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
