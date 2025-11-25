<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{_('All Publishers')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Publisher Details</h3>
                        <x-publisher-details
                            :name="$publisher->name"
                            :logo="$publisher->logo"
                            :bio="$publisher->bio"
                        />  <!-- Grabs the publisher details component which include the name, bio and logo. -->
                </div>
                <div class="p-6 text-gray-900 rounded-lg bg-white">
                    @foreach($publisher->games as $game)    <!-- Grabs all games associated with the publisher according to games_publisher. -->
                        <div class="border p-4 rounded-lg grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6 bg-gray-500">
                            <a href="{{ route('games.show', $game) }}">
                                <x-game-card
                                    :title="$game->title"
                                    :image="$game->image"
                                />  <!-- Uses the game card component under the shown publisher. -->
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>