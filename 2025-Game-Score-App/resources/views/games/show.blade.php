<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-x1 text-gray-800 leading-tight">
            {{_('All Games')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Game Details</h3>
                        <x-game-details
                            :title="$game->title"
                            :image="$game->image"
                            :year="$game->year"
                            :genre="$game->genre"
                            :description="$game->description"
                        />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<?php
    /*This is where the cards bring you when you click on them.
    It shows all the information about them when if created or edited, however it does not feature time updated or created.*/