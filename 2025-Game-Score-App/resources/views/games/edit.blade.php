<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-x1 text-gray-800 leading-tight">
            {{_('Edit Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4 ">Edit Game:</h3>
                    <x-game-form
                        :action="route('games.update', $game)"
                        :method="'PUT'"
                        :game="$game"
                    />
                    <a href="{{ route('games.index', $game) }}" class="text-gray-600 bg-red-300 hover:bg-orange-700 font-bold py-2 px-4 rounded">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>