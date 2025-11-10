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
                    <h4 class="font-semibold text-md mt-8">Scores</h4>
                    @if($game->scores->isEmpty())
                        <p class="text-gray-600">No Scores yet.</p>
                    @else
                        <ul>
                            @foreach($game->scores as $score)
                                <li class="bg-gray-100 p-4 rounded-lg">
                                    <p class="font-semibold">{{$score->user->name}} ({{$score->created_at->format('M d, Y')}})</p>
                                    <p>Rating: {{$score->rating}} / 5</p>
                                    <p>{{$score->comment}}</p>

                                    @if(auth()->user()->role === 'admin')

                                        <a href="{{route('scores.edit', $score)}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            {{_('Edit Score')}}
                                        </a>
                                        <form method="POST" action="{{route('scores.destroy', $score)}}">
                                            @csrf
                                            @method('delete')
                                            <x-danger-button :href="route('scores.destroy', $score)"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{_('Delete Score')}}
                                            </x-danger-button>
                                        </form>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <h4 class="font-semibold text-md mt-8">Add a Score</h4>
                    <form action="{{route('scores.store', $game)}}" method="POST" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <label for="rating" class="block font-medium text-sm text-gray-700">Rating</label>
                            <select name="rating" id="rating" class="mt-1 block w-full" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="comment" class="block font-medium text-sm text-gray-700">Comment</label>
                            <textarea name="comment" id="comment" rows="3" class="mt-1 block w-full" placeholder="Write your score opinions here..."></textarea>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Submit Score
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<?php
    /*This is where the cards bring you when you click on them.
    It shows all the information about them when if created or edited, however it does not feature time updated or created.*/