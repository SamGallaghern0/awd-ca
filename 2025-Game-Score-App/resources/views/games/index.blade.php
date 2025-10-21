<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-x1 text-gray-800 leading-tight">
            {{_('All Games')}}
        </h2>
    </x-slot>

    <x-alert-success>
        {{ session('success') }}
    </x-alert-success>

    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4 ">List of Games:</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($games as $game)
                        <div class="border p-4 rounded-lg shadow-md">
                            <a href="{{ route('games.show', $game) }}">
                                <x-game-card
                                    :title="$game->title"
                                    :image="$game->image"
                                />
                            </a>
                            <div class="mt-4 flex space-x-2">
                                <a href="{{ route('games.edit', $game) }}" class="text-gray-600 bg-green-300 hover:bg-green-700 font-bold py-2 px-4 rounded">
                                    Edit
                                </a>
                                <form action="{{ route('games.destroy', $game) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this game?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-gray-600 font-bold py-2 px-4 rounded">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<?php
    /*The index page is where the user will be able to see all the games and will be able to edit or delete the games with the help of two buttons.
    It aslo allows the user to click on the cards bringing them to the description or show page.
    The edit button also allows brings the user to the edit page however the delete button does not have a page so it just deletes the game.*/