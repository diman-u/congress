<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Список номинаций
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white border-b border-gray-200">
                @forelse($nominations as $item)
                    <div>
                        <a href="{{ route('nominations.show', $item->id) }}">{{ $item->title }}</a>
                    </div>
                    <hr>
                @empty
                    <div class="grid__column text-center">
                        Нет номинаций
                    </div>
                @endforelse
            </div>

            {{ $nominations->links() }}
        </div>
    </div>
</x-app-layout>
