<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Game Score') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Edit Score:</h3>
                    <x-score-form
                        :action="route('scores.update', $score)"
                        :method="'PUT'"
                        :score="$score"
                    />  <!-- Grabs the edit form for the scores, the edit score dorm is only used once unlike every other form. -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>